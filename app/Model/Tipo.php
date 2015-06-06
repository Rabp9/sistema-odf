<?php

/**
 * CakePHP Tipo
 * @author Roberto
 */
class Tipo extends AppModel {

    public $hasMany = array(
        "Conectorfibra" => array(
            "foreignKey" => "tipos_id"
        )
    );
}
