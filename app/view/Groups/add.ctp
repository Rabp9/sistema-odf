<!-- File: /app/View/Groups/add.ctp -->
<?php 
    $this->assign("title", "Grupos - Nuevo");
?>

<h2>Grupos <small>Nuevo</small></h2>

<?php
    echo $this->Form->create("Group");
    echo $this->Html->para("lead", "Ingrese los datos del Grupo:");
    echo $this->Form->input("descripcion", array(
        "label" => "Descripción",
        "div" => "form-group",
        "class" => "form-control"
    ));
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Registrar", array("class" => "btn btn-default"));
    echo $this->Form->end();
    echo $this->Html->link("Regresar a Lista Grupos", array("controller" => "Groups", "action" => "index"));
?>