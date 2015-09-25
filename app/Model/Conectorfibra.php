<?php

/**
 * CakePHP ConectorFibra
 * @author Roberto
 */
class Conectorfibra extends AppModel {
    public $belongsTo = array(
        "Bc" => array(
            "foreignKey" => "bcs_id"
        ),
        "Tipo" => array(
            "foreignKey" => "tipos_id"
        )
    );
    
    public $validate = array(
        "descripcion" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            )
        ),
        "tipos_id" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            )
        )
    );
}
