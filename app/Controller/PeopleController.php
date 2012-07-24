<?php
/**
 * @property Person $Person 
 */

class PeopleController extends AppController {
    public $name = 'People';
    
    public $actsAs = array('Containable');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_index() {
        $model = 'Person';
        if ($this->request->is('post')) {
            $options = $this->Person->searchOptions($this->request->data['Person']);
            if (!empty($options['model'])) {
                $model = $options['model'];
                unset($options['model']);
            }
            $this->paginate = $options;
        } else {
            $this->paginate = array('recursive' => 2);
        }
        
        $this->set(array(
            'people' => $this->paginate(),
            'positions' => $this->Person->Position->displayList($this->request->data['Person']['positionCategory']),
            'positionCategories' => $this->Person->Position->PositionCategory->displayList()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->request->data = $this->Person->findById($id);
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
    
    public function admin_status($id) {
        $values = $this->Person->find('first', array(
            'fields' => array(
                'Person.full_name', 'Person.status', 'Person.id'
            ),
            'conditions' => array(
                'Person.id' => $id
            ),
            'recursive' => 0
        ));
        list($title, $status, $tmp_id) = array_values($values['PositionCategory']);
        
        if (parent::admin_status($id)) {
            $message = ($status) ? "deactivated" : "activated";
            $this->Session->setFlash("$title has been $message.");
        } else {
            $this->Session->setFlash("There was a problem changing $title's status");
        }
        
        $this->redirect($this->referer());
    }
}