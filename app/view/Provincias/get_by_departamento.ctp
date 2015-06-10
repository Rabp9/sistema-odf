<!-- file path View/Provincias/get_by_departamento.ctp -->

<?php
    echo $this->Form->input('Urd.provincias_id', array(
        "label" => "Provincia",
        "div" => "form-group",
        "class" => "form-control",
        "autofocus" => "autofocus",
        "options" => $provincias,
        "empty" => "Selecciona uno"
    ));    
?>