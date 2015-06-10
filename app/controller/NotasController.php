<?php

/**
 * CakePHP NotasController
 * @author Roberto
 */
class NotasController extends AppController {
    
    public function ultimas_notas() {
        return $this->Nota->find("all", array(
            "limit" => 10,
            "order" => array("Nota.created DESC")
        ));
    }
}
