<?php
class Newsletter extends AppModel {
    public $name = 'Newsletter';
    
    public $validate = array(
        'date' => array(
            'rule' => array('custom', '/\d{4}\-\d{2}\-\d{2}/'),
            'message' => 'Date must be in the format of yyyy-mm-dd'
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
        if ($this->data[$this->alias]['filename']['size'] !== 0) {
            if ($this->exists() && $current = $this->field('file')) {
                $this->deleteExistingFile($this->field('file'), 'files/Newsletters');
            }
            
            $name = $this->uploadFile($this->data[$this->alias]['filename'], 'files/Newsletters');
            
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
                'Newsletter.date'
            ),
            'conditions' => array(
                'Newsletter.status' => true
            ),
            'order' => array(
                'Newsletter.date' => 'DESC'
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
        $options = array();
        
        switch ($search['Category']) {
            case 'date':
                $options = array(
                    'conditions' => $this->dateSearch($term),
                    'order' => array(
                        'Newsletter.date' => 'ASC'
                    )
                );
                break;
            case 'title':
                $options = array(
                    'conditions' => array(
                        'Newsletter.title LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Newsletter.title' => 'ASC'
                    )
                );
                break;
            case 'filename':
                $options = array(
                    'conditions' => array(
                        'Newsletter.file LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Newsletter.file' => 'ASC'
                    )
                );
                break;
            default:
                $dateSearch = $this->dateSearch($term, false);
                $options = array(
                    'conditions' => array(
                        'OR' => array(
                            $dateSearch,
                            'Newsletter.title LIKE' => "%$term%",
                            'Newsletter.file LIKE' => "%$term%"
                        )
                    ),
                    'order' => array(
                        'Newsletter.date' => 'ASC'
                    )
                );
                break;
        }
        
        return $options;
    }
}