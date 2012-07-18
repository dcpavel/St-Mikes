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
    
    public function get_positions() {
        $this->layout = 'ajax';
        
        $this->set(array(
            'positions' => $this->Position->displayList($this->request->data['Person']['positionCategory'])
        ));
    }
}