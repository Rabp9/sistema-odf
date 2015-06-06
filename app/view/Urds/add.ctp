<!-- File: /app/View/Urds/add.ctp -->
<?php 
    $this->assign("title", "URD's - Nuevo");
?>

<h2>URD's <small>Nuevo</small></h2>

<?php
    echo $this->Form->create("Urd", array("type" => "file"));
    echo $this->Html->para("lead", "Ingrese los datos del URD:");
    echo $this->Form->input("Departamento.id", array(
        "label" => "Departamento",
        "div" => "form-group",
        "class" => "form-control",
        "autofocus" => "autofocus",
        "options" => $departamentos,
        "empty" => "Selecciona uno"
    ));   
    echo $this->Form->input('provincias_id', array(
        "label" => "Provincia",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "select",
        "disabled" => true
    ));
    echo $this->Form->input("descripcion", array(
        "label" => "Descripción",
        "div" => "form-group",
        "class" => "form-control"
    ));
    echo $this->Form->input("latitud", array(
        "label" => "Latitud",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "number"
    ));
    echo $this->Form->input("longitud", array(
        "label" => "Longitud",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "number"
    ));
    echo $this->Form->input("direccion", array(
        "label" => "Dirección",
        "div" => "form-group",
        "class" => "form-control",
        "type" => "text"
    ));
    echo $this->Form->input("foto", array(
        "label" => "Foto",
        "div" => "formField",
        "class" => "form-control",
        "type" => "file"
    ));
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Registrar", array("class" => "btn btn-default"));
    echo $this->Form->end();
    echo $this->Html->link("Regresar a Lista URD's", array("controller" => "Urds", "action" => "index"));
?>

<?php
    $this->Js->get('#DepartamentoId')->event('change', 
        $this->Js->request(array(
            'controller'=>'Provincias',
            'action'=>'getByDepartamento'
        ), array(
            'update'=>'#UrdProvinciasId',
            'async' => true,
            'method' => 'post',
            'dataExpression'=>true,
            'data'=> $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            )),
            "success" => "$('#UrdProvinciasId').attr({disabled: false});"
        ))
    );
?>