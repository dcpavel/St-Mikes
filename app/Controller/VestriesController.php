<?php
/**
 * @property Vestry $Vestry
 */
class VestriesController extends AppController {
    
    public function beforeFilter() {
        $this->Auth->allow(array('index', 'view'));
        
        parent::beforeFilter();
    }
    
    public function admin_index() {
        $this->Vestry->recursive = 0;
        
        if (!$this->request->is('get')) {
            $this->paginate = $this->Vestry->searchOptions($this->request->data['Search']);            
        }
        
        $this->set(array(
            'members' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        $this->Vestry->id = $id;
        
        if ($this->request->is('get')) {
            $this->Vestry->recursive = 0;
            $this->data = $this->Vestry->findById($id);
        } else {
            if ($this->Vestry->save($this->request->data)) {
                $this->Session->setFlash('Vestry member saved.');
                $this->redirect(array('action' => 'admin_edit', $this->Vestry->id));
            } else {
                $this->Session->setFlash($this->Vestry->invalidFields());
            }
        }
    }
    
    public function admin_status($id) {
        $this->Vestry->saveField('status', $status);

        if ($this->Vestry->changeStatus($id)) {
            $position = $this->Vestry->field('position');
            $status_message = ($this->Vestry->field('status')) ? 'active' : 'inactive';
            $this->Session->setFlash("$position has been made $status_message.");
        } else {
            $this->Session->setFlash("There was a problem changing the position's status");
        }
        
        $this->redirect($this->referer());
    }
    
    public function index($id = null) {
        $members = $this->Vestry->positionsList();
        
        if ($id !== null) {
            $this->view($id);
        } else {
            $this->view(key($members));
        }
        
        $this->set(array(
            'members' => $members
        ));
    }
    
    public function view($id) {
        $this->Vestry->recursive = 0;
        
        $this->set(array(
            'detail' => $this->Vestry->findById($id)
        ));
        
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Elements/Vestries/view');
        }
    }
}