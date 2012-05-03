<?php
class Calendar extends AppModel {
    public $name = 'Calendar';
    public $actsAs = array('Containable');
    public $hasMany = array('CalendarEvent');
    
    /**
     * Return the colors used for calendar backgrounds. Each color should 
     * correspond to a class in the css with a defined background-color
     * 
     * @return array The array of colors
     */
    public function getColors() {
        return array(
            'brown',
            'red',
            'green',
            'blue',
            'aqua',
            'light_blue',
            'light_purple',
            'yellow',
            'pink',
        );
    }
}