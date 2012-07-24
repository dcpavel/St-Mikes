<?php
/**
 * @property Position $Position 
 */

class PositionsController extends AppController {
    public $name = 'Positions';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_index() {
        if ($this->request->is('post')) {
            $this->paginate = $this->Position->searchOptions($this->request->data['Position']);
        }
        
        $this->set(array(
            'positions' => $this->paginate(),
            'positionCategories' => $this->Position->PositionCategory->displayList()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->Position->recursive = 0;
            $this->Position->findById($id);
        } else {
           if ($this->Position->save($this->request->data)) {
               $this->Session->setFlash('Position saved.');
               $this->redirect(array('action' => 'admin_index'));
           } else {
               $this->Session->setFlash('Please fix the errors below.');
           }
        }
        
        $this->set(array(
            'positionCategories' => $this->Position->PositionCategory->displayList()
        ));
    }
    
    public function admin_status($id) {
        $values = $this->Position->find('first', array(
            'fields' => array(
                'Position.title', 'Position.status', 'Position.id'
            ),
            'conditions' => array(
                'Position.id' => $id
            ),
            'recursive' => 0
        ));
        list($title, $status, $tmp_id) = array_values($values['Position']);
        
        if (parent::admin_status($id)) {
            $message = ($status) ? "deactivated" : "activated";
            $this->Session->setFlash("$title has been $message.");
        } else {
            $this->Session->setFlash("There was a problem changing $title's status");
        }
        
        $this->redirect($this->referer());
    }
    
    public function get_positions() {
        $this->layout = 'ajax';
        
        $this->set(array(
            'referer' => $this->referer(),
            'positions' => $this->Position->displayList($this->request->data['Person']['positionCategory'])
        ));
    }
}