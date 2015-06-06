<!-- File: /app/View/Provincias/add.ctp -->
<?php 
    $this->assign("title", "Provincias - Nuevo");
?>

<h2>Provincias <small>Nuevo</small></h2>

<?php
    echo $this->Form->create("Provincia");
    echo $this->Html->para("lead", "Ingrese los datos de la Provincia:");
    echo $this->Form->input("departamentos_id", array(
        "label" => "Departamento",
        "div" => "form-group",
        "class" => "form-control",
        "autofocus" => "autofocus",
        "options" => $departamentos,
        "empty" => "Seleccione un Departamento"
    ));
    echo $this->Form->input("descripcion", array(
        "label" => "Descripción",
        "div" => "form-group",
        "class" => "form-control"
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
    echo $this->Form->input("latitud", array(
        "label" => "Latitud",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "text"
    ));
    echo $this->Form->input("longitud", array(
        "label" => "Longitud",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "text"
    ));
    echo $this->Form->input("zoom", array(
        "label" => "Zoom",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "number"
    ));
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Registrar", array("class" => "btn btn-default"));
    echo $this->Form->end();
    echo $this->Html->link("Regresar a Lista Provincias", array("controller" => "Provincias", "action" => "index"));
?>