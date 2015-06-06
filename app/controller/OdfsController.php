<?php

/**
 * CakePHP OdfsController
 * @author Roberto
 */
class OdfsController extends AppController {
    public $uses = array("Odf", "Be", "Bc", "Conectorfibra");
    
    public function index() {
        $this->layout = "admin";
        
        $this->set("odfs", $this->Odf->find("all", array(
            'conditions' => array('Odf.estado' => '1')
        )));
    }
    
    public function add() {
        $this->layout = "admin";
        
        $this->set("departamentos", $this->Odf->Urd->Provincia->Departamento->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if ($this->request->is(array("post", "put"))) {
            $ds = $this->Odf->getDataSource();
            $ds->begin();
            $this->request->data["Odf"]["numeracion"] = $this->Odf->getNumeracion($this->request->data["Odf"]["urds_id"]);
            if ($this->Odf->save($this->request->data)) {
                $r = true; 
                $numeracion_be = 1;
                $numeracion_bc = 72;
                $tam_bc = $this->request->data["Odf"]["tam_bc"];
                $numeracion_tubofibra = 1;
                foreach($this->request->data["Tubofibra"] as $tubofibra) {
                    $tubofibra["id"] = null;
                    $tubofibra["odfs_id"] = $this->Odf->id;
                    $tubofibra["numeracion"] = $numeracion_tubofibra;
                    if(!$this->Odf->Tubofibra->save($tubofibra)) {
                        $r = false;
                    }
                    
                    $n_be = $tubofibra["numero_cables"] / 16;
                    $aux_n_be = $tubofibra["numero_cables"];
                    $cont_bc = 0;
                    $numeracion_tubofibra++;
                    $numeracion_conectorfibra = 1;
                    
                    for($i = 0; $i < $n_be; $i++) {
                        $numero_cables = $aux_n_be == 8 ? 8 : 16;
                        $be["tubofibras_id"] = $this->Odf->Tubofibra->id;
                        $be["numero_cables"] = $numero_cables;
                        $be["numeracion"] = $numeracion_be;
                        $be["id"] = null;
                        
                        if(!$this->Be->save($be)) {
                            $r = false;
                        }
                        
                        $aux_n_be -= 16;
                        $numeracion_be++;
                        
                        for($j = 0; $j < $numero_cables / $tam_bc; $j++) {
                            $aux_numero_cables = $numero_cables < $tam_bc ? $numero_cables : $tam_bc;
                            
                            $bc["bes_id"] = $this->Be->id;
                            $bc["numero_cables"] = $aux_numero_cables;
                            $bc["numeracion"] = $numeracion_bc;           
                            $bc["id"] = null;
                            if(!$this->Bc->save($bc)) {
                                $r = false;
                            }
                            
                            $numeracion_bc--;
                            $cont_bc++;
                            
                            for($k = 0; $k < $aux_numero_cables; $k++) {
                                $conectorfibra["bcs_id"] = $this->Bc->id;
                                $conectorfibra["tipos_id"] = 1; // LIBRE
                                $conectorfibra["gestores_id"] = 1; // SIN GESTOR
                                $conectorfibra["numeracion"] = $numeracion_conectorfibra;
                                $numeracion_conectorfibra++;
                                $conectorfibra["id"] = null;
                                $conectorfibra["descripcion"] = "LIBRE";
                                if(!$this->Conectorfibra->save($conectorfibra)) {
                                    $r = false;
                                }
                            }
                        }
                    }
                }
                if($r) {
                    $ds->commit();
                    $this->Session->setFlash(__("El ODF ha sido registrado correctamente."), "flash_bootstrap");
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__("El ODF no ha sido registrado correctamente."), "flash_bootstrap");
            }
            /*
            if ($this->Odf->save($this->request->data)) {
                $r = true;
                $numeracion_be = 1;
                $numeracion_bc = 72;
                $numeracion_tubofibra = 1;
                foreach($this->request->data["Tubofibra"] as $tubofibra) {
                    $tubofibra["id"] = null;
                    $tubofibra["odfs_id"] = $this->Odf->id;
                    $tubofibra["numeracion"] = $numeracion_tubofibra;
                    $numeracion_tubofibra++;
                    if(!$this->Odf->Tubofibra->save($tubofibra)) {
                        $r = false;
                    }
                    $n_be = $tubofibra["numero_cables"] == 8 ? 1 : $tubofibra["numero_cables"] / 16;
                    $numeracion_conectorfibra = 1;
                    $aux_cables = $tubofibra["numero_cables"];
                    for($i = 0; $i < $n_be; $i++) {
                        $be["tubofibras_id"] = $this->Odf->Tubofibra->id;
                        $be["numero_cables"] = $aux_cables >= 16 ? 16 : 8;
                        $aux_cables -= 16;
                        $be["numeracion"] = $numeracion_be;
                        $be["id"] = null;
                        $numeracion_be++;
                        if(!$this->Be->save($be)) {
                            $r = false;
                        }
                        $n_bc = $this->request->data["Odf"]["tam_bc"] == 16 ? 1 : ($be["numero_cables"] % 16 == 8 ? 1 : 2);
                        for($j = 0; $j < $n_bc; $j++) {
                            $bc["bes_id"] = $this->Be->id;
                            $bc["numero_cables"] = $this->request->data["Odf"]["tam_bc"] == 16 ? $be["numero_cables"] : 8;
                            $bc["numeracion"] = $numeracion_bc;
                            $bc["id"] = null;
                            $numeracion_bc--;
                            if(!$this->Bc->save($bc)) {
                                $r = false;
                            }
                            
                            for($k = 0; $k < ($this->request->data["Odf"]["tam_bc"] == 16 ? $bc["numero_cables"] : 8); $k++) {
                                $conectorfibra["bcs_id"] = $this->Bc->id;
                                $conectorfibra["tipos_id"] = 1; // LIBRE
                                $conectorfibra["gestores_id"] = 1; // SIN GESTOR
                                $conectorfibra["numeracion"] = $numeracion_conectorfibra;
                                $numeracion_conectorfibra++;
                                $conectorfibra["id"] = null;
                                $conectorfibra["descripcion"] = "LIBRE";
                                if(!$this->Conectorfibra->save($conectorfibra)) {
                                    $r = false;
                                }
                            }
                        }
                    }
                }
                if($r) {
                    $ds->commit();
                    $this->Session->setFlash(__("El ODF ha sido registrado correctamente."), "flash_bootstrap");
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__("El ODF no ha sido registrado correctamente."), "flash_bootstrap");
            }
            */
        }
    }
     
    public function view($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("ODF inválido"));
        }
        $this->Odf->recursive = 4;
        $odf = $this->Odf->findById($id);
        if (!$odf) {
            throw new NotFoundException(__("ODF inválido"));
        } 
        $this->set("odf", $odf);
        
