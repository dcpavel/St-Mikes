<?php
class CalendarEvent extends AppModel {
    public $name = 'CalendarEvent';
    public $actsAs = array('Containable');
    public $belongsTo = array(
        'Calendar'
    );
    
    public $validate = array(
        'title' => array(
            'rule' => array('notEmpty'),
            'message' => 'Calendar Events must have a title.'
        ),
        'calendar' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must assign an event to a Calendar.'
        ),
        'start_date' => array(
            'rule' => array('date', 'ymd'),
            'message' => 'You must include a starting date'
        ),
        'start_time' => array(
            'rule' => array('notEmpty'),
            'message' => 'You must include a start time'
        ),
        'end_time' => array(
            'rule' => array('endTimeAfterStart'),
            'message' => 'You must have an end time after a start time'
        ),
        'end_date' => array(
            'rule' => array('endDateAfterStart'),
            'message' => 'Your ending date must be on or after your starting date',
            'allowEmpty' => true
        ),
        'description' => array(
            'rule' => array('notEmpty'),
            'message' => 'You should include a description with your event'
        )
    );
    
    /**
     * Check if an event on a single day has an ending time after the starting time.
     * 
     * @param type $check
     * @return boolean 
     */
    public function endTimeAfterStart($check) {
        $end_time = current($check);
        $start_time = $this->data['CalendarEvent']['start_time'];
        
        $start_date = $start_time = $this->data['CalendarEvent']['start_time'];
        $end_date = $start_time = $this->data['CalendarEvent']['end_time'];
        
        if (empty($start_time) || 
                (strtotime($end_date) == strtotime($start_date)) && ($end_time <= $start_time)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Check if an event ends on the same day or later than it starts
     * 
     * @param type $check
     * @return boolean 
     */
    public function endDateAfterStart($check) {
        $end_date = current($check);
        $start_date = $this->data['CalendarEvent']['start_date'];
        
        return (strtotime($end_date) >= strtotime($start_date));
    }
    
    
    /**
     * Get the events for a particular calendar (or all calendars) during a given
     * month
     * 
     * @param int $calendar The ID (or array of IDs) for calendars
     * @param string $month A date string that strtotime can interpret
     * @return array An array of events, ordered by the dates on which they occur 
     */
    public function getEvents($calendar = null, $month = 'now') {
        $options = array(
            'conditions' => array(
                'CalendarEvent.status' => true,
                'CalendarEvent.start_date <= ' => date('Y-m-t', strtotime($month)),
                'OR' => array(
                    'CalendarEvent.end_date >= ' => date('Y-m-01', strtotime($month)),
                    'CalendarEvent.end_date IS NULL'
                )
            ),
            'order' => array(
                'CalendarEvent.start_date ASC'
            ),
            'contain' => array(
                'Calendar.color'
            )
        );
        
        if ($calendar !== null) {
            $options['conditions'] = array_merge(
                    array(
                        'CalendarEvent.calendar_id' => $calendar
                    ),
                    $options['conditions']
                );
        }
        
        $events = $this->find('all', $options);
        $ordered_events = array();
        foreach ($events as $event) {
            $days = $this->eventDays($event, $month);
            
            foreach ($days as $day) {
                $ordered_events[$day][] = $event;
            }
        }
        
        ksort($ordered_events);
        return $ordered_events;
    }
    
    /**
     * Get the days that an event occurs on during a particular month.
     * 
     * @param array $event A CalendarEvent array
     * @param string $month A date string that strtotime can interpret
     * @return array The array of the days during a month which an event occurs 
     */
    private function eventDays($event, $month) {
        $start_time = strtotime($event['CalendarEvent']['start_date']);
        $repeat = $event['CalendarEvent']['repeat'];
        
        if (!empty($event['CalendarEvent']['end_date'])) {
            $end_time = strtotime($event['CalendarEvent']['end_date']);
        }
        
        $start_date = date('Y-m-01', strtotime($month));
        $end_date = date('Y-m-t', strtotime($month));
        
        $days = array();
        $day_time = 60 * 60 * 24;
        
        if (is_numeric($repeat)) {
            $day_time *= $repeat;
        }
        
        for ($time = $start_time; $time <= strtotime($end_date); $time += $day_time) {
            if ($time >= strtotime($start_date)) {
                $repeat_end = strtotime($end_date);
                if (isset($end_time)) {
                    $repeat_end = $end_time;
                }
                
                if (is_numeric($repeat) || $this->isRepeatDay($time, $repeat, $start_time, $repeat_end)) {
                    $days[] = date('j', $time);
                }
            }
            
            if ($repeat == '0' || (isset($end_time) && $time > $end_time)) {
                break;
            }
        }
        
        return $days;
    }
    
    /**
     * Determine if for a particular day the event should occur
     * 
     * @param int $time System time value to check 
     * @param string $repeat Non-numeric repetition value
     * @param int $start_time System time of the day of the first event
     * @param int $end_time The last system time to check
     * @return boolean True if the event repeats on this day, false otherwise
     */
    private function isRepeatDay($time, $repeat, $start_time, $end_time) {        
        $interval = ' +1 day';
        switch($repeat) {
            case 'month-date':
                $interval = ' +1 month';
                break;
            case 'year-date':
                $interval = ' +1 year';
                break;
        }
        
        $test_date = date('Y-m-d', $start_time);
        $test_time = $start_time;
        while ($test_time <= $end_time) {
            if ($test_time == $time) {
                return true;
            }
            
            $test_time = strtotime($test_date . $interval);
            $test_date = date('Y-m-d', $test_time);
        }
        
        return false;
    }
    
    /**
     * Get the options for repeating schedules
     * 
     * @return array
     */
    public function repeatList() {
        return array(
            0 => 'None',
            1 => 'Daily',
            7 => 'Weekly',
            14 => 'Every Two Weeks',
            'month-date' => 'Monthly on Date',
            'year-date' => 'Yearly on Date',
        );
    }
    
    /**
     * Get the options for choosing a time
     * 
     * @return array
     */
    public function getTimes() {
        $times = array();
        for ($hour = 0; $hour < 24; $hour++) {
            for ($minute = 0; $minute < 60; $minute += 15) {
                $_hour = sprintf('%02s', $hour);
                $_minute = sprintf('%02s', $minute);
                $index = $_hour . ":" . $_minute . ":00";
                $time = mktime($hour, $minute);
                $times[$index] = date('g:i A', $time);
            }
        }
        
        return $times;
    }
}