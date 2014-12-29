<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Event\Event;
use Cake\Controller\Controller;
use Cake\Utility\String;
use Cake\Utility\Debugger;
use Cake\Utility\Time;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Components this controller uses.
 *
 * Component names should not include the `Component` suffix. Components
 * declared in subclasses will be merged with components declared here.
 *
 * @var array
 */
    public $helpers = ['Color', 'Session'];
    public $components = [
        'Flash',
        'Session',
        'RequestHandler',
        'Auth' => [
            'loginAction' => [
            'controller' => 'Users',
            'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'pages',
                'action' => 'dashboard',
                'index'
            ],
            'logoutRedirect' => [
                'controller' => 'users',
                'action' => 'login'
            ],
          /*  'authorize'=> ['Controller'], */
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password']
                ]
            ] 
        ],
        'Paginator'
    ];
        
    public function admin_index() {
                $this->layout = 'admin';
                $this->paginate = array(
                    'limit' => 10,
                    'order' => array('id' => 'asc')
                );
                $this->set('paginate', $this->paginate($this->request['controller']));
                $this->set('model', $users);

    }
    public function isAuthorized($user) {
	    // Admin can access every action
	    if (isset($user['id']) && $user['id'] == 1) {
	        return true;
	    }

	    // Default deny
	    return false;
	}
    public function beforeFilter(Event $event) {
        //$this->Auth->allow(['index', 'view', 'upload']);
        $this->Auth->config('authenticate', ['Form']);
        $serverTime = Time::now();
        $authUser = $this->Auth->user();
        if($authUser){
        $this->loadModel('Users');
        $authUser = $this->Users->get($authUser['id']);
        //$manager = $this->Users->get($authUser['manager_id'])->extract(['full_name']);
        $this->set('authUser', $authUser);
        //$this->set('manager', $manager);
        $this->set('serverTime', $serverTime);
        }
    }
    public function upload($tmp, $file, $folder){
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $url = 'files' . DS . $folder . DS . String::uuid() . '.' . $ext;
        move_uploaded_file($tmp, WWW_ROOT . $url);
        return $url;
        
    }

    /* Convert hexdec color string to rgb(a) string */

    public function hex2rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
              return $default; 

        //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }
}
?>