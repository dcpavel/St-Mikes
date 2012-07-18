<?php
/**
 * @property PositionCategory $PositionCategory
 */

class PositionCategoriesController extends AppController {
    public $name = 'PositionCategories';
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    public function admin_index() {
        $this->PositionCategory->recursive = 0;
        
        if ($this->request->is('post')) {
            $this->paginate = $this->PositionCategory->searchOptions($this->request->data['PositionCategory']);
        }
        
        $this->set(array(
            'groups' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->PositionCategory->recursive = 0;
            $this->request->data = $this->PositionCategory->findById($id);
        } else {
            if ($this->PositionCategory->save($this->request->data)) {
                $this->Session->setFlash('Group saved.');
                $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->Session->setFlash('Please fix the errors below.');
            }
        }
    }
    
    public function admin_status($id) {
        $values = $this->PositionCategory->find('first', array(
            'fields' => array(
                'PositionCategory.title', 'PositionCategory.status', 'PositionCategory.id'
            ),
            'conditions' => array(
                'PositionCategory.id' => $id
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