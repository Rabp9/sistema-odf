<!-- File: /app/View/Reportes/urds.ctp -->
<?php 
    $this->assign("title", "Reportes - URD's");
?>
<?php
    echo $this->Form->create("Reporte", array("action" => "urds_post"));
?>
<h2>Reportes  <small>URD's</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Dirección</th>
                <th>Provincia</th>
                <th>Departamento</th>
                <th>Cantidad ODF's</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($urds as $urd) { ?>
            <tr>
                <td><?php echo $urd["Urd"]["id"]; ?></td>
                <td><?php echo $urd["Urd"]["descripcion"]; ?></td>
                <td><?php echo $urd["Urd"]["direccion"]; ?></td>
                <td><?php echo $urd["Provincia"]["descripcion"]; ?></td>
                <td><?php echo $urd["Provincia"]["Departamento"]["descripcion"]; ?></td>
                <td><?php echo sizeof($urd["Odf"]); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-download")) . " Exportar a Excel", array("class" => "btn btn-default"));
    echo $this->Form->end();
?>