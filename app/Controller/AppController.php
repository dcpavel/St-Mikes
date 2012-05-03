<?php
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
    
    /**
     * @TODO: Restrict access for other user types than 'admin' 
     */
}