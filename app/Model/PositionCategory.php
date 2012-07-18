<?php
/**
 * @property Position $Position 
 */

class PositionCategory extends AppModel {
    public $name = 'PositionCategory';
    
    public $hasMany = array('Position');
    
    public $validate = array(
        'title' => array(
            'rule' => 'alphaNumeric',
            'message' => 'You must include a title for your group'
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
                'PositionCategory.title LIKE' => '%' . trim($search['Search']) . '%'
            ),
            'order' => array(
                'PositionCategory.title' => 'ASC'
            )
        );
        
        return $options;
    }
    
    /**
     * The list of active positions categories (a.k.a. Groups)
     * 
     * @return array The query results
     */
    public function displayList() {
        return $this->find('list', array(
            'conditions' => array(
                'PositionCategory.status' => true
            ),
            'order' => array(
                'PositionCategory.title' => 'ASC'
            )
        ));
    }
}
