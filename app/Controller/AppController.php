<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Acl',
        'Session',
        'Auth' => array(
            'authError' => "No tiene los permisos necesarios para realizar esta acción",
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        )
    );
    
    public $helpers = array("Html", "Form", "Session", "JS");

    public function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->loginAction = array(
          'controller' => 'Users',
          'action' => 'login'
        );
        $this->Auth->logoutRedirect = array(
          'controller' => 'Users',
          'action' => 'login'
        );
        $this->Auth->loginRedirect = array(
          "controller" => "Pages",
          "action" => "display", "home"
        );
        $this->Auth->flash["element"] = "flash_bootstrap";
    }
}
