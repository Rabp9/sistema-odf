<!-- File: /app/View/Odfs/index.ctp -->
<?php 
    $this->assign("title", "ODFs - Lista");
?>

<h2>ODFs <small>Lista</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Numeración en URD</th>
                <th>URD</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($odfs as $odf) { ?>
            <tr>
                <td><?php echo $odf["Odf"]["id"]; ?></td>
                <td><?php echo $odf["Odf"]["numeracion"]; ?></td>
                <td><?php echo $odf["Urd"]["descripcion"]; ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-th-list"></span> Acción
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation">
                                <?php
                                    echo $this->Html->link(
                                        $this->Html->tag("span", "", array("class" => "glyphicon glyphicon-zoom-in")) .
                                        " Ver",
                                        array("controller" => "Odfs", "action" => "view", $odf["Odf"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Html->link(
                                        $this->Html->tag("span", "", array("class" => "glyphicon glyphicon-pencil")) .
                                        " Administrar",
                                        array("controller" => "Odfs", "action" => "administrar", $odf["Odf"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Form->postLink($this->Html->tag("span", "", array(
                                        "class" => "glyphicon glyphicon-trash")) . " Eliminar",
                                        array("controller" => "Odfs", "action" => "delete", $odf["Odf"]["id"]),
                                        array("confirm" => "¿Estás seguro?", "escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Html->link(
                                        $this->Html->tag("span", "", array("class" => "glyphicon glyphicon-download")) .
                                        " Exportar en Excel",
                                        array("controller" => "Reportes", "action" => "reporte_odf", $odf["Odf"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php echo $this->Html->link("Nuevo Odf", array(
    "controller" => "Odfs", 
    "action" => "add"
)); ?>
