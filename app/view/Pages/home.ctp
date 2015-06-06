<?php 
    $this->assign("title", "Home");
?>

<h2>Bienvenido <small>Usuario: <?php echo $user["username"]; ?>, Rol: <?php echo $user["groups_id"] == 1 ? "Administrador" : "Técnico"; ?></small></h2>


<!-- BEGIN DASHBOARD STATS -->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"
        onclick="location.href = '<?php echo $this->Html->url(array(
            "controller" => "Departamentos",
            "action" => "index_map"
        )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="icon-map-marker"></i>
            </div>
            <div class="details">
                <div class="number">
                    Mapa Perú
                </div>                
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Departamentos",
                "action" => "index_map"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"
        onclick="location.href = '<?php echo $this->Html->url(array(
            "controller" => "Departamentos",
            "action" => "index"
        )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-flag"></i>
            </div>
            <div class="details">
                <div class="number">Mantenimiento Departamentos</div>                
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Departamentos",
                "action" => "index"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>
    </div>


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" 
        onclick="location.href = '<?php echo $this->Html->url(array(
            "controller" => "Provincias",
            "action" => "index"
        )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="icon-flag"></i>
            </div>
            <div class="details">
                <div class="number">Mantenimiento Provincias</div>                
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Provincias",
                "action" => "index"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>

    </div>


    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"
         onclick="location.href = '<?php echo $this->Html->url(array(
                "controller" => "Urds",
                "action" => "index"
            )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-wrench"></i>
            </div>
            <div class="details">
                <div class="number">Mantenimiento URD's</div>
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Urds",
                "action" => "index"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"
        onclick="location.href = '<?php echo $this->Html->url(array(
            "controller" => "Odfs",
            "action" => "index"
        )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-wrench"></i>
            </div>
            <div class="details">
                <div class="number">Mantenimiento ODF's</div>
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Odfs",
                "action" => "index"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"
        onclick="location.href = '<?php echo $this->Html->url(array(
            "controller" => "Users",
            "action" => "index"
        )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="icon-wrench"></i>
            </div>
            <div class="details">
                <div class="number">Mantenimiento Usuarios</div>
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Users",
                "action" => "index"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"
         onclick="location.href = '<?php echo $this->Html->url(array(
                "controller" => "Users",
                "action" => "logout"
            )); ?>'" style="cursor: pointer">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="icon-cog"></i>
            </div>
            <div class="details">
                <div class="number">Salir</div>
            </div>
            <a class="more" href="<?php echo $this->Html->url(array(
                "controller" => "Users",
                "action" => "logout"
            )); ?>">
                Mostrar <i class="m-icon-swapright m-icon-white"></i>
            </a>                 
        </div>
    </div>
</div>
<!-- END DASHBOARD STATS --> 
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Últmas Notas Registradas</h3>
    </div>
    <div class="panel-body">
    <?php
        $ultimas_notas = $this->requestAction("/Notas/ultimas_notas");
        if(empty($ultimas_notas)) {                       
            echo $this->element("flash_bootstrap", array(
                "message" => "No hay notas registrados"
            ));
        }
        else {
            echo "<div class='list-group'>";
            foreach ($ultimas_notas as $nota) {
    ?>
        <a class="list-group-item" href="<?php echo $this->Html->url(array(
            "controller" => "Odfs",
            "action" => "view", $nota["Odf"]["id"]
        ))?>">
            <h4 class="list-group-item-heading"><?php echo $nota["Nota"]["asunto"]; ?></h4>
            <small><i>Usuario: <?php echo $nota["User"]["username"];?>. 
                Fecha: <?php echo $this->Time->format($nota["Nota"]["created"], "%d-%m-%Y");  ?>.
            </i></small>
            <p class="list-group-item-text"><?php echo $nota["Nota"]["cuerpo"]; ?></p>
        </a>
    <?php
            }   
            echo "</div>";
        }
    ?>
    </div>
</div>