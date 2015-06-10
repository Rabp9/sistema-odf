<?php

/**
 * CakePHP Nota
 * @author Roberto
 */
class Nota extends AppModel {
      
    public $belongsTo = array(
        "Odf" => array(
            "foreignKey" => "odfs_id"
        ),
        "User" => array(
            "foreignKey" => "users_id"
        ),
    );   
    
    public $validate = array(
        "asunto" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            )
        ),
        "cuerpo" => array(
            "notEmpty" => array(
                "rule" => "notEmpty",
                "message" => "No puede estar vacio"
            )
        )
    );
}
