<?php
App::uses('HtmlHelper', 'View/Helper');

class AppHtmlHelper extends HtmlHelper {
    public function link($title, $url = null, $options = array(), $confirmMessage = false) {
        if (empty($options['escape'])) {
            $options['escape'] = false;
        }
        
        return parent::link($title, $url, $options, $confirmMessage);
    }
    
    public function tableHeaders($names, $trOptions = null, $thOptions = null) {
        $row = parent::tableHeaders($names, $trOptions, $thOptions);
        return $this->tag('thead', $row);
    }
    
    public function tableCells($data, $oddTrOptions = null, $evenTrOptions = null, $useCount = false, $continueOddEven = true) {
        $cells = parent::tableCells($data, $oddTrOptions, $evenTrOptions, $useCount, $continueOddEven);
        return $this->tag('tbody', $cells);
    }
    
    public function tableFooter($names, $trOptions = null, $thOptions = null) {
        $row = parent::tableCells($names, $trOptions, $thOptions);
        return $this->tag('tfoot', $row);
    }
    
    public function calendarDay($title, $events, $edit, $add = null) {
        $html = $this->tag('h1', $title, array('class' => 'days'));
        
        foreach ((array) $events as $event) {
            $link = array_merge($edit, (array) $event['CalendarEvent']['id']);
            $html .= $this->link(
                    $this->calendarEventFormat($event),
                    $link
                );
        }
        
        if ($add !== null) {
            $html .= $this->link(
                    $this->image(
                            'Orb_plus.png',
                            array(
                                'class' => 'add_button',
                                'alt' => 'Add Event',
                                'title' => 'Add Event'
                            )
                        ),
                    $add
                );
        }
        
        return $html;
    }
    
    private function calendarEventFormat($event) {
        $html = $this->tag('h1', $event['CalendarEvent']['title']);
        
        $start_time = date('g:i A', strtotime($event['CalendarEvent']['start_time']));
        $end_time = date('g:i A', strtotime($event['CalendarEvent']['end_time']));
        $html .= $this->tag('span', "$start_time - $end_time", array('class' => 'times'));
        
        return $this->tag('span', $html, array('class' => 'events ' . $event['Calendar']['color']));
    }
    
    public function css($path, $rel = null, $options = array()) {
        if (!isset($options['inline'])) {
            $options['inline'] = false;
        }
        
        return parent::css($path, $rel, $options);
    }
}
?>
