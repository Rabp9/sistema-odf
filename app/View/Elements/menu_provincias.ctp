<ul class="sub-menu"<?php echo $this->request->params["controller"] == "Provincias" && $this->request->params["action"] == "view_map" ? "style='display: block'" : ""; ?>>
<?php
    $provincias = $this->requestAction("/provincias/menu_provincias");
    foreach($provincias as $provincia) {
?>
    <li class="<?php if(!empty($this->request->params["pass"][0])) echo $this->request->params["pass"][0] == $provincia["Provincia"]["id"] && $this->request->params["controller"] == "Provincias" ? "active" : ""; ?>" >
        <?php
            echo $this->Html->link($provincia["Provincia"]["descripcion"], array(
                "controller" => "Provincias",
                "action" => "view_map", $provincia["Provincia"]["id"]
            ));
        ?>
    </li>
<?php } ?>
</ul>