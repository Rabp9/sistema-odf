<!-- File: /app/View/Provincias/view.ctp -->
<?php 
    $this->assign("title", "Provincias - Ver");
?>

<h2>Provincias <small>Ver</small></h2>

<dl class="dl-horizontal">
    <dt>Código</dt>
    <dd><?php echo $provincia["Provincia"]["id"]; ?></dd>
    <dt>Descripción</dt>
    <dd><?php echo $provincia["Provincia"]["descripcion"]; ?></dd>
    <dt>Departamento</dt>
    <dd><?php echo $provincia["Departamento"]["descripcion"]; ?></dd>
    <dt>Posición X</dt>
    <dd><?php echo $provincia["Provincia"]["posicion_x"]; ?></dd>
    <dt>Posición Y</dt>
    <dd><?php echo $provincia["Provincia"]["posicion_y"]; ?></dd>
    <dt>Latitud</dt>
    <dd><?php echo $provincia["Provincia"]["latitud"]; ?></dd>
    <dt>Longitud</dt>
    <dd><?php echo $provincia["Provincia"]["longitud"]; ?></dd>
    <dt>Zoom</dt>
    <dd><?php echo $provincia["Provincia"]["zoom"]; ?></dd>
    <dt>Nº de URD's</dt>
    <dd><?php echo sizeof($provincia["Urd"]); ?></dd>
</dl>
<h4>Lista de URD's de <?php echo $provincia["Provincia"]["descripcion"]; ?></h4>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($provincia["Urd"] as $urd) { ?>
            <tr>
                <td><?php echo $urd["id"]; ?></td>
                <td><?php echo $this->Html->link(
                        $urd["descripcion"], array(
                            "controller" => "Urds",
                            "action" => "view", $urd["id"]
                        ));
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $this->Html->link("Regresar a Lista Provincias", array("controller" => "Provincias", "action" => "index")); ?>
<br/>
<?php echo $this->Html->link("Regresar a Vista en Mapa Departamento", array("controller" => "Departamentos", "action" => "view_map", $provincia["Departamento"]["id"])); ?>
