<!-- File: /app/View/Users/view.ctp -->
<?php 
    $this->assign("title", "Usuarios - Ver");
?>

<h2>Usuarios <small>Ver</small></h2>

<dl class="dl-horizontal">
    <dt>Código</dt>
    <dd><?php echo $user["User"]["id"]; ?></dd>
    <dt>Username</dt>
    <dd><?php echo $user["User"]["username"]; ?></dd>
    <dt>Grupo</dt>
    <dd><?php echo $user["Group"]["descripcion"]; ?></dd>
</dl>
<?php echo $this->Html->link("Regresar a Lista Usuarios", array("controller" => "Users", "action" => "index")); ?>
