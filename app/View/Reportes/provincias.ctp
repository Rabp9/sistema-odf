<!-- File: /app/View/Reportes/provincias.ctp -->
<?php 
    $this->assign("title", "Reportes - Provincias");
?>
<?php
    echo $this->Form->create("Reporte", array("action" => "provincias_post"));
?>
<h2>Reportes <small>Provincias</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Departamento</th>
                <th>Cantidad URD's</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($provincias as $provincia) { ?>
            <tr>
                <td><?php echo $provincia["Provincia"]["id"]; ?></td>
                <td><?php echo $provincia["Provincia"]["descripcion"]; ?></td>
                <td><?php echo $provincia["Departamento"]["descripcion"]; ?></td>
                <td><?php echo sizeof($provincia["Urd"]); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-download")) . " Exportar a Excel", array("class" => "btn btn-default"));
    echo $this->Form->end();
?>