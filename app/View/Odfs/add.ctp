<!-- File: /app/View/Odfs/add.ctp -->
<?php 
    $this->assign("title", "ODFs - Nuevo");
    echo $this->Html->css("odf");
?>

<h2>ODF's <small>Nuevo</small></h2>
<?php echo $this->Form->create("Odf"); ?>
<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="tbTubofibras">
        <li role="presentation" class="active"><a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab">Información General</a></li>
        <li role="presentation"><a href="#distribucion" aria-controls="distribucion" role="tab" data-toggle="tab">Distribución de Cables</a></li>
        <li role="presentation"><a href="#confirmacion" aria-controls="confirmacion" role="tab" data-toggle="tab">Confirmación</a></li>
      </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="informacion">
            <?php
                echo $this->Html->para("lead", "Ingrese los datos del Odf:");
                echo $this->Form->input("Departamento.id", array(
                    "label" => "Departamento",
                    "div" => "form-group",
                    "class" => "form-control",
                    "autofocus" => "autofocus",
                    "options" => $departamentos,
                    "empty" => "Selecciona uno"
                ));   
                echo $this->Form->input("Provincia.id", array(
                    "label" => "Provincia",
                    "div" => "form-group",
                    "class" => "form-control",
                    "type" => "select",
                    "disabled" => true
                ));
                echo $this->Form->input("urds_id", array(
                    "label" => "URD",
                    "div" => "form-group",
                    "class" => "form-control",
                    "type" => "select",
                    "disabled" => true
                ));
                echo $this->Form->input("numero_cables", array(
                    "label" => "Número de cables",
                    "div" => "form-group",
                    "autofocus" => "autofocus",
                    "class" => "form-control",
                    "type" => "number",
                    "step" => 8,
                    "value" => 8,
                    "max" => 1024,
                    "min" => 8
                ));
                echo $this->Form->input("tam_bc", array(
                    "label" => "Tamaño de Bandeja de Conectores",
                    "div" => "form-group",
                    "autofocus" => "autofocus",
                    "class" => "form-control",
                    "options" => array("2" => "2", "4" => "4", "8" => "8", "16" => "16")
                ));
            ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="distribucion">
            <?php
                echo $this->Html->para("lead", "Distribuya los cables:");
                echo $this->Form->input("n_disponibles", array(
                    "label" => "Número de cables disponibles",
                    "div" => "form-group",
                    "class" => "form-control",
                    "readonly" => true
                ));               
                echo $this->Form->input("n_utilizados", array(
                    "label" => "Número de cables utilizados",
                    "div" => "form-group",
                    "class" => "form-control",
                    "readonly" => true,
                    "value" => 0
                ));
            ?>
            <div class="row">
                <div class="col-lg-2">  
                <?php
                    echo $this->Form->input("codigo", array(
                        "label" => "Identificador",
                        "div" => "form-group",
                        "class" => "form-control",
                        "maxlength" => 3
                    ));
                ?>
                </div>
                <div class="col-lg-6">
                <?php                
                    echo $this->Form->input("descripcion", array(
                        "label" => "Descripción de tubo de Fibra",
                        "div" => "form-group",
                        "class" => "form-control"
                    ));
                ?>
                </div>
                <div class="col-lg-2">
                 <?php           
                    echo $this->Form->input("n_cables", array(
                       "label" => "Número de cables ",
                       "div" => "form-group",
                       "class" => "form-control",
                       "options" => array(
                           "8" => 8,
                           "16" => 16,
                           "24" => 24,
                           "32" => 32,
                           "48" => 48,
                           "64" => 64,
                           "128" => 128,
                           "256" => 256
                       )
                   ));
                ?>
                </div>
            </div>
            <button type="button" id="btnAgregar">Agregar</button>
            <div class="table-responsive">
                <table class="table" id="tblTubos">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Número de Cables</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                </table>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="confirmacion">
            <div class="table-responsive" id="divTubos">
            </div>
            <?php
                echo $this->Form->button($this->Html->tag("span", "", array("class" => "glyphicon glyphicon-ok")) . " Registrar", array("class" => "btn btn-default"));
            ?>
        </div>
    </div>
    <?php
        echo $this->Form->end();  
        echo $this->Html->link("Regresar a Lista ODFs", array("controller" => "Odfs", "action" => "index"));
    ?>
