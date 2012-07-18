<?php
/**
 * @property Newsletter $Newsletter 
 */
class NewslettersController extends AppController {
    
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
        $values = $this->Document->find('first', array(
            'fields' => array(
                'Document.title', 'Document.status', 'Document.id'
            ),
            'conditions' => array(
                'Document.id' => $id
            ),
            'recursive' => 0
        ));
        list($title, $status, $tmp_id) = array_values($values['Document']);
        
        if (parent::admin_status($id)) {
            $message = ($status) ? 'deactived' : 'actived';
            $this->Session->setFlash("$title has been $message.");
        } else {
            $this->Session->setFlash("There was a problem changing the $title's status");
        }
        
        $this->redirect($this->referer());
    }
    
    public function uploader_index() {
        
    }
}