<!-- File: /app/View/Urds/index.ctp -->
<?php 
    $this->assign("title", "URD's - Lista");
?>

<h2>URD's <small>Lista</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Provincia</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($urds as $urd) { ?>
            <tr>
                <td><?php echo $urd["Urd"]["id"]; ?></td>
                <td><?php echo $urd["Urd"]["descripcion"]; ?></td>
                <td><?php echo $urd["Provincia"]["descripcion"]; ?></td>
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
                                        array("controller" => "Urds", "action" => "view", $urd["Urd"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Html->link(
                                        $this->Html->tag("span", "", array("class" => "glyphicon glyphicon-pencil")) .
                                        " Editar",
                                        array("controller" => "Urds", "action" => "edit", $urd["Urd"]["id"]),
                                        array("escape" => false)
                                    );
                                ?>
                            </li>
                            <li role="presentation">
                                <?php
                                    echo $this->Form->postLink($this->Html->tag("span", "", array(
                                        "class" => "glyphicon glyphicon-trash")) . " Eliminar",
                                        array("controller" => "Urds", "action" => "delete", $urd["Urd"]["id"]),
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
    echo $this->Html->link("Nuevo URD", array(
        "controller" => "Urds", "action" => "add"
    ));
?>