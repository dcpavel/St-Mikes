<?php
/**
 * @property Calendar $Calendar
 * @property CalendarEvent $CalendarEvent 
 */
class CalendarsController extends AppController {
    
    public $uses = array('Calendar', 'CalendarEvent');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow(array('index', 'view'));
    }
    
    public function index($date = null, $calendar = null) {
        if (!$this->request->is('get')) {
            $url = array(
                $date,
                $this->request->data['Calendar']['id']
            );
            $this->redirect($url);
        }
        
        $date = new DateTime($date);
        $date = $date->modify('first day of');
        $this->set(array(
            'date' => $date,
            'events' => $this->CalendarEvent->getEvents($calendar, $date->format('01-m-Y')),
            'calendars' => $this->Calendar->find('list', array(
                    'conditions' => array(
                        'Calendar.status' => true
                    )
                )),
        ));
    }
    
    public function view($date, $id) {
        $this->set(array(
            'date' => $date,
            'event' => $this->CalendarEvent->findById($id)
        ));
    }
    
    public function save() {
        
    }
    
    public function admin_index($date = 'now', $calendar = null) {
        if (!$this->request->is('get')) {
            $url = array(
                $date,
                $this->request->data['Calendar']['id']
            );
            $this->redirect($url);
        }
        
        $date = new DateTime($date);
        $date = $date->modify('first day of');
        $this->set(array(
            'date' => $date,
            'events' => $this->CalendarEvent->getEvents($calendar, $date->format('01-m-Y')),
            'calendars' => $this->Calendar->find('list', array(
                    'conditions' => array(
                        'Calendar.status' => true
                    )
                )),
        ));
        
    }
    
    public function admin_edit_event($date_id = null) {
        if ($this->request->is('get')) {
            if (is_numeric($date_id)) {
                $this->request->data = $this->CalendarEvent->findById($date_id);
            } else {
                $this->request->data = array(
                    'CalendarEvent' => array(
                        'start_date' => date('Y-m-d', strtotime($date_id))
                    )
                );
            }
        } else {
            if ($this->CalendarEvent->save($this->request->data)) {
                $this->Session->setFlash('Event Saved');
                $this->redirect(array(
                    'action' => 'admin_edit_event',
                    $this->CalendarEvent->id
                ));
            }
        }
        
        $this->set(array(
            'calendars' => $this->Calendar->find('list'),
            'times' => $this->CalendarEvent->getTimes(),
            'repeat' => $this->CalendarEvent->repeatList()
        ));
    }
    
    public function admin_edit_calendar($id = null) {
        if ($this->request->is('get')) {
            $this->request->data = $this->Calendar->findById($id);
        } else {
            if ($this->Calendar->save($this->request->data)) {
                $this->Session->setFlash('Calendar Saved');
                $this->redirect(array('action' => 'admin_edit_calendar', $this->Calendar->id));
            }
        }
        
        $this->set(array(
            'colors' => $this->Calendar->getColors()
        ));
    }
}