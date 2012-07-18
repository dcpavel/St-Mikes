<?php
/**
 * @property Person $Person 
 */

class PeopleController extends AppController {
    public $name = 'People';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_index() {
        $this->set(array(
            'people' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->Person->findById($id);
        } else {
            if ($this->Person->saveAll($this->request->data)) {
                $this->Session->setFlash('Person saved');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->Session->setFlash('Please fix the errors below');
            }
        }
        
        $this->set(array(
            'positionCategories' => $this->Person->Position->PositionCategory->displayList(),
            'positions' => $this->Person->Position->displayList()
        ));
    }
}