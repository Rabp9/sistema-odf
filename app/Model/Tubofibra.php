<?php

/**
 * CakePHP Tubofibra
 * @author Roberto
 */
class Tubofibra extends AppModel {
    public $belongsTo = array(
        "Odf" => array(
            "foreignKey" => "odfs_id"
        )
    );
      
    public $hasMany = array(
        "Be" => array(
            "foreignKey" => "tubofibras_id"
        )
    );
}
