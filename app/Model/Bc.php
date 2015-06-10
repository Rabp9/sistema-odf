<?php

/**
 * CakePHP Bc
 * @author Roberto
 */
class Bc extends AppModel {
    public $belongsTo = array(
        "Be" => array(
            "foreignKey" => "bes_id"
        )
    );
       
    public $hasMany = array(
        "Conectorfibra" => array(
            "foreignKey" => "bcs_id"
        )
    );
}
