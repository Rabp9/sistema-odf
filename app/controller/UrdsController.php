<?php

/**
 * CakePHP UrdsController
 * @author Roberto
 */
class UrdsController extends AppController {

    public function index() {
        $this->layout = "admin";

        $this->set("urds", $this->Urd->find("all", array(
            'conditions' => array('Urd.estado' => '1')
        )));
    }
    
    public function add() {
        $this->layout = "admin";

        $this->set("departamentos", $this->Urd->Provincia->Departamento->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if ($this->request->is("post")) {
            $this->Urd->create();
            
            $filename = $this->request->data["Urd"]["foto"]["name"];
            $tmp_name = $this->request->data['Urd']["foto"]["tmp_name"];
            unset($this->request->data["Urd"]["foto"]);
            $this->request->data["Urd"]["foto"] = $filename;

            if ($this->Urd->save($this->request->data)) {   
                move_uploaded_file($tmp_name, WWW_ROOT . "img" . DS . "URD" . DS . $filename);  
                $this->Session->setFlash(__("El URD ha sido registrado correctamente."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No fue posible registrar el URD."), "flash_bootstrap");
        }
    }
    
    public function view($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("URD inválida"));
        }
        $urd = $this->Urd->findById($id);
        if (!$urd) {
            throw new NotFoundException(__("URD inválida"));
        } 
        $this->set("urd", $urd);
    }   
       
    public function edit($id = null) {
        $this->layout = "admin";

        $this->set("departamentos", $this->Urd->Provincia->Departamento->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if (!$id) {
            throw new NotFoundException(__("Provincia inválida"));
        }
        $urd = $this->Urd->findById($id);
        $provincia = $this->Urd->Provincia->findById($urd["Provincia"]["id"]);
        
        $this->set("provincias", $this->Urd->Provincia->find("list", array(
            "fields" => array("id", "descripcion"),
            "conditions" => array("departamentos_id" => $provincia["Departamento"]["id"])
        )));
        if (!$urd) {
            throw new NotFoundException(__("Urd inválida"));
        }
        if ($this->request->is(array("post", "put"))) {
            
            $filename = $this->request->data["Urd"]["foto"]["name"];
            if($filename != "") {
                unlink(WWW_ROOT . DS . "img" . DS . "URD" . DS . $urd["Urd"]["foto"]);
                $tmp_name = $this->request->data['Urd']["foto"]["tmp_name"];
                unset($this->request->data["Urd"]["foto"]);
                $this->request->data["Urd"]["foto"] = $filename;
            } else
                $this->request->data["Urd"]["foto"] = $urd["Urd"]["foto"];
            
            $this->Urd->id = $id;
            if ($this->Urd->save($this->request->data)) {       
                if($filename != "") 
                    move_uploaded_file($tmp_name, WWW_ROOT . "img" . DS . "URD" . DS. $filename);  
                $this->Session->setFlash(__("La URS ha sido actualizada."), "flash_bootstrap");
                return $this->redirect(array("action" => "index"));
            }
            $this->Session->setFlash(__("No es posible actualizar la URD."), "flash_bootstrap");
        }
        if (!$this->request->data) {
            $this->request->data = $urd;
            $this->request->data["Departamento"]["id"] = $provincia["Provincia"]["departamentos_id"];
        }
    }
    
    public function getByProvincia() {
        $provincias_id = $this->request->data['Provincia']['id'];

        $this->set("urds", $this->Urd->find("list", array(
            "fields" => array("Urd.id", "Urd.descripcion"),
            'conditions' => array('Urd.estado' => '1', "Urd.provincias_id" => $provincias_id)
        )));
            
        $this->layout = 'ajax';
    }
    
    public function delete($id) {
        if ($this->request->is("get")) {
            throw new MethodNotAllowedException();
        }
        $this->Urd->id = $id;
        if ($this->Urd->saveField("estado", 2)) {
            $this->Session->setFlash(__("El URD de código: %s ha sido eliminado.", h($id)), "flash_bootstrap");
            return $this->redirect(array("action" => "index"));
        }
    }
}
