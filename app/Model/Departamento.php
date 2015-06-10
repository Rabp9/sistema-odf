<?php

/**
 * CakePHP Departamento
 * @author Roberto
 */
class Departamento extends AppModel {  
    
    public $hasMany = array(
        "Provincia" => array(
            "foreignKey" => "departamentos_id",
            "conditions" => array("Provincia.estado" => 1)
        )
    );
      
    public $validate = array(
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
        "mapa" => array(
            "rule" => array("extension", array("jpeg", "jpg", "png")),
            "required" => "create",
            "allowEmpty" => true,
            "on" => array("create", "update"),
            "last" => true,
            "message" => "Por favor seleccione una imagen con el formato correcto (jpeg, png, jpg)"
        )
    );
    
    function beforeValidate($options = array()){
        if(empty($this->data[$this->alias]['id']))
            return true;
        else {
            if(empty($this->data[$this->alias]["mapa"]["name"])){
                unset($this->data[$this->alias]["mapa"]);
            }
            return true; //this is required, otherwise validation will always fail
        }
    }
}
