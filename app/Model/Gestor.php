<?php

/**
 * CakePHP Gestor
 * @author Roberto
 */
class Gestor extends AppModel {
    public $useTable = "gestores";

    public $hasMany = array(
        "Conectorfibra" => array(
            "foreignKey" => "gestores_id"
        )
    );
}
