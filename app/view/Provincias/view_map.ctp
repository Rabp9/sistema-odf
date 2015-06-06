<!-- File: /app/View/Provincias/view_map.ctp -->
<?php 
    $this->assign("title", "Provincias - Vista en Mapa");
?>
<h2>Provincia <?php echo $provincia["Provincia"]["descripcion"]; ?> <small>Vista en Mapa</small></h2>

<script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAaOuNwQpl_6SNrN9SPqlprhQmVl4M6pUqpH8m1u86xCFJGE2ovxS4R4LhSaw6omab-H9GhhvM5WdLMw" type="text/javascript"></script>
<div id="map" style="width: 100%; height: 600px"></div> 
<script type="text/javascript">
    var map = new GMap2(document.getElementById("map"));
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());
    map.addControl(new GScaleControl());
    map.setCenter(new GLatLng(<?php echo $provincia["Provincia"]["latitud"] . 
        ", " . $provincia["Provincia"]["longitud"] . "), " . $provincia["Provincia"]["zoom"]?>, G_NORMAL_MAP);

    function createMarker(point, id, descripcion) {
        var marker = new GMarker(point);
        GEvent.addListener(marker, "click", function() {
            // Evento click
            window.location = "../../Urds/view/" + id;
        });        
        GEvent.addListener(marker, "mouseover", function() {
            // Evento hover
            marker.openInfoWindowHtml(descripcion);
        });      
        GEvent.addListener(marker, "mouseout", function() {
            // Evento hover
            marker.closeInfoWindow();
        });
        return marker;
    };

    <?php
        foreach ($provincia["Urd"] as $urd) {
            echo "var point = new GLatLng(" . $urd["latitud"] . "," . $urd["longitud"] . ");\n";
            echo "var marker = createMarker(point, '" . $urd["id"] . "', '" . $urd["descripcion"] . "');\n";

            echo "map.addOverlay(marker);\n";  
            echo "\n";
         }
    ?>
</script>
<?php echo $this->Html->link("Regresar a Vista en Mapa Departamento", array("controller" => "Departamentos", "action" => "view_map", $provincia["Departamento"]["id"])); ?>