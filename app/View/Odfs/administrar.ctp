<!-- File: /app/View/Odfs/administrar.ctp -->
<?php 
    $this->assign("title", "ODFs - Administrar");
    echo $this->Html->css("odf");
?>
<h2>ODFs <small>Administrar</small></h2>
URD: <?php echo $odf["Urd"]["descripcion"]; ?>, ODF N° <?php echo $odf["Odf"]["numeracion"]; ?>
<div class="table-responsive">
<?php if($odf["Odf"]["tam_bc"] == 16) {
        function crear_thead($tubo_fibra) {
            $thead = "<tr><th rowspan='2'>Tubo de Fibra</th>";
            foreach($tubo_fibra["Be"] as $be) {
                $thead .= "<th class='tf-be'>BANDEJA EMPALME-" . $be["numeracion"] . "</th>";
            }
            $thead .= "</tr><tr>";
            foreach($tubo_fibra["Be"] as $be) {
                $thead .= "<th class='tf-bc'>BANDEJA CONECTORES-" . $be["Bc"][0]["numeracion"] . "</th>";
            }
            $thead .= "</tr>";
            return $thead;
        }
        
        function crear_tbody($tubo_fibra) {
            $tbody = "<tr><td class='tf-descripcion'><span class='id2'>(" . $tubo_fibra["id2"] . ")</span> " . $tubo_fibra["descripcion"] . "</td>";
            
            foreach($tubo_fibra["Be"] as $be) {
                $tbody .= "<td class='tf-fb'>" . generarfb2($be["Bc"][0]) . "</td>";
            }
            $tbody .= "</tr>";
            return $tbody;
        }
             
        function generarfb2($bc) {
            $fb = "<table><tbody>";
            for($i = 0; $i < sizeof($bc["Conectorfibra"]); $i += 2) {
                $conectorfibra1 = $bc["Conectorfibra"][$i];
                $conectorfibra2 = $bc["Conectorfibra"][$i + 1];
                $fb .= "<tr><td class='numeracion tf-fb' >" . $conectorfibra1["numeracion"] . "</td>";
                $fb .= "<td>\n
                    <input class='id' type='hidden' value='" . $conectorfibra1["id"] . "'>\n
                    <input class='numeracion' type='hidden' value='" . $conectorfibra1["numeracion"] . "'>\n
                    <input class='descripcion' type='hidden' value='" . $conectorfibra1["descripcion"] . "'>\n
                    <input class='observacion' type='hidden' value='" . $conectorfibra1["observacion"] . "'>\n
                    <input class='tipos_id' type='hidden' value='" . $conectorfibra1["tipos_id"] . "'>\n
                    <input class='gestores_id' type='hidden' value='" . $conectorfibra1["gestores_id"] . "'>\n
                    <input class='intermedio' type='hidden' value='" . $conectorfibra1["intermedio"] . "'>\n
                    <input class='gestor_ubicacion' type='hidden' value='" . $conectorfibra1["gestor_ubicacion"] . "'>\n
                    <button type='button' class='btn btn-primary administrar conectorfibra-descripcion tipo" . $conectorfibra1["tipos_id"] . "' data-toggle='modal' data-target='#mdlDetalleConectorFibra'>" . substr($conectorfibra1["descripcion"], 0, 30) . "<hr>" . substr($conectorfibra1["observacion"], 0, 15) . "</button>\n
                </td>";                
                $fb .= "<td>\n
                    <input class='id' type='hidden' value='" . $conectorfibra2["id"] . "'>\n
                    <input class='numeracion' type='hidden' value='" . $conectorfibra2["numeracion"] . "'>\n
                    <input class='descripcion' type='hidden' value='" . $conectorfibra2["descripcion"] . "'>\n
                    <input class='observacion' type='hidden' value='" . $conectorfibra2["observacion"] . "'>\n
                    <input class='tipos_id' type='hidden' value='" . $conectorfibra2["tipos_id"] . "'>\n
                    <input class='gestores_id' type='hidden' value='" . $conectorfibra2["gestores_id"] . "'>\n
                    <input class='intermedio' type='hidden' value='" . $conectorfibra2["intermedio"] . "'>\n
                    <input class='gestor_ubicacion' type='hidden' value='" . $conectorfibra2["gestor_ubicacion"] . "'>\n
                    <button type='button' class='btn btn-primary administrar conectorfibra-descripcion tipo" . $conectorfibra2["tipos_id"] . "' data-toggle='modal' data-target='#mdlDetalleConectorFibra'>" . substr($conectorfibra2["descripcion"], 0, 30) . "<hr>" . substr($conectorfibra2["observacion"], 0, 15) . "</button>\n
                </td>";
                $fb .= "<td class='numeracion tf-fb' >" . $conectorfibra2["numeracion"] . "</td></tr>";
            }
            $fb .= "</tbody></table>";
            return $fb;
        }
        
        foreach($odf["Tubofibra"] as $tubofibra) {
            $table = "" .
            "<table class='table'>" .
            "    <thead>" .
                    crear_thead($tubofibra) .
            "    </thead>" .
            "    <tbody class='root'>" .
                    crear_tbody($tubofibra) .
            "    </tbody>" .
            "</table>";
            echo $table;
            echo "<hr>";
        } ?>
<?php } else { ?>
    <table class="table" id="odf_detalle">
        <thead>
            <tr>
                <th>Tubo de Fibra</th>
                <th>BE</th>
                <th>BC</th>
                <th>Fibra Óptica</th>
            </tr>
        </thead>
        <tbody>
            <?php
                function calcular_tf_rs($tubofibra) {           
                    $tf_rs = 0;
                    foreach ($tubofibra["Be"] as $be) {
                        $tf_rs += sizeof($be["Bc"]);
                    }
                    return $tf_rs;
                }
                
                function generarfb($bc) {           
                    $fb = "<table><tbody><tr>";
                    for($i = 0; $i < sizeof($bc["Conectorfibra"]); $i += 2) {
                        $conectorfibra1 = $bc["Conectorfibra"][$i];
                        $conectorfibra2 = $bc["Conectorfibra"][$i + 1];
                        $fb .= "<td class='numeracion tf-fb' rowspan='2'>" . $conectorfibra1["numeracion"] . "</td>";
                        $fb .= "<td>\n
                            <input class='id' type='hidden' value='" . $conectorfibra1["id"] . "'>\n
                            <input class='numeracion' type='hidden' value='" . $conectorfibra1["numeracion"] . "'>\n
                            <input class='descripcion' type='hidden' value='" . $conectorfibra1["descripcion"] . "'>\n
                            <input class='observacion' type='hidden' value='" . $conectorfibra1["observacion"] . "'>\n
                            <input class='tipos_id' type='hidden' value='" . $conectorfibra1["tipos_id"] . "'>\n
                            <input class='gestores_id' type='hidden' value='" . $conectorfibra1["gestores_id"] . "'>\n
                            <input class='intermedio' type='hidden' value='" . $conectorfibra1["intermedio"] . "'>\n
                            <input class='gestor_ubicacion' type='hidden' value='" . $conectorfibra1["gestor_ubicacion"] . "'>\n
                            <button type='button' class='btn btn-primary administrar conectorfibra-descripcion tipo" . $conectorfibra1["tipos_id"] . "' data-toggle='modal' data-target='#mdlDetalleConectorFibra'>" . substr($conectorfibra1["descripcion"], 0, 30) . "<hr>" . substr($conectorfibra1["observacion"], 0, 15) . "</button>\n
                        </td>";                
                        $fb .= "<td>\n
                            <input class='id' type='hidden' value='" . $conectorfibra2["id"] . "'>\n
                            <input class='numeracion' type='hidden' value='" . $conectorfibra2["numeracion"] . "'>\n
                            <input class='descripcion' type='hidden' value='" . $conectorfibra2["descripcion"] . "'>\n
                            <input class='observacion' type='hidden' value='" . $conectorfibra2["observacion"] . "'>\n
                            <input class='tipos_id' type='hidden' value='" . $conectorfibra2["tipos_id"] . "'>\n
                            <input class='gestores_id' type='hidden' value='" . $conectorfibra2["gestores_id"] . "'>\n
                            <input class='intermedio' type='hidden' value='" . $conectorfibra2["intermedio"] . "'>\n
                            <input class='gestor_ubicacion' type='hidden' value='" . $conectorfibra2["gestor_ubicacion"] . "'>\n
                            <button type='button' class='btn btn-primary administrar conectorfibra-descripcion tipo" . $conectorfibra2["tipos_id"] . "' data-toggle='modal' data-target='#mdlDetalleConectorFibra'>" . substr($conectorfibra2["descripcion"], 0, 30) . "<hr>" . substr($conectorfibra2["observacion"], 0, 15) . "</button>\n
                        </td>";
                        $fb .= "<td class='numeracion tf-fb' rowspan='2'>" . $conectorfibra2["numeracion"] . "</td>";
                    }
                    $fb .= "</tr></tbody></table>";
                    return $fb;
                }
                
                foreach($odf["Tubofibra"] as $tubofibra) {
                    $tf_rs = calcular_tf_rs($tubofibra);
                    $tr = "";
                    $be_index = 0;
                    foreach($tubofibra["Be"] as $be) {
                        $be_rs = sizeof($be["Bc"]);
                        $bc_index = 0;
                        foreach($be["Bc"] as $bc) {
                            $bc["descripcion"] = generarfb($bc);
                            if($be_index == 0 && $bc_index == 0) {
                                $tr = "<tr>\n
                                    <td class='tf-descripcion' rowspan='" . $tf_rs . "'><span class='id2'>(" . $tubofibra["id2"] . ")</span> " . $tubofibra["descripcion"] . "</td>\n
                                    <td class='tf-be' rowspan='" . $be_rs . "'>" . $be["numeracion"] . "</td>\n
                                    <td class='tf-bc'>" . $bc["numeracion"] . "</td>\n 
                                    <td class=''>"  . $bc["descripcion"] . "</td>\n
                                </tr>";
                            } else if($bc_index == 0) {
                                $tr = "<tr>\n
                                    <td class='tf-be' rowspan='" . $be_rs . "'>" . $be["numeracion"] . "</td>\n
                                    <td class='tf-bc'>" . $bc["numeracion"] . "</td>\n
                                    <td class=''>" . $bc["descripcion"] . "</td>\n
                                </tr>";
                            } else {
                                $tr = "<tr>\n
                                    <td class='tf-bc'>" . $bc["numeracion"] . "</td>\n
                                    <td class=''>" . $bc["descripcion"] . "</td>\n
                                </tr>";
                            }
                            echo $tr;
                            $bc_index++;
                        }
                        $be_index++;
                    }
                }
            ?>
        </tbody>
    </table>
<?php } ?>
</div>
<?php
    echo $this->Html->link("Regresar a Lista ODFs", array("controller" => "Odfs", "action" => "index"));
