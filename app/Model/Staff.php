<?php
class Staff extends AppModel {
    public $name = 'Staff';
    public $useTable = 'staff';
    
    public $validate = array(
        'position' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'You must enter a position.'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'That position has already been filled. Try editing it first.'
            )
        ),
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'You must include a name.'
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'You must include a description.'
            )
        ),
        'file' => array(
            'rule' => array('extension', array('gif', 'png', 'jpeg', 'jpg', null)),
            'message' => 'Please supply an image in gif, png, or jpeg format.',
            'allowEmpty' => true
        )
    );
    
    /**
     * Upload files if one has been selected to upload
     */
    public function beforeSave($options = array()) {
        if ($this->data[$this->alias]['file']['size'] !== 0) {
            if ($this->exists() && $current = $this->field('picture')) {
                $this->deleteExistingFile($this->field('picture'), 'img/Staff');
            }
            
            $name = $this->uploadFile($this->data[$this->alias]['file'], 'img/Staff');
            
            $this->data[$this->alias]['picture'] = $name;
        }
        
        return parent::beforeSave($options);
    }
    
    /**
     * Give a formated list of staff with their positions and names
     * 
     * @return array
     */
    public function positionsList() {
        $staff = $this->find('all', array(
            'fields' => array(
                'Staff.id', 'Staff.position', 'Staff.name'
            ),
            'conditions' => array(
                'status' => true
            )           
        ));
        
        $formatted = array();
        foreach ($staff as $member) {
            $formatted[$member['Staff']['id']] = $member['Staff']['position'] . " - " .
                    $member['Staff']['name'];
        }
        
        return $formatted;
    }
    
    /**
     * Construct the appropriate options for pagination or find
     * 
     * @param array $search The POST data for use in a search
     * @return array Options containing conditions and order
     */
    public function searchOptions($search) {
        $term = $search['Search'];
        $options = array();
        
        switch ($search['Category']) {
            case 'name':
                $options = array(
                    'conditions' => array(
                        'Staff.name LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Staff.name' => 'ASC'
                    )
                );
                break;
            case 'position':
                $options = array(
                    'conditions' => array(
                        'Staff.position LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Staff.position' => 'ASC'
                    )
                );
                break;
            default:
                $options = array(
                    'conditions' => array(
                        'OR' => array(
                            'Staff.name LIKE' => "%$term%",
                            'Staff.position LIKE' => "%$term%"
                        )
                    ),
                    'order' => array(
                        'Staff.id' => 'ASC'
                    )
                );
                break;
        }
        
        
        return $options;
    }
}