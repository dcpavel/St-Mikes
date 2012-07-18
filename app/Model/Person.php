<?php
/**
 * @property Position $Position 
 */

class Person extends AppModel {
    public $name = 'Person';
    
    public $hasAndBelongsToMany = array('Position');
    
    public $validate = array(
        'full_name' => array(
            'rule' => "/^[a-zA-Z'., ]$/",
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
}
