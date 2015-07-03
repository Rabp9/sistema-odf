<!-- File: /app/View/Reportes/departamentos.ctp -->
<?php 
    $this->assign("title", "Reportes - Departamentos");
?>
<?php
    echo $this->Form->create("Reporte", array("action" => "departamentos_post"));
?>
<h2>Reportes <small>Departamentos</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Cantidad de Provincias</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departamentos as $departamento) { ?>
            <tr>
                <td><?php echo $departamento["Departamento"]["id"]; ?></td>
                <td><?php echo $departamento["Departamento"]["descripcion"]; ?></td>
                <td><?php echo sizeof($departamento["Provincia"]); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-download")) . " Exportar a Excel", array("class" => "btn btn-default"));
    echo $this->Form->end();
?>