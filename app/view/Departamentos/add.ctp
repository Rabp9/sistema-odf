<!-- File: /app/View/Departamentos/add.ctp -->
<?php 
    $this->assign("title", "Departamentos - Nuevo");
?>

<h2>Departamentos <small>Nuevo</small></h2>

<?php
    echo $this->Form->create("Departamento", array("type" => "file"));
    echo $this->Html->para("lead", "Ingrese los datos del Departamento:");
    echo $this->Form->input("descripcion", array(
        "label" => "Descripción",
        "div" => "form-group",
        "class" => "form-control",
        "autofocus" => "autofocus"
    ));
    echo $this->Form->input("posicion_x", array(
        "label" => "Posición X",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "number"
    ));
    echo $this->Form->input("posicion_y", array(
        "label" => "Posición Y",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "number"
    ));
    echo $this->Form->input("mapa", array(
        "label" => "Imagen de Mapa",
        "div" => "formField",
        "class" => "form-control",
        "type" => "file"
    ));
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Registrar", array("class" => "btn btn-default"));
    echo $this->Form->end();
    echo $this->Html->link("Regresar a Lista Departamentos", array("controller" => "Departamentos", "action" => "index"));
?>