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
    
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        
        if ($this->data[$this->alias]['filename']['size'] !== 0) {
            if ($this->exists() && $current = $this->field('file')) {
                $this->deleteExistingFile($this->field('file'), 'files/Newsletters');
            }
            
            $name = $this->uploadFile($this->data[$this->alias]['filename'], 'files/Newsletters');
            
            $this->data[$this->alias]['file'] = $name;
        }
        
        return true;
    }
    
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
    
    public function lastId() {
        return $this->field('id', array(
            'conditions' => array(
                'Newsletter.status' => true
            ),
            'order' => array(
                'Newsletter.date' => 'DESC'
            )
        ));
    }
}