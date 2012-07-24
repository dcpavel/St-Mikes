<?php
/**
 * @property DocumentCategory $DocumentCategory 
 */
class Document extends AppModel {
    public $name = 'Document';
    public $belongsTo = array(
        'DocumentCategory'
    );
    
    public $validate = array(
        'date' => array(
            'rule' => '/\d{4}\-\d{2}\-\d{2}/',
            'message' => 'Date must be in the format of yyyy-mm-dd',
        ),
        'title' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must include a title'
        ),
        'filename' => array(
            'extension' => array(
                'rule' => array('extension', array('pdf')),
                'message' => 'Please supply a pdf file',
            )
        )
    );
    
    /**
     * Upload files if one has been selected to upload
     */
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['filename']) && $this->data[$this->alias]['filename']['size'] !== 0) {
            $documentCategory = $this->DocumentCategory->field(
                    'title',
                    array(
                        'DocumentCategory.id' => $this->data[$this->alias]['document_category_id']
                    )
                );
            $documentCategory = Inflector::pluralize($documentCategory);
            
            if ($this->exists() && $current = $this->field('file')) {
                $this->deleteExistingFile($this->field('file'), "files/$documentCategory");
            }
            
            $name = $this->uploadFile($this->data[$this->alias]['filename'], "files/$documentCategory");
            
            $this->data[$this->alias]['file'] = $name;
        }
        
        return parent::beforeSave($options);
    }
    
    /**
     * A list of the active newsletters ordered by date
     * 
     * @return array 
     */
    public function newsletterList() {
        $newsletters = $this->find('list', array(
            'fields' => array(
                'Document.date'
            ),
            'conditions' => array(
                'Document.status' => true,
                'Document.type' => $newsletter_id
            ),
            'order' => array(
                'Document.date' => 'DESC'
            )
        ));
        
        foreach ($newsletters as &$newsletter) {
            $newsletter = date('F, Y', strtotime($newsletter));
        }
        
        return $newsletters;
    }
    
    /**
     * Construct the appropriate options for pagination or find
     * 
     * @param array $search The POST data for use in a search
     * @return array Options containing conditions and order
     */
    public function searchOptions($search) {
        $term = trim($search['Search']);
        $_options = array();
        
        if (!empty($search['Category'])) {
            $_options = array(
                'conditions' => array(
                    'Document.document_category_id' => $search['Category']
                )
            );
        }
        
        switch ($search['Filter']) {
            case 'date':
                $options = array(
                    'conditions' => $this->dateSearch($term),
                    'order' => array(
                        'Document.date' => 'ASC'
                    )
                );
                break;
            case 'title':
                $options = array(
                    'conditions' => array(
                        'Document.title LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Document.title' => 'ASC'
                    )
                );
                break;
            case 'filename':
                $options = array(
                    'conditions' => array(
                        'Document.file LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Document.file' => 'ASC'
                    )
                );
                break;
            default:
                $dateSearch = $this->dateSearch($term, false);
                $options = array(
                    'conditions' => array(
                        'OR' => array(
                            $dateSearch,
                            'Document.title LIKE' => "%$term%",
                            'Document.file LIKE' => "%$term%"
                        )
                    ),
                    'order' => array(
                        'Document.date' => 'ASC'
                    )
                );
                break;
        }
        
        return array_merge_recursive($options, $_options);
    }
}