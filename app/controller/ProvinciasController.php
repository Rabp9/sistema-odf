<?php

/**
 * CakePHP ProvinciasController
 * @author Roberto
 */
class ProvinciasController extends AppController {

    public function index() {
        $this->layout = "admin";

        $this->set("provincias", $this->Provincia->find("all", array(
            'conditions' => array('Provincia.estado' => '1')
        )));
    }
    
    public function add() {
        $this->layout = "admin";

        $this->set("departamentos", $this->Provincia->Departamento->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if ($this->request->is("post")) {
            $this->Provincia->create();
            if ($this->Provincia->save($this->request->data)) {
                $this->Session->setFlash(__("La Provincia ha sido registrada correctamente."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No fue posible registrar la provincia."), "flash_bootstrap");
        }
    }
    
    public function view($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("Provincia inválida"));
        }
        $provincia = $this->Provincia->findById($id);
        if (!$provincia) {
            throw new NotFoundException(__("Provincia inválida"));
        } 
        $this->set("provincia", $provincia);
    }
          
    public function edit($id = null) {
        $this->layout = "admin";

        $this->set("departamentos", $this->Provincia->Departamento->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if (!$id) {
            throw new NotFoundException(__("Provincia inválida"));
        }
        $provincia = $this->Provincia->findById($id);
        if (!$provincia) {
            throw new NotFoundException(__("Provincia inválida"));
        }
        if ($this->request->is(array("post", "put"))) {
            $this->Provincia->id = $id;
            if ($this->Provincia->save($this->request->data)) {
                $this->Session->setFlash(__("La provincia ha sido actualizada."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No es posible actualizar la provincia."), "flash_bootstrap");
        }
        if (!$this->request->data) {
            $this->request->data = $provincia;
        }
    }
        
    public function view_map($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("Provincia inválida"));
        }
        $provincia = $this->Provincia->findById($id);
        if (!$provincia) {
            throw new NotFoundException(__("Provincia inválida"));
        } 
        $this->set("provincia", $provincia);
    }
    
    public function getByDepartamento() {
        $departamentos_id = $this->request->data['Departamento']['id'];

        $this->set("provincias", $this->Provincia->find("list", array(
            "fields" => array("Provincia.id", "Provincia.descripcion"),
            'conditions' => array('Provincia.estado' => '1', "Provincia.departamentos_id" => $departamentos_id)
        )));
            
        $this->layout = 'ajax';
    }
        
    public function delete($id) {
        if ($this->request->is("get")) {
            throw new MethodNotAllowedException();
        }
        $this->Provincia->id = $id;
        if ($this->Provincia->saveField("estado", 2)) {
            $this->Session->setFlash(__("El Provincia de código: %s ha sido eliminado.", h($id)), "flash_bootstrap");
            return $this->redirect(array("action" => "index"));
        }
    }
        
    public function menu_provincias() {
        if(empty($this->request->params["requested"])) {
            throw new ForbiddenException();
        }
        
        return $this->Provincia->find("all", array(
            "conditions" => array("Provincia.estado" => 1)
        ));
    }
}
