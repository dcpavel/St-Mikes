<?php
class Vestry extends AppModel {
    public $name = 'Vestry';
    
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
                $this->deleteExistingFile($this->field('picture'), 'img/Vestry');
            }
            
            $name = $this->uploadFile($this->data[$this->alias]['file'], 'img/Vestry');
            
            $this->data[$this->alias]['picture'] = $name;
        }
        
        return parent::beforeSave($options);
    }
    
    /**
     * Give a formated list of vestry members with their positions and names
     * 
     * @return array
     */
    public function positionsList() {
        $Vestry = $this->find('all', array(
            'fields' => array(
                'Vestry.id', 'Vestry.position', 'Vestry.name'
            ),
            'conditions' => array(
                'status' => true
            )           
        ));
        
        $formatted = array();
        foreach ($Vestry as $member) {
            $formatted[$member['Vestry']['id']] = $member['Vestry']['position'] . " - " .
                    $member['Vestry']['name'];
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
                        'Vestry.name LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Vestry.name' => 'ASC'
                    )
                );
                break;
            case 'position':
                $options = array(
                    'conditions' => array(
                        'Vestry.position LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Vestry.position' => 'ASC'
                    )
                );
                break;
            default:
                $options = array(
                    'conditions' => array(
                        'OR' => array(
                            'Vestry.name LIKE' => "%$term%",
                            'Vestry.position LIKE' => "%$term%"
                        )
                    ),
                    'order' => array(
                        'Vestry.id' => 'ASC'
                    )
                );
                break;
        }
        
        
        return $options;
    }
}