<?php
/**
 * @property PositionCategory $PositionCategory
 * @property Person $Person
 */

class Position extends AppModel {
    public $name = 'Position';
    
    public $belongsTo = array('PositionCategory');
    public $hasAndBelongsToMany = array('Person');
    
    public $validate = array(
        'title' => array(
            'rule' => 'alphanumeric',
            'message' => 'You must include a title'
        ),
        'position_category_id' => array(
            'rule' => 'notEmpty',
            'message' => 'You must select a group for this position to belong to'
        ),
        'Position' => array(
            'notEmpty',
            'message' => 'You must select a position for this person'
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
            'conditions' => array(
                'Position.title LIKE' => '%' . trim($search['Search']) . '%'
            ),
            'order' => array(
                'Position.title' => 'ASC'
            )
        );
        
        if (!empty($search['positionCategory'])) {
            $options['conditions']['Position.position_category_id'] = $search['positionCategory'];
        }
        
        return $options;
    }
    
    /**
     * The list of active positions
     * 
     * @param int $category_id The category id for use in displaying only positions
     * for a particular position_category.
     * @return array The query results
     */
    public function displayList($category_id = null) {
        $options = array(
            'conditions' => array(
                'Position.status' => true
            ),
            'recursive' => 0
        );
        
        if (!is_null($category_id)) {
            $options['conditions']['PositionCategory.id'] = $category_id;
        }
        
        return $this->find('list', $options);
    }
}