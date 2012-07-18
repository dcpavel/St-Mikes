<?php
class DocumentCategory extends AppModel {
    public $name = 'DocumentCategory';
    public $hasMany = array(
        'Document'
    );
    
    public $validate = array(
    );
    
    public function categoryList() {
        return $this->find('list', array(
            'fields' => array(
                'DocumentCategory.id', 'DocumentCategory.title'
            )
        ));
    }
    
}