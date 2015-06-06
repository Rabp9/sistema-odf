<!-- File: /app/View/Provincias/index.ctp -->
<?php 
    $this->assign("title", "Provincias - Lista");
?>

<h2>Provincias <small>Lista</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Departamento</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($provincias as $provincia) { ?>
            <tr>
                <td><?php echo $provincia["Provincia"]["id"]; ?></td>
                <td><?php echo $provincia["Provincia"]["descripcion"]; ?></td>
                <td><?php echo $provincia["Departamento"]["descripcion"]; ?></td>
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
                                        array("controller" => "Provincias", "action" => "view", $provincia["Provincia"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Html->link(
                                        $this->Html->tag("span", "", array("class" => "glyphicon glyphicon-pencil")) .
                                        " Editar",
                                        array("controller" => "Provincias", "action" => "edit", $provincia["Provincia"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Form->postLink($this->Html->tag("span", "", array(
                                        "class" => "glyphicon glyphicon-trash")) . " Eliminar",
                                        array("controller" => "Provincias", "action" => "delete", $provincia["Provincia"]["id"]),
                                        array("confirm" => "¿Estás seguro?", "escape" => false)
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
<?php
    echo $this->Html->link("Nueva Provincia", array(
        "controller" => "Provincias", "action" => "add"
    ));
?>