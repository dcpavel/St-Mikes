<?php
class User extends AppModel {
    public $name = 'User';
    
    public $actsAs = array('Containable');
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author', 'uploader')),
                'message' => 'Please select a valid role',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        
        return true;
    }
    
    public function roles() {
        return array(
            'admin' => 'Administrator (full access)',
            'author' => 'Author (can change text and upload)',
            'uploader' => 'Uploader (can only upload files)'
        );
    }
}