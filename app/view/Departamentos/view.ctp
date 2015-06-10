<!-- File: /app/View/Departamentos/view.ctp -->
<?php 
    $this->assign("title", "Departamentos - Ver");
?>

<h2>Departamentos <small>Ver</small></h2>

<dl class="dl-horizontal">
    <dt>Código</dt>
    <dd><?php echo $departamento["Departamento"]["id"]; ?></dd>
    <dt>Descripción</dt>
    <dd><?php echo $departamento["Departamento"]["descripcion"]; ?></dd>
    <dt>Posición X</dt>
    <dd><?php echo $departamento["Departamento"]["posicion_x"]; ?></dd>
    <dt>Posición Y</dt>
    <dd><?php echo $departamento["Departamento"]["posicion_y"]; ?></dd>
    <dt>Mapa</dt>
    <dd>
        <?php if($departamento["Departamento"]["mapa"] != null) 
            echo "<a data-toggle='modal' data-target='#mdlMapa' href='#'>" . $this->Html->image($departamento["Departamento"]["mapa"], array(
                "width" => "300px"
            )) . "</a>"; 
        else
            echo "Sin Imagen";
        ?>
    </dd>
</dl>
<h4>Lista de Provincias de <?php echo $departamento["Departamento"]["descripcion"]; ?></h4>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departamento["Provincia"] as $provincia) { ?>
            <tr>
                <td><?php echo $provincia["id"]; ?></td>
                <td><?php echo $this->Html->link(
                        $provincia["descripcion"], array(
                            "controller" => "Provincias",
                            "action" => "view", $provincia["id"]
                        ));
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $this->Html->link("Regresar a Lista Departamentos", array("controller" => "Departamentos", "action" => "index")); ?>

<div class="modal fade" id="mdlMapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mapa - <?php echo $departamento["Departamento"]["descripcion"]; ?></h4>
            </div>
            <div class="modal-body" id="dvCursos">
                <?php echo $this->Html->image($departamento["Departamento"]["mapa"], array(
                    "width" => "100%"
                )); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>