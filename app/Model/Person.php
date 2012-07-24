<?php
/**
 * @property Position $Position 
 */

class Person extends AppModel {
    public $name = 'Person';
    
    public $hasAndBelongsToMany = array('Position');
    
    public $validate = array(
        'full_name' => array(
            'rule' => array('custom', "/^[a-z'., ]*$/i"),
            'message' => 'Your name must only contain letters, spaces, and appropriate punctuation ( \' . , )'
        ),
        'description' => array(
            'rule' => 'notEmpty',
            'message' => 'You must include a description'
        ),
        'Position' => array(
            'rule' => 'notEmpty',
            'message' => 'blah'
        )
    );
    
    /**
     * Construct the appropriate options for pagination or find
     * 
     * @param array $search The POST data for use in a search
     * @return array Options containing conditions and order
     */
    public function searchOptions($search) {
        $options = array();
        
        if (!empty($search['Search'])) {
            $options = array(
                'conditions' => array(
                    'Person.full_name LIKE' => "%" . trim($search['Search']) . "%"
                ),
                'order' => array(
                    'Person.full_name' => 'ASC'
                ),
            );
        }
        debug($search);
        switch ($search['Category']) {
            case 'full_name':
                $options = array(
                    'conditions' => array(
                        'Person.full_name LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Person.full_name' => 'ASC'
                    ),
                    'recursive' => 2
                );
                break;
            case 'position':
                $options = array(
                    'conditions' => array(
                        'Position.title LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Position.title' => 'ASC'
                    ),
                    'model' => 'Position'
                );
                break;
            case 'group':
                $options = array(
                    'conditions' => array(
                        'PositionCategory.title LIKE' => "%$term%"
                    ),
                    'order' => array(
                        'Position.file' => 'ASC'
                    )
                );
                break;
            default:
                $options = array(
                    'conditions' => array(
                        'OR' => array(
                            'Person.full_name LIKE' => "%$term%",
                            'Position.title LIKE' => "%$term%",
                            'PositionCategory.title LIKE' => "%$term%"
                        )
                    ),
                    'order' => array(
                        'Person.full_name' => 'ASC'
                    )
                );
                break;
        }
        
        $options['recursive'] = 2;
        debug($options);
        
        return $options;
    }
}
