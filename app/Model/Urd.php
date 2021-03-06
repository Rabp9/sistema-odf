<?php

/**
 * CakePHP Urds
 * @author Roberto
 */
class Urd extends AppModel {
    public $belongsTo = array(
        "Provincia" => array(
            "foreignKey" => "provincias_id"
        )
    );
    
    public $hasMany = array(
        "Odf" => array(
            "foreignKey" => "urds_id"
        )
    );
    
    public $validate = array(
        "id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            ),
        ),
        "provincias_id" => array(
            "rule" => "notEmpty",
            "message" => "Debe seleccionar una Provincia"
        ),
        "descripcion" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            ),
            'alpha'=> array(
                "rule"      => "/^[a-zA-Z .]+$/i",
                "message"   => "Sólo letras permitidas"
            )
        ),
        "latitud" => array(
            "rule" => array("decimal"),
            "message" => "La Latitud debe ser un número decimal"
        ),
        "longitud" => array(
            "rule" => array("decimal"),
            "message" => "La Longitud debe ser un número decimal"
        ),
        "foto" => array(
            "rule" => array("extension", array("jpeg", "jpg", "png")),
            "required" => "create",
            "allowEmpty" => true,
            "on" => array("create", "update"),
            "last" => true,
            "message" => "Por favor seleccione una imagen con el formato correcto (jpeg, png, jpg)"
        )
    );
}
