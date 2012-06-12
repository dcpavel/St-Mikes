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
    
    /**
     * Make sure that passwords are hashed
     * 
     * @return boolean 
     */
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        
        return parent::beforeSave($options);
    }
    
    /**
     * List of roles that a user can be
     * 
     * @return array
     */
    public function roles() {
        return array(
            'admin' => 'Administrator (full access)',
            'author' => 'Author (can change text and upload)',
            'uploader' => 'Uploader (can only upload files)'
        );
    }
}