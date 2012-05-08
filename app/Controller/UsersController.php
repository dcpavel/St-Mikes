<?php
/**
 * @property User $User 
 */
class UsersController extends AppController {
    public $name = 'Users';    
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow(array('login', 'logout'));
    }
    
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('role') === 'admin') {
                    $this->Auth->loginRedirect = array(
                        'controller' => 'users',
                        'action' => 'index',
                        'admin' => true
                    );
                }

                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(
                        __('Your Username or Password is incorrect. Please try again'),
                        'default',
                        array(),
                        'auth'
                    );
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function admin_login() {
        $this->redirect(array('action' => 'login', 'admin' => false));
    }
    
    public function admin_logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function admin_index() {
        $this->User->recursive = 0;
        
        if (!$this->request->is('get')) {
            $search = $this->request->data['User']['Search'];
            
            $options = array(
                'conditions' => array(
                    'OR' => array(
                        'User.username LIKE' => "%$search%",
                        'User.role LIKE' => "%$search%"
                    )
                )
            );
            
            switch ($this->request->data['User']['Category']) {
                case 'username':
                    $options = array(
                        'conditions' => array(
                            'User.username LIKE' => "%$search%"
                        )
                    );
                    break;
                case 'role':
                    $options = array(
                        'conditions' => array(
                            'User.role LIKE' => "%$search%"
                        )
                    );
                    break;
            }
            
            $this->paginate = $options;
        }
        
        $this->set(array(
            'users' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->recursive = 0;
            $this->request->data = $this->User->findById($id);
            if (isset($this->request->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }
        } else {
            if (!empty($this->request->data['User']['id']) && empty($this->request->data['User']['password'])) {
                unset($this->request->data['User']['password']);
            }
            
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Data Saved');
                $this->redirect(array('action' => 'admin_edit', $this->User->id));
            }
        }
        
        $this->set(array(
            'roles' => $this->User->roles()
        ));
    }
    
    public function admin_status($id) {
        if ($id == $this->Auth->user('id')) {
            $this->Session->setFlash('You cannot deactivate yourself');
        } else {
            if ($this->User->changeStatus($id)) {
                $name = $this->User->field('username');
                $status_message = ($this->User->field('status')) ? 'active' : 'inactive';
                $this->Session->setFlash("$name has been made $status_message.");
            } else {
                $this->Session->setFlash("There was a problem changing the user's status");
            }
        }
        
        $this->redirect($this->referer());
    }
}