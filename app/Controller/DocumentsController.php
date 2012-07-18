<?php
/**
 * @property Document $Document 
 */
class DocumentsController extends AppController {
    public $name = 'Documents';
    
    public function beforeFilter() {
        $this->Auth->allow(array('view', 'index', 'download'));
        
        parent::beforeFilter();
    }
    
    public function newsletters($id = null) {
        $file = null;
        if (is_numeric($id) && $id > 0) {
            $this->Document->id = $id;
            $file = $this->Document->field('file');
        } elseif (!$this->request->is('get')) {
            $this->Document->id = $this->request->data['Newsletter']['newsletter'];
            $file = $this->Document->field('file');
        }
        
        $this->set(compact('id', 'file'));
        $this->set(array(
            'newsletters' => $this->Document->newsletterList(),
        ));
    }
    
    public function index($id = null) {
        
    }
    
    public function view($id) {
        $this->Document->id = $id;
        
        $file = $this->request->host() . '/files/Newsletters/' . $this->Document->field('file');
        
        $this->set(array(
            'file' => $file
        ));
        
        if ($this->request->is('ajax')) {
            $this->render('/Elements/Newsletters/view', 'ajax');
        }
    }
    
    public function download($id) {
        $this->Document->id = $id;
        
        $file = $this->Document->field('file');
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
        $this->Document->recursive = 0;
        
        if (!$this->request->is('get')) {
            $this->paginate = $this->Document->searchOptions($this->request->data['Document']);
        }
        
        $this->set(array(
            'documents' => $this->paginate(),
            'categories' => $this->Document->DocumentCategory->categoryList()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->Document->recursive = 0;
            $this->request->data = $this->Document->findById($id);
        } else {
            if ($this->Document->save($this->request->data)) {
                $this->Session->setFlash('Newsletter saved.');
                $this->redirect(array('action' => 'admin_edit', $this->Document->id));
            } else {
                $this->Session->setFlash($this->Document->invalidFields());
            }
        }
    }
    
    public function admin_status($id) {
        $this->Document->saveField('status', $status);

        if ($this->Document->changeStatus($id)) {
            $position = $this->Document->field('position');
            $status_message = ($this->Document->field('status')) ? 'active' : 'inactive';
            $this->Session->setFlash("$position has been made $status_message.");
        } else {
            $this->Session->setFlash("There was a problem changing the position's status");
        }
        
        $this->redirect($this->referer());
    }
    
    public function uploader_index() {
        
    }
}