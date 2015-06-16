<!-- File: /app/View/Urds/view.ctp -->
<?php 
    $this->assign("title", "URD's - Ver");
?>

<h2>URD's <small>Ver</small></h2>

<dl class="dl-horizontal">
    <dt>Código</dt>
    <dd><?php echo $urd["Urd"]["id"]; ?></dd>
    <dt>Descripción</dt>
    <dd><?php echo $urd["Urd"]["descripcion"]; ?></dd>
    <dt>Provincia</dt>
    <dd><?php echo $urd["Provincia"]["descripcion"]; ?></dd>
    <dt>Latitud</dt>
    <dd><?php echo $urd["Urd"]["latitud"]; ?></dd>
    <dt>Longitud</dt>
    <dd><?php echo $urd["Urd"]["longitud"]; ?></dd>
    <dt>Dirección</dt>
    <dd><?php echo $urd["Urd"]["direccion"]; ?></dd>    
    <dt>Foto</dt>
    <dd>
        <?php if($urd["Urd"]["foto"] != null) 
            echo "<a data-toggle='modal' data-target='#mdlFoto' href='#'>" . $this->Html->image("URD/" . $urd["Urd"]["foto"], array(
                "width" => "300px"
            )) . "</a>"; 
        else
            echo "Sin Foto";
        ?>
    </dd>
</dl>
<h4>Lista de Odf's de URD <?php echo $urd["Urd"]["descripcion"]; ?></h4>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($urd["Odf"] as $odf) { ?>
            <tr>
                <td><?php echo $odf["id"]; ?></td>
                <td><?php echo $odf["numero_cables"]; ?></td>
                <td><?php echo $this->Html->link(
                        "Detalle", array(
                            "controller" => "Odfs",
                            "action" => "view", $odf["id"]
                        ));
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $this->Html->link("Regresar a Lista URD's", array("controller" => "Urds", "action" => "index")); ?>
<br/>
<?php echo $this->Html->link("Regresar a Vista en Mapa Provincia", array("controller" => "Provincias", "action" => "view_map", $urd["Provincia"]["id"])); ?>

<div class="modal fade" id="mdlFoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Foto - <?php echo $urd["Urd"]["descripcion"]; ?></h4>
            </div>
            <div class="modal-body" id="dvCursos">
                <?php echo $this->Html->image("URD/" . $urd["Urd"]["foto"], array(
                    "width" => "100%"
                )); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>