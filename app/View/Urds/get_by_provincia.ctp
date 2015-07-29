<!-- file path View/Urds/get_by_provincia.ctp -->

<?php
    echo $this->Form->input('Odf.urds_id', array(
        "label" => "URD",
        "div" => "form-group",
        "class" => "form-control",
        "options" => $urds,
        "empty" => "Selecciona uno",
        "required" => true
    ));    
?>