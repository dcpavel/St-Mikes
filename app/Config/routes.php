<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
    
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Static pages, so that we don't have the /pages/ portion
 */
        $staticPages = array();
        $staticList = implode('|', $staticPages);
        Router::connect('/:static', array(
                'plugin' => false,
                'controller' => 'pages',
                'action' => 'display'
            ), array(
                'static' => $staticList,
                'pass' => array('static')
            )
        );
        
/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
    
/**
 * Custom routes 
 */

    Router::connect('/clergy/:action/*', array('controller' => 'staff'));
    Router::connect('/admin/clergy/:action/*', array('controller' => 'staff', 'prefix' => 'admin'));
    
    Router::connect('/music/:action/*', array('controller' => 'choirs'));
    
    Router::connect('/holydays/:action/*', array('controller' => 'holidays'));
    
    Router::connect('/education/:action/*', array('controller' => 'lessons'));
    
    Router::connect('/communication/:action/*', array('controller' => 'libraries'));
    
    Router::connect('/evangilism/:action/*', array('controller' => 'evangilisms'));
    
    Router::connect('/vestry/:action/*', array('controller' => 'vestries'));