</div>
<script>
    $(document).ready(function() {
        $('a[aria-controls="informacion"]').on('shown.bs.tab', function (e) {
            var n_utilizados = $("#OdfNUtilizados").val();
            var tab = e.relatedTarget.hash;
            if(n_utilizados != 0) {
                if(confirm("Se eliminarà los tubos de fibra registrados")) {
                    var numero_cables = $("#OdfNumeroCables").val();
                    $("#OdfNDisponibles").val(numero_cables);
                    $("#OdfNUtilizados").val(0);
                    $("#tblTubos tbody tr").remove();
                    $("#OdfCodigo").val("");
                    $("#OdfDescripcion").val("");
                    $("#OdfTamBc").val() != 16 ? $("#OdfNCables").val(8) : $("#OdfNCables").val(256);
                    $("#btnAgregar").attr("disabled", false);
                }
                else {
                    $("#tbTubofibras a[href=" + tab + "]").tab("show");
                }
            }
        });
        $('a[aria-controls="distribucion"]').on('shown.bs.tab', function (e) {       
            var n_utilizados = $("#OdfNUtilizados").val();
            if(n_utilizados == 0) {
                var numero_cables = $("#OdfNumeroCables").val();
                $("#OdfNDisponibles").val(numero_cables);
            }
        });
        $("#btnAgregar").click(function() {
            // Agregar en la tabla
            var descripcion = $("#OdfDescripcion").val();
            var n_cables = $("#OdfNCables").val();
            var codigo = $("#OdfCodigo").val();
            if(descripcion == "" || codigo == "") {
                alert("Debe ingresar una descripción y un código correcto");
                return;
            }
            var n_disponibles = $("#OdfNDisponibles").val();
            if(parseInt(n_disponibles) < parseInt(n_cables)) {
                alert("Excede el número de cables disponibles");
                return;
            }
            var index = $("#tblTubos tbody").find("tr").length;
            var tuboFibra = "<tr>\n\
                <td><input type='hidden' class='codigo' name='data[Tubofibra][" + index + "][id2]' value='" + codigo + "'>" + codigo + "</td>\n\
                <td><input type='hidden' class='descripcion' name='data[Tubofibra][" + index + "][descripcion]' value='" + descripcion + "'>" + descripcion + "</td>\n\
                <td><input type='hidden' class='numero_cables' name='data[Tubofibra][" + index + "][numero_cables]' value='" + n_cables + "'>" + n_cables + "</td>\n\
            </tr>";
            $("#tblTubos tbody").append(tuboFibra);
            
            // Actualizar conteo
            n_disponibles = n_disponibles - n_cables;
            $("#OdfNDisponibles").val(n_disponibles);
            
            var n_utilizados = $("#OdfNUtilizados").val();
            n_utilizados = parseInt(n_utilizados) + parseInt(n_cables);
            $("#OdfNUtilizados").val(n_utilizados);
            $("#OdfCodigo").val("");
            $("#OdfDescripcion").val("");
            $("#OdfTamBc").val() != 16 ? $("#OdfNCables").val(8) : $("#OdfNCables").val(256);
            $("#OdfCodigo").focus();
            if(n_disponibles == 0)
                $(this).attr("disabled", true);
        });
        
        $('a[aria-controls="confirmacion"]').on('shown.bs.tab', function (e) {
            $("#odf_detalle tbody tr").remove();
            
            var distribucion = [];
            var numeracion_be = 1;
            var numeracion_bc = 72;
            var tam_bc = $("#OdfTamBc").val();
            if(tam_bc == 16) {
                $("#tblTubos tbody").find("tr").each(function(index) {
                    var tubo = {
                        "id": $(this).find(".codigo").val(),
                        "descripcion": $(this).find(".descripcion").val() + "-" + ((2 * index) + 1) + " (001 - 128)",
                        "numero_cables": 128,
                        "be": []
                    };
                    for(var i = 0; i < 8; i++) {
                        var be = {
                            "numero_cables": 16,
                            "numeracion": (i + 1),
                            "bc": []
                        }
                        var inicio = 16 * i + 1;
                        var fin = 16 * (i + 1);
                        var bc = {
                            "numeracion": (i + 1),
                            "numero_cables": 16,
                            "descripcion": inicio + " - " + fin
                        }
                        be.bc.push(bc);
                        tubo.be.push(be);
                    }
                    distribucion.push(tubo);
                    tubo = {
                        "id": $(this).find(".codigo").val(),
                        "descripcion": $(this).find(".descripcion").val() + "-" + ((2 * index) + 2) + " (129 - 256)",
                        "numero_cables": 128,
                        "be": []
                    };
                    for(var i = 0; i < 8; i++) {
                        var be = {
                            "numero_cables": 16,
                            "numeracion": (i + 1),
                            "bc": []
                        }
                        var inicio = 128 + (16 * i + 1);
                        var fin = 128 + (16 * (i + 1));
                        var bc = {
                            "numeracion": (i + 1),
                            "numero_cables": 16,
                            "descripcion": inicio + " - " + fin
                        }
                        be.bc.push(bc);
                        tubo.be.push(be);
                    }
                    distribucion.push(tubo);
                });
            } else {
                $("#tblTubos tbody").find("tr").each(function(index) {
                    var tubo = {
                        "id": $(this).find(".codigo").val(),
                        "descripcion": $(this).find(".descripcion").val(),
                        "numero_cables": $(this).find(".numero_cables").val(),
                        "be": []
                    };
                    var n_be = tubo.numero_cables / 16;
                    var aux_n_be = tubo.numero_cables;
                    var cont_bc = 0;
                    for(i = 0; i < n_be; i++) {
                        var numero_cables = aux_n_be == 8 ? 8 : 16;
                        var be = {
                            "numero_cables": numero_cables,
                            "numeracion": numeracion_be,
                            "bc": []
                        }
                        aux_n_be -= 16;
                        numeracion_be++;
                        for(j = 0; j < numero_cables / tam_bc; j++) {
                            var aux_numero_cables = numero_cables < tam_bc ? numero_cables : tam_bc;
                            var inicio = ((tam_bc * cont_bc) + 1);
                            var fin = parseInt(inicio) + parseInt(aux_numero_cables) - 1;
                            var bc = {
                                "numeracion": numeracion_bc,
                                "numero_cables": aux_numero_cables,
                                "descripcion": inicio + " - " + fin
                            }
                            be.bc.push(bc);
                            numeracion_bc--;
                            cont_bc++;
                        }
                        tubo.be.push(be);
                    }
                    distribucion.push(tubo);
                });
            }
            
            console.log(distribucion);
            if(tam_bc == 16) {
                $("#divTubos").html("");
                distribucion.forEach(function(tubo_fibra, tf_index, tf_array) {
                    var table = "\n\
                    <table class='table'>\n\
                        <thead>"
                            + crear_thead(tubo_fibra) +
                        "</thead>\n\
                        <tbody class='root'>"
                            + crear_tbody(tubo_fibra) +
                        "</tbody>\n\
                    </table>";
                    $("#divTubos").append(table);
                    $("#divTubos").append("<hr>");
                });
            }
            else {            
                $("#divTubos").html("");
                    var table = "\n\
                    <table class='table' id='odf_detalle'>\n\
                        <thead>\n\
                            <tr>\n\
                                <th>Tubo de Fibra</th>\n\
                                <th>BE</th>\n\
                                <th>BC</th>\n\
                                <th>Fibra Óptica</th>\n\
                            </tr>\n\
                        </thead>\n\
                        <tbody class='root'>\n\
                        </tbody>\n\
                    </table>";
                    $("#divTubos").append(table)
                distribucion.forEach(function(tubo_fibra, tf_index, tf_array) {
                    var tf_rs = calcular_tf_rs(tubo_fibra);
                    var tr = "";
                    tubo_fibra.be.forEach(function(be, be_index, be_array) {
                        var be_rs = be.bc.length;
                        be.bc.forEach(function(bc, bc_index, bc_array) {
                            if(be_index == 0 && bc_index == 0) {
                                tr = "<tr>\n\
                                    <td class='tf-descripcion' rowspan='" + tf_rs + "'><span class='id2'>(" + tubo_fibra.id + ")</span> " + tubo_fibra.descripcion + "</td>\n\
                                    <td class='tf-be' rowspan='" + be_rs + "'>" + be.numeracion + "</td>\n\
                                    <td class='tf-bc'>" + bc.numeracion + "</td>\n\
                                    <td class='tf-fb'>" + bc.descripcion + "</td>\n\
                                </tr>";
                            } else if(bc_index == 0) {
                                tr = "<tr>\n\
                                    <td class='tf-be' rowspan='" + be_rs + "'>" + be.numeracion + "</td>\n\
                                    <td class='tf-bc'>" + bc.numeracion + "</td>\n\
                                    <td class='tf-fb'>" + bc.descripcion + "</td>\n\
                                </tr>";
                            } else {
                                tr = "<tr>\n\
                                    <td class='tf-bc'>" + bc.numeracion + "</td>\n\
                                    <td class='tf-fb'>" + bc.descripcion + "</td>\n\
                                </tr>";
                            }
                            $("#odf_detalle tbody.root").append(tr);
                        });
                    });
                });
            }
        });
        
        function crear_thead(tubo_fibra) {
            var thead = "<tr><th rowspan='2'>Tubo de Fibra</th>";
            tubo_fibra.be.forEach(function(be, be_index, be_array) {
                thead += "<th class='tf-be'>BANDEJA EMPALME-" + be.numeracion + "</th>";
            });
            thead += "</tr><tr>";
            tubo_fibra.be.forEach(function(be, be_index, be_array) {
                thead += "<th class='tf-bc'>BANDEJA CONECTORES-" + be.bc[0].numeracion + "</th>";
            });
            thead += "</tr>";
            return thead;
        }
        
        function crear_tbody(tubo_fibra) {
            var tbody = "<tr><td class='tf-descripcion'><span class='id2'>(" + tubo_fibra.id + ")</span> " + tubo_fibra.descripcion + "</td>";
            
            tubo_fibra.be.forEach(function(be, be_index, be_array) {
                tbody += "<td class='tf-fb'>" + be.bc[0].descripcion + "</td>";
            });
            tbody += "</tr>";
            return tbody;
        }
        
        function calcular_tf_rs(tubo_fibra) {           
            var tf_rs = 0;
            tubo_fibra.be.forEach(function(be, be_index, be_array) {
                tf_rs += be.bc.length;
            });
            return tf_rs;
        }
    })
