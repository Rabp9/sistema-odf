<!-- File: /app/View/Departamentos/index_map.ctp -->
<?php 
    $this->assign("title", "Departamentos - Lista en Mapa");
?>

<?php
    echo $this->Html->css("mapa");
?>
<style>
    <?php
        foreach ($departamentos as $departamento) {
            echo ".departamento-" . $departamento["Departamento"]["id"] . " {";
            echo "position: relative;";
            echo "left: " . $departamento["Departamento"]["posicion_x"] . "px;";
            echo "top: " . $departamento["Departamento"]["posicion_y"] . "px;";
            echo "}";
        }
    ?>
</style>
<h2>Departamentos <small>Lista en Mapa</small></h2>
<div class="mapa">
    <?php
        foreach ($departamentos as $departamento) {
            echo $this->Html->link($this->Html->image("icono-departamento.png"), array(
                "controller" => "Departamentos",
                "action" => "view_map", $departamento["Departamento"]["id"]
            ) , array(
                "class" => "departamento-" . $departamento["Departamento"]["id"],
                "escape" => false,
                "data-toggle" => "tooltip",
                "data-placement" => "top",
                "title" => $departamento["Departamento"]["descripcion"]
            ));
        }
    ?>
</div>
<?php
    $this->Html->scriptStart(array('inline' => false));
?>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
<?php
    $this->Html->scriptEnd();
?>