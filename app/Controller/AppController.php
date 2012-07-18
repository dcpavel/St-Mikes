<?php
/**
 * Description of AppHelper
 *
 * @author Darren
 */
App::uses('Controller', 'Controller');
class AppController extends Controller {    
    public $helpers = array(
        'Js' => array('Jquery'),
        'Html' => array('className' => 'AppHtml'),
        'Session',
        'Form'
    );
    
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'homilies', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authenticate' => array(
                'Form' => array(
                    'scope' => array('User.status' => true)
                )
            )
        )
    );
    
    public function beforeFilter() {
        $this->viewClass = 'Theme';
        
        if ($this->Auth->user('role')) {
            $this->theme = ucfirst($this->Auth->user('role'));
        }
        
        $this->Auth->allow('index');
        
        parent::beforeFilter();
    }
    
    public function admin_status($id) {
        $model = $this->{$this->modelClass};
        
        $model->id = $id;
        
        return $model->saveField('status', !$model->field('status'));
    }
}