</script>
<?php $this->Js->get("#OdfTamBc")->event("change", 
    "if($(this).val() == 16) {" .
    "   $(\"#OdfNCables\").html(\"<option value='256'>256</option>\");" .
    "} else {" .
    "   $(\"#OdfNCables\").html(" .
    "       \"<option value='8'>8</option>" .
    "       <option value='16'>16</option>" .
    "       <option value='24'>24</option>" .
    "       <option value='32'>32</option>" .
    "       <option value='48'>48</option>" .
    "       <option value='64'>64</option>" .
    "       <option value='128'>128</option>" .
    "       <option value='256'>256</option>" .
    "   \");" .
    "}"
); ?>

<?php
    $this->Js->get('#DepartamentoId')->event('change', 
        $this->Js->request(array(
            'controller'=>'Provincias',
            'action'=>'getByDepartamento'
        ), array(
            'update'=>'#ProvinciaId',
            'async' => true,
            'method' => 'post',
            'dataExpression'=>true,
            'data'=> $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            )),
            "success" => "$('#ProvinciaId').attr({disabled: false});"
        ))
    );
?>

<?php
    $this->Js->get('#ProvinciaId')->event('change', 
        $this->Js->request(array(
            'controller'=>'Urds',
            'action'=>'getByProvincia'
        ), array(
            'update'=>'#OdfUrdsId',
            'async' => true,
            'method' => 'post',
            'dataExpression'=>true,
            'data'=> $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            )),
            "success" => "$('#OdfUrdsId').attr({disabled: false});"
        ))
    );
?>