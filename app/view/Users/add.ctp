<!-- File: /app/View/Users/add.ctp -->
<?php 
    $this->assign("title", "Usuarios - Nuevo");
?>

<h2>Usuarios <small>Nuevo</small></h2>

<?php
    echo $this->Form->create("User");
    echo $this->Html->para("lead", "Ingrese los datos del Usuario:");
    echo $this->Form->input("username", array(
        "label" => "Username",
        "div" => "form-group",
        "class" => "form-control",
        "autofocus" => "autofocus"
    ));
    echo $this->Form->input("password", array(
        "label" => "Password",
        "div" => "form-group",
        "class" => "form-control"
    ));
    echo $this->Form->input("groups_id", array(
        "label" => "Grupos",
        "div" => "form-group",
        "class" => "form-control",
        "options" => $groups,
        "empty" => "Selecciona uno"
    ));
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Registrar", array("class" => "btn btn-default"));
    echo $this->Form->end();
    echo $this->Html->link("Regresar a Lista Usuarios", array("controller" => "Users", "action" => "index"));
?>