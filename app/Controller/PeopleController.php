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
        debug($this->referer());
        $this->set(array(
            'people' => $this->paginate(),
            'positions' => $this->Person->Position->displayList(),
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
}