?>
<div class="modal fade" id="mdlDetalleConectorFibra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Información de Conector de Fibra</h4>
            </div>
            <div class="modal-body" id="dvCursos">
                <?php
                echo $this->Form->create("Conectorfibra");  
                echo $this->Form->input("id", array("type" => "hidden"));
                echo $this->Form->input("numeracion", array(
                    "label" => "Numeración",
                    "div" => "form-group",
                    "class" => "form-control",
                    "type" => "number",
                    "readonly" => true
                ));
                echo $this->Form->label("descripcion", "Descripción");
                echo $this->Form->textarea("descripcion", array(
                    "div" => "form-group",
                    "class" => "form-control",
                    "required" => true
                ));
                echo $this->Form->input("gestor_ubicacion", array(
                    "label" => "DE",
                    "div" => "form-group",
                    "class" => "form-control",
                ));
                echo $this->Form->label("observacion", "Observación");
                echo $this->Form->textarea("observacion", array(
                    "div" => "form-group",
                    "class" => "form-control"
                ));
                echo $this->Form->input("intermedio", array(
                    "label" => "Intermedio",
                    "div" => "form-group",
                    "class" => "form-control"
                ));
                echo $this->Form->input("gestores_id", array(
                    "label" => "A",
                    "div" => "form-group",
                    "class" => "form-control",
                    "options" => $gestores
                ));
                echo $this->Form->input("tipos_id", array(
                    "label" => "Tipo",
                    "div" => "form-group",
                    "class" => "form-control",
                    "options" => $tipos,
                    "empty" => "Seleccionar Tipo"
                ));
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="aceptar">Aceptar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php
    $this->Html->scriptStart(array('inline' => false));
