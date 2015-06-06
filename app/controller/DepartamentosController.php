<?php

/**
 * CakePHP DepartamentosController
 * @author Roberto
 */
class DepartamentosController extends AppController {
    
    public function index() {
        $this->layout = "admin";
        
        $this->set("departamentos", $this->Departamento->find("all", array(
            'conditions' => array('Departamento.estado' => '1')
        )));
    }
       
    public function add() {
        $this->layout = "admin";

        if ($this->request->is("post")) {
            $this->Departamento->create();

            $filename = $this->request->data["Departamento"]["mapa"]["name"];
            $tmp_name = $this->request->data['Departamento']["mapa"]["tmp_name"];
            unset($this->request->data["Departamento"]["mapa"]);
            $this->request->data["Departamento"]["mapa"] = $filename;

            if ($this->Departamento->save($this->request->data)) { 
                move_uploaded_file($tmp_name, WWW_ROOT . "img" . DS . $filename);  
                $this->Session->setFlash(__("El Departamento ha sido registrado correctamente."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No fue posible registrar el Departamento."), "flash_bootstrap");
        }
    }
    
    public function view($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("Departamento inválido"));
        }
        $departamento = $this->Departamento->findById($id);
        if (!$departamento) {
            throw new NotFoundException(__("Departamento inválido"));
        } 
        $this->set("departamento", $departamento);
    }
          
    public function edit($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("Departamento inválido"));
        }
        $departamento = $this->Departamento->findById($id);
        if (!$departamento) {
            throw new NotFoundException(__("Departamento inválido"));
        }
        if ($this->request->is(array("post", "put"))) {      

            $filename = $this->request->data["Departamento"]["mapa"]["name"];
            if($filename != "") {
                unlink(WWW_ROOT . DS . "img" . DS . $departamento["Departamento"]["mapa"]);
                $tmp_name = $this->request->data['Departamento']["mapa"]["tmp_name"];
                unset($this->request->data["Departamento"]["mapa"]);
                $this->request->data["Departamento"]["mapa"] = $filename;
            } else
                $this->request->data["Departamento"]["mapa"] = $departamento["Departamento"]["mapa"];
            
            $this->Departamento->id = $id;
            if ($this->Departamento->save($this->request->data)) {     
                if($filename != "") 
                    move_uploaded_file($tmp_name, WWW_ROOT . "img" . DS . $filename);  
                $this->Session->setFlash(__("El Departamento ha sido actualizado."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No es posible actualizar el Departamento."), "flash_bootstrap");
        }
        if (!$this->request->data) {
            $this->request->data = $departamento;
        }
    }
    
    public function index_map() {
        $this->layout = "admin";
        
        $this->set("departamentos", $this->Departamento->find("all", array(
            'conditions' => array('Departamento.estado' => '1')
        )));
    }
    
    public function view_map($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("Departamento inválido"));
        }
        $departamento = $this->Departamento->findById($id);
        if (!$departamento) {
            throw new NotFoundException(__("Departamento inválido"));
        } 
        $this->set("departamento", $departamento);
    }
    
    public function delete($id) {
        if ($this->request->is("get")) {
            throw new MethodNotAllowedException();
        }
        $this->Departamento->id = $id;
        if ($this->Departamento->saveField("estado", 2)) {
            $this->Session->setFlash(__("El Departamento de código: %s ha sido eliminado.", h($id)), "flash_bootstrap");
            return $this->redirect(array("action" => "index"));
        }
    }
    
    public function menu_departamentos() {
        if(empty($this->request->params["requested"])) {
            throw new ForbiddenException();
        }
        
        return $this->Departamento->find("all", array(
            "conditions" => array("estado" => 1)
        ));
    }
}
