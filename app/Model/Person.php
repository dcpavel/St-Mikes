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
        $options = array(
            'recursive' => 2
        );
        
        if (!empty($search['Search'])) {
            $_options = array(
                'conditions' => array(
                    'Person.full_name LIKE' => "%" . trim($search['Search']) . "%"
                ),
                'order' => array(
                    'Person.full_name' => 'ASC'
                ),
            );
            $options = array_merge($options, $_options);
        }
        
        if (!empty($search['position'])) {
            $positions = $this->Position->find('all', array(
                'contain' => array(
                    "Person.id"
                ),
                'conditions' => array(
                    'Position.id' => $search['position']
                ),
            ));
            
            $people_ids = array();
            foreach ($positions as $position) {
                foreach ($position['Person'] as $person) {
                    $people_ids[] = $person['id'];
                }
            }
            
            $_options = array(
                'conditions' => array(
                    'Person.id' => $people_ids
                )
            );
            
            $options = array_merge_recursive($options, $_options);
        } elseif (!empty($search['positionCategory'])) {
            $positions = $this->Position->find('all', array(
                'contain' => array(
                    "Person.id"
                ),
                'conditions' => array(
                    'Position.position_category_id' => $search['positionCategory']
                ),
            ));
            
            $people_ids = array();
            foreach ($positions as $position) {
                foreach ($position['Person'] as $person) {
                    $people_ids[] = $person['id'];
                }
            }
            
            $_options = array(
                'conditions' => array(
                    'Person.id' => $people_ids
                )
            );
            
            $options = array_merge_recursive($options, $_options);
        }
        
        return $options;
    }
}