?>
    $('body').on('click', '.administrar', function() {
        var id = $(this).parent().find(".id").val();
        var numeracion = $(this).parent().find(".numeracion").val();
        var descripcion = $(this).parent().find(".descripcion").val();
        var observacion = $(this).parent().find(".observacion").val();
        var tipos_id = $(this).parent().find(".tipos_id").val();
        var gestores_id = $(this).parent().find(".gestores_id").val();
        var intermedio = $(this).parent().find(".intermedio").val();
        var gestor_ubicacion = $(this).parent().find(".gestor_ubicacion").val();
        $("#ConectorfibraId").val(id);
        $("#ConectorfibraNumeracion").val(numeracion);
        $("#ConectorfibraDescripcion").val(descripcion);
        $("#ConectorfibraObservacion").val(observacion);
        $("#ConectorfibraTiposId").val(tipos_id);
        $("#ConectorfibraGestoresId").val(gestores_id);
        $("#ConectorfibraIntermedio").val(intermedio);
        $("#ConectorfibraGestorUbicacion").val(gestor_ubicacion);
        var grados_id = $("#ConectorfibraGestoresId").val();
        if(grados_id == 1)
            $("#ConectorfibraGestorUbicacion").attr("disabled", true);
        else
            $("#ConectorfibraGestorUbicacion").attr("disabled", false);
    });
    $('body').on('click', '#aceptar', function() {
        $("#ConectorfibraAdministrarForm").submit();
    });
    $('body').on('change', '#ConectorfibraGestoresId', function() {
        var grados_id = $("#ConectorfibraGestoresId").val();
        if(grados_id == 1)
            $("#ConectorfibraGestorUbicacion").attr("disabled", true);
        else
            $("#ConectorfibraGestorUbicacion").attr("disabled", false);
    });
<?php
    $this->Html->scriptEnd();
?>