<!-- File: /app/View/Groups/index.ctp -->
<?php 
    $this->assign("title", "Grupos - Lista");
?>

<h2>Grupos <small>Lista</small></h2>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $group) { ?>
            <tr>
                <td><?php echo $group["Group"]["id"]; ?></td>
                <td><?php echo $group["Group"]["descripcion"]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>    
<?php
    echo $this->Html->link("Nuevo Grupo", array(
        "controller" => "Groups", "action" => "add"
    ));
?>