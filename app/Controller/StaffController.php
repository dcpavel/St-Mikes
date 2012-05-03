<?php
/**
 * @property Staff $Staff 
 */
class StaffController extends AppController {
    public $name = 'Staff';
    
    public function beforeFilter() {
        $this->Auth->allow(array('view', 'index'));
        
        parent::beforeFilter();
    }
    
    public function view($id) {
        $this->Staff->recursive = 0;
        
        $this->set(array(
            'detail' => $this->Staff->findById($id)
        ));
        
        if ($this->request->is('ajax')) {
            $this->layout = 'ajax';
            $this->render('/Elements/Staff/view');
        }
    }
    
    public function admin_index() {
        $this->Staff->recursive = 0;
        
        if (!$this->request->is('get')) {
            $search = $this->request->data['Staff']['Search'];
            
            $options = array(
                'conditions' => array(
                    'OR' => array(
                        'Staff.name LIKE' => "%$search%",
                        'Staff.position LIKE' => "%$search%"
                    )
                )
            );
            
            switch ($this->request->data['Staff']['Category']) {
                case 'name':
                    $options = array(
                        'conditions' => array(
                            'Staff.name LIKE' => "%$search%"
                        )
                    );
                    break;
                case 'position':
                    $options = array(
                        'conditions' => array(
                            'Staff.position LIKE' => "%$search%"
                        )
                    );
                    break;
            }
            
            $this->paginate = $options;            
        }
        
        $this->set(array(
            'staff' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        $this->Staff->id = $id;
        
        if ($this->request->is('get')) {
            $this->Staff->recursive = 0;
            $this->data = $this->Staff->findById($id);
        } else {
            if ($this->Staff->save($this->request->data)) {
                $this->Session->setFlash('Staff member saved.');
                $this->redirect(array('action' => 'admin_edit', $this->Staff->id));
            } else {
                $this->Session->setFlash($this->Staff->invalidFields());
            }
        }
    }
    
    public function admin_status($id) {
        $this->Staff->saveField('status', $status);

        if ($this->Staff->changeStatus($id)) {
            $position = $this->Staff->field('position');
            $status_message = ($this->Staff->field('status')) ? 'active' : 'inactive';
            $this->Session->setFlash("$position has been made $status_message.");
        } else {
            $this->Session->setFlash("There was a problem changing the position's status");
        }
        
        $this->redirect($this->referer());
    }
    
    public function index($id = null) {
        $staff = $this->Staff->positionsList();
        
        if ($id !== null) {
            $this->view($id);
        } else {
            $this->view(key($staff));
        }
        
        $this->set(array(
            'staff' => $staff
        ));
    }
}