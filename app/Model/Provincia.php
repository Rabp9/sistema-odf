<?php

/**
 * CakePHP Provincia
 * @author Roberto
 */
class Provincia extends AppModel {
    public $belongsTo = array(
        "Departamento" => array(
            "foreignKey" => "departamentos_id"
        )
    );
    
    public $hasMany = array(
        "Urd" => array(
            "foreignKey" => "provincias_id",
            "conditions" => array("Urd.estado" => 1)
        )
    );
    
    public $validate = array(       
        "id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            ),
        ),
        "departamentos_id" => array(
            "rule" => "notEmpty",
            "message" => "Debe seleccionar un Departamento"
        ),
        "descripcion" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            ),
            'alpha'=> array(
                "rule"      => "/^[a-zA-Z ]+$/i",
                "message"   => "Sólo letras permitidas"
            )
        ),
        "posicion_x" => array(
            "rule" => array("comparison", ">", 0),
            "message" => "Debe ser un número positivo"
        ),
        "posicion_y" => array(
            "rule" => array("comparison", ">", 0),
            "message" => "Debe ser un número positivo"
        ),
        "zoom" => array(
            "rule" => array("comparison", ">", 0),
            "message" => "Debe ser un número positivo"
        )
    );
}
