<?php
class DocumentCategory extends AppModel {
    public $name = 'DocumentCategory';
    public $hasMany = array(
        'Document'
    );
    
    public $validate = array(
    );
    
    /**
     * The list of active document categories
     * 
     * @return array The query results
     */
    public function displayList() {
        return $this->find('list', array(
            'fields' => array(
                'DocumentCategory.id', 'DocumentCategory.title'
            )
        ));
    }
    
    /**
     * Construct the appropriate options for pagination or find
     * 
     * @param array $search The POST data for use in a search
     * @return array Options containing conditions and order
     */
    public function searchOptions($search) {
        $options = array(
            'conditions' => array(
                'DocumentCategory.title LIKE' => '%' . trim($search['Search']) . '%'
            ),
            'order' => array(
                'DocumentCategory.title' => 'ASC'
            )
        );
        
        return $options;
    }
}