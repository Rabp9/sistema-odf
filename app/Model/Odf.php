<?php

/**
 * CakePHP Odf
 * @author Roberto
 */
class Odf extends AppModel {
    public $hasMany = array(
        "Tubofibra" => array(
            "foreignKey" => "odfs_id",
            "order" => array("Tubofibra.numeracion ASC")
        ), 
        "Nota" => array(
            "foreignKey" => "odfs_id"
        )
    );
      
    public $belongsTo = array(
        "Urd" => array(
            "foreignKey" => "urds_id"
        )
    );   
    
    public $validate = array(
        "urds_id" => array(
            "rule" => "notEmpty",
            "message" => "Debe seleccionar un URD"
        ),
        "numero_cables" => array(
            "rule" => "naturalNumber",
            "message" => "Debe ser un nùmero"
        )
    );
    
    public function getNumeracion($urds_id) {
        $cantidad = $this->query("SELECT count(*) 'cantidad' FROM odfs where estado = '1' AND urds_id = $urds_id");
        $cantidad = $cantidad[0][0]["cantidad"];
        return $cantidad + 1;
    }
}
