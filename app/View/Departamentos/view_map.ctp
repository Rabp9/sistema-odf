<!-- File: /app/View/Departamentos/view_map.ctp -->
<?php 
    $this->assign("title", "Departamentos - Vista en Mapa");
?>

<style>
    .mapa {
        background-image: url("../../img/<?php echo $departamento["Departamento"]["mapa"]; ?>");
        height: 600px;
        width: 600px;
    }
    
    <?php
        foreach ($departamento["Provincia"] as $provincia) {
            echo ".provincia-" . $provincia["id"] . " {";
            echo "position: relative;";
            echo "left: " . $provincia["posicion_x"] . "px;";
            echo "top: " . $provincia["posicion_y"] . "px;";
            echo "}";
        }
    ?>
</style>
<h2>Departamento <?php echo $departamento["Departamento"]["descripcion"]; ?> <small>Vista en Mapa</small></h2>
<div class="mapa">  
    <?php
        foreach ($departamento["Provincia"] as $provincia) {
            echo $this->Html->link($this->Html->image("icono-provincia.png"), array(
                "controller" => "Provincias",
                "action" => "view_map", $provincia["id"]
            ) , array(
                "class" => "provincia-" . $provincia["id"],
                "escape" => false,
                "data-toggle" => "tooltip",
                "data-placement" => "top",
                "title" => $provincia["descripcion"]
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
<?php echo $this->Html->link("Regresar a Lista en Mapa Departamentos", array("controller" => "Departamentos", "action" => "index_map")); ?>
