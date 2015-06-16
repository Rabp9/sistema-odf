<ul class="sub-menu"<?php echo $this->request->params["controller"] == "Departamentos" && $this->request->params["action"] == "view_map" ? "style='display: block'" : ""; ?>>
<?php
    $departamentos = $this->requestAction("/departamentos/menu_departamentos");
    foreach($departamentos as $departamento) {
?>
    <li class="<?php if(!empty($this->request->params["pass"][0])) echo $this->request->params["pass"][0] == $departamento["Departamento"]["id"] && $this->request->params["controller"] == "Departamentos" ? "active" : ""; ?>" >
        <?php
            echo $this->Html->link($departamento["Departamento"]["descripcion"], array(
                "controller" => "Departamentos",
                "action" => "view_map", $departamento["Departamento"]["id"]
            ));
        ?>
    </li>
<?php } ?>
</ul>