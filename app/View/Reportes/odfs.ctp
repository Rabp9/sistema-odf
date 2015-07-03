<!-- File: /app/View/Reportes/odfs.ctp -->
<?php 
    $this->assign("title", "Reportes - ODF's");
?>
<?php
    echo $this->Form->create("Reporte", array("action" => "odfs_post"));
?>
<h2>Reportes <small>ODF's</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>URD</th>
                <th>Provincia</th>
                <th>Departamento</th>
                <th>Numeración</th>
                <th>N. Cables</th>
                <th>Tam. Base de Conector</th>
                <th>N. Tubos de Fibra</th>
                <th>Conectores de Fibra Libres</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($odfs as $odf) { ?>
            <tr>
                <td><?php echo $odf["Odf"]["id"]; ?></td>
                <td><?php echo $odf["Urd"]["descripcion"]; ?></td>
                <td><?php echo $odf["Urd"]["Provincia"]["descripcion"]; ?></td>
                <td><?php echo $odf["Urd"]["Provincia"]["Departamento"]["descripcion"]; ?></td>
                <td><?php echo $odf["Odf"]["numeracion"]; ?></td>
                <td><?php echo $odf["Odf"]["numero_cables"]; ?></td>
                <td><?php echo $odf["Odf"]["tam_bc"]; ?></td>
                <td><?php echo sizeof($odf["Tubofibra"]); ?></td>
                <td><?php echo $odf["Odf"]["n_conectores_libres"]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
    echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-download")) . " Exportar a Excel", array("class" => "btn btn-default"));
    echo $this->Form->end();
?>