        $this->set("tipos", $this->Conectorfibra->Tipo->find("list", array(
            "fields" => array("id", "descripcion")
        )));
                
        $this->set("gestores", $this->Conectorfibra->Gestor->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        $this->set("notas", $this->Odf->Nota->find("all", array(
            "conditions" => array("odfs_id" => $odf["Odf"]["id"])
        )));
        
        if($this->request->is(array("post", "put"))) {
            $user = $this->Auth->user();
            $this->request->data["Nota"]["users_id"] = $user["id"];
            $this->Odf->Nota->create();
            if ($this->Odf->Nota->save($this->request->data)) {
                $this->Session->setFlash(__("La Nota ha sido registrada correctamente."), "flash_bootstrap");
                return $this->redirect(array("action" => "view", $odf["Odf"]["id"]));
            }
            $this->Session->setFlash(__("No fue posible registrar la nota."), "flash_bootstrap");

        }
    }
    
    public function administrar($id = null) {
        $this->layout = "admin";

        if (!$id) {
            throw new NotFoundException(__("ODF inválido"));
        }
        $this->Odf->recursive = 4;
        $odf = $this->Odf->findById($id);
        if (!$odf) {
            throw new NotFoundException(__("ODF inválido"));
        } 
        $this->set("odf", $odf);
        
        $this->set("tipos", $this->Conectorfibra->Tipo->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        $this->set("gestores", $this->Conectorfibra->Gestor->find("list", array(
            "fields" => array("id", "descripcion")
        )));
        
        if($this->request->is(array("post", "put"))) {
            $ds = $this->Conectorfibra->getDataSource();
            $ds->begin();
            $idConectorfibra = $this->request->data["Conectorfibra"]["id"];
            $this->Conectorfibra->id = $idConectorfibra;
            $this->Conectorfibra->read();
            if($this->request->data["Conectorfibra"]["gestores_id"] == 1) {
                $this->request->data["Conectorfibra"]["gestor_ubicacion"] = "";
            }
            if ($this->Conectorfibra->save($this->request->data)) {
                $conectorfibra = $this->Conectorfibra->find("first", array(
                   "conditions" => array(
                       "Conectorfibra.bcs_id" => $this->Conectorfibra->field("bcs_id"),
                       "Conectorfibra.numeracion" => $this->Conectorfibra->field("numeracion") % 2 == 1 ? $this->Conectorfibra->field("numeracion") + 1 : $this->Conectorfibra->field("numeracion") - 1 
                    ) 
                ));
                $this->Conectorfibra->id = $conectorfibra["Conectorfibra"]["id"];
                if ($this->Conectorfibra->saveField("intermedio", $this->request->data["Conectorfibra"]["intermedio"])) {
                    $ds->commit();
                    $this->Session->setFlash(__("El Conector de Fibra ha sido actualizado."), "flash_bootstrap");
                    return $this->redirect(array("action" => "administrar", $id));
                }
            }
            $this->Session->setFlash(__("No es posible actualizar el Conector de Fibra."), "flash_bootstrap");
        }
    }
    
    public function delete($id) {
        if ($this->request->is("get")) {
            throw new MethodNotAllowedException();
        }
        $this->Odf->id = $id;
        if ($this->Odf->saveField("estado", 2)) {
            $this->Session->setFlash(__("El ODF de código: %s ha sido eliminado.", h($id)), "flash_bootstrap");
            return $this->redirect(array("action" => "index"));
        }
    }
}
