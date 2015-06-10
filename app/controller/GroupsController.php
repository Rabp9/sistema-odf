<!-- File: /app/Controller/GroupsController.php -->

<?php
class GroupsController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow("index", "add");
    }
    
    public function index() {

        $this->Group->recursive = 0;
        $this->set('groups', $this->paginate());
    }

    public function view($id = null) {
        $this->layout = "admin";

        $this->Group->id = $id;
        if (!$this->Group->exists()) {
            throw new NotFoundException(__('Grupo inválido'));
        }
        $this->set('group', $this->Group->read(null, $id));
    }

    public function add() {

        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Session->setFlash(__('El grupo ha sido registrado correctamente'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__("No fue posible registrar al grupo."), "flash_bootstrap");
        }
    }
}