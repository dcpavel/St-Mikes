<?php
/**
 * @property DocumentCategory $DocumentCategories
 */
class DocumentCategoriesController extends AppController {
    public $name = 'DocumentCategories';
    
    public function beforeFilter() {
        
        parent::beforeFilter();
    }
    
    public function admin_index() {
        $this->DocumentCategory->recursive = 0;
        
        if (!$this->request->is('get')) {
            $search = $this->data['DocumentCategory']['Search'];
            
            $this->paginate = array(
                'conditions' => array(
                    'DocumentCategory.title LIKE' => "%$search%"
                )
            );
        }
        
        $this->set(array(
            'categories' => $this->paginate()
        ));
    }
    
    public function admin_edit($id = null) {
        if ($this->request->is('get')) {
            $this->DocumentCategory->recursive = 0;
            $this->request->data = $this->DocumentCategory->findById($id);
        } else {
            if ($this->DocumentCategory->save($this->request->data)) {
                $this->Session->setFlash('Newsletter saved.');
                $this->redirect(array('action' => 'admin_edit', $this->DocumentCategory->id));
            } else {
                $this->Session->setFlash($this->DocumentCategory->invalidFields());
            }
        }
    }
    
    public function admin_status($id) {
        $this->DocumentCategory->saveField('status', $status);

        if ($this->DocumentCategory->changeStatus($id)) {
            $position = $this->DocumentCategory->field('position');
            $status_message = ($this->DocumentCategory->field('status')) ? 'active' : 'inactive';
            $this->Session->setFlash("$position has been made $status_message.");
        } else {
            $this->Session->setFlash("There was a problem changing the position's status");
        }
        
        $this->redirect($this->referer());
    }
}