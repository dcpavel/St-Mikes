<?php
/**
 * @property Newsletter $Newsletter 
 */
class NewslettersController extends AppController {
    public $name = 'Newsletters';
    
    public function beforeFilter() {
        $this->Auth->allow(array('view', 'index', 'download'));
        
        parent::beforeFilter();
    }
    
    public function index($id = null) {
        $file = null;
        if (is_numeric($id) && $id > 0) {
            $this->Newsletter->id = $id;
            $file = $this->Newsletter->field('file');
        } elseif (!$this->request->is('get')) {
            $this->Newsletter->id = $this->request->data['Newsletter']['newsletter'];
            $file = $this->Newsletter->field('file');
        }
        
        $this->set(compact('id', 'file'));
        $this->set(array(
            'newsletters' => $this->Newsletter->newsletterList(),
        ));
    }
    
    public function view($id) {
        $this->Newsletter->id = $id;
        
        $file = $this->request->host() . '/files/Newsletters/' . $this->Newsletter->field('file');
        
        $this->set(array(
            'file' => $file
        ));
        
        if ($this->request->is('ajax')) {
            $this->render('/Elements/Newsletters/view', 'ajax');
        }
    }
    
    public function download($id) {
        $this->Newsletter->id = $id;
        
        $file = $this->Newsletter->field('file');
        preg_match('/(?P<name>.*)\.(?P<ext>.*)/', $file, $matches);
        
        $this->viewClass = 'Media';
        $params = array(
            'id' => $file,
            'name' => $matches['name'],
            'download' => true,
            'extension' => $matches['ext'],
            'path' => 'files' . DS . 'Newsletters' . DS
        );
        
        $this->set($params);
    }
    
    public function admin_index() {
        $this->Newsletter->recursive = 0;
        
        if (!$this->request->is('get')) {
            $this->paginate = $this->Newsletter->searchOptions($this->request->data['Newsletter']);
        }
        
        $this->set(array(
            'newsletters' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->Newsletter->recursive = 0;
            $this->request->data = $this->Newsletter->findById($id);
        } else {
            if ($this->Newsletter->save($this->request->data)) {
                $this->Session->setFlash('Newsletter saved.');
                $this->redirect(array('action' => 'admin_edit', $this->Newsletter->id));
            } else {
                $this->Session->setFlash($this->Newsletter->invalidFields());
            }
        }
    }
    
    public function admin_status($id) {
        $this->Newsletter->saveField('status', $status);

        if ($this->Newsletter->changeStatus($id)) {
            $position = $this->Newsletter->field('position');
            $status_message = ($this->Newsletter->field('status')) ? 'active' : 'inactive';
            $this->Session->setFlash("$position has been made $status_message.");
        } else {
            $this->Session->setFlash("There was a problem changing the position's status");
        }
        
        $this->redirect($this->referer());
    }
    
    public function uploader_index() {
        
    }
}