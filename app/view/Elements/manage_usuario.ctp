<?php
    $user = $this->requestAction("/Users/manage_usuario");
?>
<li class="dropdown user">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">        
        <span class="username"><?php echo $user["username"]; ?></span>
        <i class="icon-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "Users",
                "action" => "change_password"
            )) ?>"><i class="icon-user"></i> Cambiar Password</a>
        </li>
        <li>
            <a href="<?php echo $this->Html->url(array(
                "controller" => "Users",
                "action" => "logout"
            ))?>"><i class="icon-key"></i> Salir</a>
        </li>
        <li class="divider">
        </li>
    </ul>
</li>