<?php

/**
 * CakePHP Be
 * @author Roberto
 */
class Be extends AppModel {
    public $belongsTo = array(
        "Tubofibra" => array(
            "foreignKey" => "tubofibras_id"
        )
    );
    
    public $hasMany = array(
        "Bc" => array(
            "foreignKey" => "bes_id"
        )
    );
    
}
