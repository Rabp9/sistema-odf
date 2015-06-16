<!-- File: /app/View/Users/change_password.ctp -->
<?php 
    $this->assign("title", "Usuarios - Cambiar Passowrd");
?>

<h2>Usuarios <small>Cambiar Password</small></h2>

<?php
    echo $this->Form->create("User");
    echo $this->Form->input("old_password", array(
        "label" => "Password Anterior",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "password",
        "autofocus" => "autofocus"
    ));
    echo $this->Form->input("new_password", array(
        "label" => "Password Nuevo",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "password"
    ));
    echo $this->Form->input("new_password_confirm", array(
        "label" => "Confirmar Password Nuevo",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "password"
    ));
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Cambiar Password", array("class" => "btn btn-default"));
    echo $this->Form->end();
?>