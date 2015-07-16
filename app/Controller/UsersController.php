<!-- File: /app/Controller/UsersController.php -->

<?php

/**
 * CakePHP ProvinciasController
 * @author Roberto
 */

class UsersController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("index", "initDB", "add", "login");
    }

    public function initDB() {
        $group = $this->User->Group;

        // Administrador
        $group->id = 1;
        $this->Acl->allow($group, 'controllers');
        $this->Acl->deny($group, 'controllers/Groups/add');

        // Técnico
        $group->id = 2;
        $this->Acl->allow($group, 'controllers');
        
        $this->Acl->deny($group, 'controllers/Departamentos/add');
        $this->Acl->deny($group, 'controllers/Departamentos/edit');
        $this->Acl->deny($group, 'controllers/Departamentos/delete');
        
        $this->Acl->deny($group, 'controllers/Groups/add');
        
        $this->Acl->deny($group, 'controllers/Odfs/add');
        $this->Acl->deny($group, 'controllers/Odfs/administrar');
        $this->Acl->deny($group, 'controllers/Odfs/delete');
        
        $this->Acl->deny($group, 'controllers/Provincias/add');
        $this->Acl->deny($group, 'controllers/Provincias/edit');
        $this->Acl->deny($group, 'controllers/Provincias/delete');

        $this->Acl->deny($group, 'controllers/Urds/add');
        $this->Acl->deny($group, 'controllers/Urds/edit');
        $this->Acl->deny($group, 'controllers/Urds/delete');
        
        $this->Acl->deny($group, 'controllers/Users/index');
        $this->Acl->deny($group, 'controllers/Users/add');
        $this->Acl->deny($group, 'controllers/Users/edit');
        $this->Acl->deny($group, 'controllers/Users/delete');
        
        // we add an exit to avoid an ugly "missing views" error message
        echo "all done";
        exit;
    }

    public function index() {
        $this->layout = "admin";
        
        $this->set("users", $this->User->find("all", array(
            'conditions' => array('User.estado' => '1')
        )));
    }

    public function view($id = null) {
        $this->layout = "admin";

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario inválido'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function add() {
        $this->layout = "admin";
        
        $this->set("groups", $this->User->Group->find("list", array(
            "fields" => array("Group.id", "Group.descripcion")
        )));

        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->saveAssociated($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido registrado correctamente'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__("No fue posible registrar el usuario."), "flash_bootstrap");
        }
    }

    public function edit($id = null) {
        $this->layout = "admin";

        $this->set("groups", $this->User->Group->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if (!$id) {
            throw new NotFoundException(__("Usuario inválida"));
        }
        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__("Usuario inválida"));
        }
        if ($this->request->is(array("post", "put"))) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__("El usuario ha sido actualizado."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No es posible actualizar el usuaario."), "flash_bootstrap");
        }
        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function delete($id) {
        if ($this->request->is("get")) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if ($this->User->saveField("estado", 2)) {
            $this->Session->setFlash(__("El Usuario de código: %s ha sido eliminado.", h($id)), "flash_bootstrap");
            return $this->redirect(array("action" => "index"));
        }
    }

    public function login() {
        $this->layout = false;
        if ($this->request->is(array("post", "put"))) {
            if ($this->Auth->login())
                return $this->redirect($this->Auth->redirectUrl());
            $this->Session->setFlash(__('Nombre de Usuario o password incorrecto, inténtelo nuevamente'), "flash_bootstrap");
        }
    }

    public function logout() {
        if($this->Auth->user()) {
            $this->redirect($this->Auth->logout());
        }
        else {
            $this->redirect(array("controller" => "users", "action" => "login"));
            $this->Session->setFlash(__('Not logged in'), 'default', array(), 'auth');
        }
    }
    
    public function manage_usuario() {
        if(empty($this->request->params["requested"])) {
            throw new ForbiddenException();
        }
        
        $user = $this->Auth->user();
        return $user;
    }
    
    public function change_password() {
        $this->layout = "admin";       
        
        if ($this->request->is(array("post", "put"))) {
            
            $user = $this->User->find("first", array(
                "conditions" => array(
                    "User.id" => $this->Auth->user()["id"]
                ),
                "fields" => array("password")
            ));
            $storedHash = $user['User']['password'];
            $newHash = Security::hash($this->request->data['User']['old_password'], 'blowfish', $storedHash);
            if($storedHash == $newHash) {
                if($this->request->data["User"]["new_password"] != $this->request->data["User"]["new_password_confirm"]) {
                    $this->Session->setFlash(__("Los password ingresados no coinciden"), "flash_bootstrap");
                    return;
                }
                $this->User->id = $this->Auth->user()["id"];
                if ($this->User->saveField("password", $this->request->data["User"]["new_password"]) ) {
                    $this->Session->setFlash(__("El password ha sido actualizado correctamente."), "flash_bootstrap");
                    return $this->redirect(array("controller" => "Pages", "action" => "display", "home"));
                }
            }
            $this->Session->setFlash(__("El password anterior no coincide"), "flash_bootstrap");
        }
    }
}