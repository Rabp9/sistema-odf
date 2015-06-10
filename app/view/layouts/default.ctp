<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es" class="no-js"> 
<!--<![endif]-->
    <head>
        <title><?php echo $this->fetch("title"); ?></title>    
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta name="MobileOptimized" content="320">
        <?php
            echo $this->Html->css("plugins/font-awesome/css/font-awesome.min");
            echo $this->Html->css("plugins/bootstrap/css/bootstrap.min");
            echo $this->Html->css("plugins/uniform/css/uniform.default");
            echo $this->Html->css("plugins/gritter/css/jquery.gritter");
            echo $this->Html->css("plugins/bootstrap-datepicker/css/datepicker");
            echo $this->Html->css("plugins/bootstrap-timepicker/compiled/timepicker");
            echo $this->Html->css("plugins/bootstrap-colorpicker/css/colorpicker");
            echo $this->Html->css("plugins/bootstrap-daterangepicker/daterangepicker-bs3");
            echo $this->Html->css("plugins/bootstrap-datetimepicker/css/datetimepicker");
            echo $this->Html->css("plugins/select2/select2_metro");
            echo $this->Html->css("plugins/data-tables/DT_bootstrap");
            echo $this->Html->css("plugins/jquery-multi-select/css/multi-select");
            echo $this->Html->css("plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro");
            echo $this->Html->css("plugins/jquery-tags-input/jquery.tagsinput");
            echo $this->Html->css("css/style-metronic");
            echo $this->Html->css("css/style");
            echo $this->Html->css("css/style-responsive");
            echo $this->Html->css("css/plugins");
            echo $this->Html->css("css/pages/tasks");
            echo $this->Html->css("css/themes/default");
            echo $this->Html->css("css/custom");
            echo $this->Html->css("plugins/jquery-ui/jquery-ui-1.10.3.custom.min");
            echo $this->Html->css("plugins/bootstrap-wysihtml5/bootstrap-wysihtml5");
        ?>
        
        <!--  <link rel="shortcut icon" href="favicon.ico" />   -->  
        <!--[if lt IE 9]>
        <script src="plugins/respond.min.js"></script>
        <script src="plugins/excanvas.min.js"></script> 
        <![endif]--> 
        <?php
            echo $this->Html->script("plugins/jquery-1.10.2.min");
            echo $this->Html->script("plugins/jquery-migrate-1.2.1.min");
            echo $this->Html->script("plugins/bootstrap/js/bootstrap.min");
            echo $this->Html->script("plugins/jquery-ui/jquery-ui-1.10.3.custom.min");
            echo $this->Html->script("plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min");
            echo $this->Html->script("plugins/jquery-slimscroll/jquery.slimscroll.min");
            echo $this->Html->script("plugins/jquery.blockui.min");
            echo $this->Html->script("plugins/jquery.cookie.min");
            echo $this->Html->script("plugins/uniform/jquery.uniform.min");
            echo $this->Html->script("plugins/bootstrap-wysihtml5/wysihtml5-0.3.0");
            echo $this->Html->script("plugins/bootstrap-wysihtml5/bootstrap-wysihtml5");
            echo $this->Html->script("plugins/bootstrap-datepicker/js/bootstrap-datepicker");
            echo $this->Html->script("plugins/jquery.pulsate.min");
            echo $this->Html->script("plugins/bootstrap-daterangepicker/moment.min");
            echo $this->Html->script("plugins/bootstrap-daterangepicker/daterangepicker");
            echo $this->Html->script("plugins/gritter/js/jquery.gritter");
            echo $this->Html->script("plugins/bootstrap-wysihtml5/bootstrap-wysihtml5");
            echo $this->Html->script("scripts/app");
            echo $this->Html->script("scripts/index");
            echo $this->Html->script("scripts/tasks");
            echo $this->Html->script("plugins/select2/select2.min");
            echo $this->Html->script("plugins/jquery-multi-select/js/jquery.multi-select");
            echo $this->Html->script("plugins/jquery-multi-select/js/jquery.quicksearch");
            echo $this->Html->script("plugins/data-tables/jquery.dataTables.min");
            echo $this->Html->script("plugins/data-tables/DT_bootstrap");
            echo $this->Html->script("plugins/jquery.form.min");
        ?>
        
        <script type="text/javascript">
            jQuery(document).ready(function() {
                App.init();
                Index.init();
                Index.initDashboardDaterange();
                Tasks.initDashboardWidget();
                App.scrollTop();
            });

        </script>

        <script type="text/javascript">
            function showRequest(formData, jqForm, options) {
            }
            function showResponse(responseText, statusText, xhr, $form) {
                App.scrollTop();
            }
            function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
        </script>

        <script type="text/javascript">
            function fn_9a7e276a7915bc9c5c67dc7bbb4d8f6f() {
                $("#contenedor-proveedor").load("http://localhost/inventarios/proveedor/action_form_new");
                App.scrollTop();
            }
            function fn_161ebd3859ecaa309075be598be6ad9d() {
                $("#contenedor-proveedor").load("http://localhost/inventarios/proveedor/action_grid");
                App.scrollTop();
            }
            function fn_200c83815c874f8faf992be66316ca57(id) {
                $("#contenedor-proveedor").load("http://localhost/inventarios/proveedoreditar/action_form", {
                    id: id});
                App.scrollTop();
            }
            function fn_5b1130c0e788ad855d83e431725a1392(id) {
                $("#contenedor-proveedor").load("http://localhost/inventarios/proveedor/action_form_delete", {
                    id: id});
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_13122535fbc3c9e29eb119531dcbb2da() {
                $("#contenedor-usuario").load("http://localhost/inventarios/usuario/action_form_new");
                App.scrollTop();
            }
            function fn_2928ed12f54b9cc308d3099b5cefa6e0() {
                $("#contenedor-usuario").load("http://localhost/inventarios/usuario/action_grid");
                App.scrollTop();
            }
            function fn_05ec4d3d86ec6267c6584c3d231a502a(id) {
                $("#contenedor-usuario").load("http://localhost/inventarios/usuarioeditar/action_form", {
                    id: id
                });
                App.scrollTop();
            }
            function fn_a24017f9cb3c87d9f597954ad6f3d2a9(id) {
                $("#contenedor-usuario").load("http://localhost/inventarios/usuario/action_form_delete", {
                    id: id});
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_tg_documento_nuevo() {
                $("#capa-documento-datos-usuario").load("http://localhost/inventarios/entidaddocumento/action_form_new");
                App.scrollTop();
            }

            function fn_tg_documento_cancelar() {
                $("#capa-documento-datos-usuario").load("http://localhost/inventarios/entidaddocumento/action_grid", {
                    idusuario: $("#idusuario").val()
                });
                App.scrollTop();
            }

            function fn_tg_documento_editar(id) {
                $("#capa-documento-datos-usuario").load("http://localhost/inventarios/entidaddocumento/action_form_edit", {
                    id: id
                });
                App.scrollTop();
            }

            function fn_tg_documento_eliminar(id) {
                $("#capa-documento-datos-usuario").load("http://localhost/inventarios/entidaddocumento/action_form_delete", {
                    id: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_tg_email_nuevo() {
                $("#capa-email-datos-usuario").load("http://localhost/inventarios/entidademail/action_form_new");
                App.scrollTop();
            }

            function fn_tg_email_cancelar() {
                $("#capa-email-datos-usuario").load("http://localhost/inventarios/entidademail/action_grid", {
                    idusuario: $("#idusuario").val()
                });
                App.scrollTop();
            }

            function fn_tg_email_editar(id) {
                $("#capa-email-datos-usuario").load("http://localhost/inventarios/entidademail/action_form_edit", {
                    id: id
                });
                App.scrollTop();
            }

            function fn_tg_email_eliminar(id) {
                $("#capa-email-datos-usuario").load("http://localhost/inventarios/entidademail/action_form_delete", {
                    id: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_tg_telefono_nuevo() {
                $("#capa-telefono-datos-usuario").load("http://localhost/inventarios/entidadtelefono/action_form_new");
                App.scrollTop();
            }

            function fn_tg_telefono_cancelar() {
                $("#capa-telefono-datos-usuario").load("http://localhost/inventarios/entidadtelefono/action_grid", {
                    idusuario: $("#idusuario").val()
                });
                App.scrollTop();
            }

            function fn_tg_telefono_editar(id) {
                $("#capa-telefono-datos-usuario").load("http://localhost/inventarios/entidadtelefono/action_form_edit", {
                    id: id
                });
                App.scrollTop();
            }

            function fn_tg_telefono_eliminar(id) {
                $("#capa-telefono-datos-usuario").load("http://localhost/inventarios/entidadtelefono/action_form_delete", {
                    id: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_tg_direccion_nuevo() {
                $("#capa-direccion-datos-usuario").load("http://localhost/inventarios/entidaddireccion/action_form_new");
                App.scrollTop();
            }

            function fn_tg_direccion_cancelar() {
                $("#capa-direccion-datos-usuario").load("http://localhost/inventarios/entidaddireccion/action_grid", {
                    idusuario: $("#idusuario").val()
                });
                App.scrollTop();
            }

            function fn_tg_direccion_editar(id) {
                $("#capa-direccion-datos-usuario").load("http://localhost/inventarios/entidaddireccion/action_form_edit", {
                    id: id
                });
                App.scrollTop();
            }

            function fn_tg_direccion_eliminar(id) {
                $("#capa-direccion-datos-usuario").load("http://localhost/inventarios/entidaddireccion/action_form_delete", {
                    id: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_articulo_nuevo() {
                $("#contenedor-articulo").load("http://localhost/inventarios/articulo/action_form_new");
                App.scrollTop();
            }
            function fn_articulo_grid() {
                $("#contenedor-articulo").load("http://localhost/inventarios/articulo/action_grid");
                App.scrollTop();
            }
            function fn_articulo_editar(id) {
                $("#contenedor-articulo").load("http://localhost/inventarios/articuloeditar/action_form", {
                    id: id});
                App.scrollTop();
            }
            function fn_articulo_eliminar(id) {
                $("#contenedor-articulo").load("http://localhost/inventarios/articulo/action_form_delete", {
                    id: id});
                App.scrollTop();
            }

            function fn_articuloproveedor_editar(id) {
                $("#capa-proveedor-datos-articulo").load("http://localhost/inventarios/articuloproveedor/action_form_edit", {
                    id: id});
                App.scrollTop();
            }

            function fn_tg_articuloproveedor_grid() {
                $("#capa-proveedor-datos-articulo").load("http://localhost/inventarios/articuloproveedor/action_grid", {});
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_ordencompra_nuevo() {
                $("#contenedor-ordencompra").load("http://localhost/inventarios/ordencompra/action_form_new");
                App.scrollTop();
            }
            function fn_ordencompra_grid() {
                $("#contenedor-ordencompra").load("http://localhost/inventarios/ordencompra/action_grid");
                App.scrollTop();
            }
            function fn_ordencompra_editar(id) {
                $("#contenedor-ordencompra").load("http://localhost/inventarios/ordencompraeditar/action_form", {
                    id: id});
                App.scrollTop();
            }
            function fn_ordencompra_eliminar(id) {
                $("#contenedor-ordencompra").load("http://localhost/inventarios/ordencompra/action_form_delete", {
                    id: id});
                App.scrollTop();
            }
            //OC NUEVO
            function fn_agregar_producto_oc() {

                $("#capa-detalle-ordencompra").load("http://localhost/inventarios/ordencompra/action_add_producto_new", {
                    producto_id: $("#producto_id").val(), precio: $("#precio").val(), cantidad: $("#cantidad").val(), producto: $("#producto").val()
                }, function () {
                    fn_clear_producto_oc();
                });
            }

            function fn_grid_producto_oc() {
                $("#capa-detalle-ordencompra").load("http://localhost/inventarios/ordencompra/action_cancelar_producto_new", {
                });
                fn_clear_producto_oc();
            }

            function fn_producto_editar_oc(detalle_id) {
                $.ajax({
                    url: "http://localhost/inventarios/ordencompra/action_editar_producto_new",
                    type: 'POST',
                    data: {detalle_id: detalle_id},
                    dataType: 'json',
                    success: function (ui) {
                        console.log(ui)
                        $("#producto_id").val(ui.producto_id);
                        $("#producto").val(ui.producto);
                        $("#precio").val(ui.precio);
                        $("#cantidad").val(ui.cantidad);
                    }
                });
            }

            function fn_producto_eliminar_oc(detalle_id) {
                $("#capa-detalle-ordencompra").load("http://localhost/inventarios/ordencompra/action_eliminar_producto_new", {
                    detalle_id: detalle_id
                });
            }

            function fn_clear_producto_oc() {

                $("#producto_id").val("");
                $("#producto").val("");
                $("#precio").val("");
                $("#cantidad").val("");
            }
            //OC EDITAR
            function fn_agregar_producto_oc_editar() {

                $("#capa-detalle-ordencompra").load("http://localhost/inventarios/ordencompraeditar/action_add_producto_new", {
                    producto_id: $("#producto_id").val(), precio: $("#precio").val(), cantidad: $("#cantidad").val(), producto: $("#producto").val()
                }, function () {
                    fn_clear_producto_oc();
                });
            }

            function fn_grid_producto_oc_editar() {
                $("#capa-detalle-ordencompra").load("http://localhost/inventarios/ordencompraeditar/action_cancelar_producto_new", {
                });
                fn_clear_producto_oc();
            }

            function fn_producto_eliminar_oc_editar(detalle_id) {
                $("#capa-detalle-ordencompra").load("http://localhost/inventarios/ordencompraeditar/action_eliminar_producto_new", {
                    detalle_id: detalle_id
                });
            }

            function fn_producto_editar_oc_editar(detalle_id) {
                $.ajax({
                    url: "http://localhost/inventarios/ordencompraeditar/action_editar_producto_new",
                    type: 'POST',
                    data: {detalle_id: detalle_id},
                    dataType: 'json',
                    success: function (ui) {
                        console.log(ui)
                        $("#producto_id").val(ui.producto_id);
                        $("#producto").val(ui.producto);
                        $("#precio").val(ui.precio);
                        $("#cantidad").val(ui.cantidad);
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function fn_guiaingreso_nuevo() {
                $("#contenedor-guiaingreso").load("http://localhost/inventarios/guiaingreso/action_form_new");
            App.scrollTop();
            }
            function fn_guiaingreso_grid() {
                $("#contenedor-guiaingreso").load("http://localhost/inventarios/guiaingreso/action_grid");
                App.scrollTop();
            }
            function fn_guiaingreso_editar(id) {
                $("#contenedor-guiaingreso").load("http://localhost/inventarios/guiaingresoeditar/action_form", {
                    id: id});
                App.scrollTop();
            }
            function fn_guiaingreso_eliminar(id) {
                $("#contenedor-guiaingreso").load("http://localhost/inventarios/guiaingreso/action_form_delete", {
                    id: id});
                App.scrollTop();
            }
            //OC NUEVO
            function fn_agregar_producto_gi() {

                $("#capa-detalle-guiaingreso").load("http://localhost/inventarios/guiaingreso/action_add_producto_new", {
                    producto_id: $("#producto_id").val(), precio: $("#precio").val(), cantidad: $("#cantidad").val(), producto: $("#producto").val()
                }, function () {
                    fn_clear_producto_gi();
                });
            }

            function fn_grid_producto_gi() {
                $("#capa-detalle-guiaingreso").load("http://localhost/inventarios/guiaingreso/action_cancelar_producto_new", {
                });
                fn_clear_producto_gi();
            }

            function fn_producto_editar_gi(detalle_id) {
                $.ajax({
                    url: "http://localhost/inventarios/guiaingreso/action_editar_producto_new",
                    type: 'POST',
                    data: {detalle_id: detalle_id},
                    dataType: 'json',
                    success: function (ui) {
                        console.log(ui)
                        $("#producto_id").val(ui.producto_id);
                        $("#producto").val(ui.producto);
                        $("#precio").val(ui.precio);
                        $("#cantidad").val(ui.cantidad);
                    }
                });
            }

            function fn_producto_eliminar_gi(detalle_id) {
                $("#capa-detalle-guiaingreso").load("http://localhost/inventarios/guiaingreso/action_eliminar_producto_new", {
                    detalle_id: detalle_id
                });
            }

            function fn_clear_producto_gi() {

                $("#producto_id").val("");
                $("#producto").val("");
                $("#precio").val("");
                $("#cantidad").val("");
            }
            //OC EDITAR
            function fn_agregar_producto_gi_editar() {

                $("#capa-detalle-guiaingreso").load("http://localhost/inventarios/guiaingresoeditar/action_add_producto_new", {
                    producto_id: $("#producto_id").val(), precio: $("#precio").val(), cantidad: $("#cantidad").val(), producto: $("#producto").val()
                }, function () {
                    fn_clear_producto_gi();
                });
            }

            function fn_grid_producto_gi_editar() {
                $("#capa-detalle-guiaingreso").load("http://localhost/inventarios/guiaingresoeditar/action_cancelar_producto_new", {
                });
                fn_clear_producto_gi();
            }

            function fn_producto_eliminar_gi_editar(detalle_id) {
                $("#capa-detalle-guiaingreso").load("http://localhost/inventarios/guiaingresoeditar/action_eliminar_producto_new", {
                    detalle_id: detalle_id
                });
            }

            function fn_producto_editar_gi_editar(detalle_id) {
                $.ajax({
                    url: "http://localhost/inventarios/guiaingresoeditar/action_editar_producto_new",
                    type: 'POST',
                    data: {detalle_id: detalle_id},
                    dataType: 'json',
                    success: function (ui) {
                        console.log(ui)
                        $("#producto_id").val(ui.producto_id);
                        $("#producto").val(ui.producto);
                        $("#precio").val(ui.precio);
                        $("#cantidad").val(ui.cantidad);
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function fn_guiasalida_nuevo() {
                $("#contenedor-guiasalida").load("http://localhost/inventarios/guiasalida/action_form_new");
                App.scrollTop();
            }
            function fn_guiasalida_grid() {
                $("#contenedor-guiasalida").load("http://localhost/inventarios/guiasalida/action_grid");
                App.scrollTop();
            }
            function fn_guiasalida_editar(id) {
                $("#contenedor-guiasalida").load("http://localhost/inventarios/guiasalidaeditar/action_form", {
                    id: id});
                App.scrollTop();
            }
            function fn_guiasalida_eliminar(id) {
                $("#contenedor-guiasalida").load("http://localhost/inventarios/guiasalida/action_form_delete", {
                    id: id});
                App.scrollTop();
            }
            //OC NUEVO
            function fn_agregar_producto_gs() {

                $("#capa-detalle-guiasalida").load("http://localhost/inventarios/guiasalida/action_add_producto_new", {
                    producto_id: $("#producto_id").val(), precio: $("#precio").val(), cantidad: $("#cantidad").val(), producto: $("#producto").val()
                }, function () {
                    fn_clear_producto_gs();
                });
            }

            function fn_grid_producto_gs() {
                $("#capa-detalle-guiasalida").load("http://localhost/inventarios/guiasalida/action_cancelar_producto_new", {
                });
                fn_clear_producto_gs();
            }

            function fn_producto_editar_gs(detalle_id) {
                $.ajax({
                    url: "http://localhost/inventarios/guiasalida/action_editar_producto_new",
                    type: 'POST',
                    data: {detalle_id: detalle_id},
                    dataType: 'json',
                    success: function (ui) {
                        console.log(ui)
                        $("#producto_id").val(ui.producto_id);
                        $("#producto").val(ui.producto);
                        $("#precio").val(ui.precio);
                        $("#cantidad").val(ui.cantidad);
                    }
                });
            }

            function fn_producto_eliminar_gs(detalle_id) {
                $("#capa-detalle-guiasalida").load("http://localhost/inventarios/guiasalida/action_eliminar_producto_new", {
                    detalle_id: detalle_id
                });
            }

            function fn_clear_producto_gs() {

                $("#producto_id").val("");
                $("#producto").val("");
                $("#precio").val("");
                $("#cantidad").val("");
            }
            //OC EDITAR
            function fn_agregar_producto_gs_editar() {

                $("#capa-detalle-guiasalida").load("http://localhost/inventarios/guiasalidaeditar/action_add_producto_new", {
                    producto_id: $("#producto_id").val(), precio: $("#precio").val(), cantidad: $("#cantidad").val(), producto: $("#producto").val()
                }, function () {
                    fn_clear_producto_gs();
                });
            }

            function fn_grid_producto_gs_editar() {
                $("#capa-detalle-guiasalida").load("http://localhost/inventarios/guiasalidaeditar/action_cancelar_producto_new", {
                });
                fn_clear_producto_gs();
            }

            function fn_producto_eliminar_gs_editar(detalle_id) {
                $("#capa-detalle-guiasalida").load("http://localhost/inventarios/guiasalidaeditar/action_eliminar_producto_new", {
                    detalle_id: detalle_id
                });
            }

            function fn_producto_editar_gs_editar(detalle_id) {
                $.ajax({
                    url: "http://localhost/inventarios/guiasalidaeditar/action_editar_producto_new",
                    type: 'POST',
                    data: {detalle_id: detalle_id},
                    dataType: 'json',
                    success: function (ui) {
                        console.log(ui)
                        $("#producto_id").val(ui.producto_id);
                        $("#producto").val(ui.producto);
                        $("#precio").val(ui.precio);
                        $("#cantidad").val(ui.cantidad);
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function contacto_04d5c90def216ac1c989c9363e11ba8d() {
                $("#contenedor-contacto").load("http://localhost/inventarios/contacto/action_form_new");
                App.scrollTop();
            }

            function contacto_32e1139e3989005aee64dc8eaeb5c9d8() {
                $("#contenedor-contacto").load("http://localhost/inventarios/contacto/action_grid");
                App.scrollTop();
            }


            function contacto_8e623a302d6d8071525816abe5c9c896(id) {
                $("#contenedor-contacto").load("http://localhost/inventarios/contacto/action_form_edit", {
                    form_317a09469468de09f2c70f385eba0919: id
                });
                App.scrollTop();
            }

            function contacto_eeebb281a1713953ce792ae2e2388b61(id) {
                $("#contenedor-contacto").load("http://localhost/inventarios/contacto/action_form_delete", {
                    form_317a09469468de09f2c70f385eba0919: id
                });
                App.scrollTop();
            }

            function contacto_bca71f2f80f76a56fb69d5dd96edf2fa() {
                $("#contenedor-contacto").load("http://localhost/inventarios/contacto/action_form_copy", {
                    form_317a09469468de09f2c70f385eba0919: $("#317a09469468de09f2c70f385eba0919").val()
                });
                App.scrollTop();
            }

            function contacto_ea5289580b0a1b618521ebaf7ead815c(id) {
                $("#contenedor-contacto").load("http://localhost/inventarios/contacto/action_form_copy", {
                    form_317a09469468de09f2c70f385eba0919: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">    
            function empresa_2521ed0a98186cb8298cfc934af3c252() {
                $("#contenedor-empresa").load("http://localhost/inventarios/empresa/action_form_new");
                App.scrollTop();
            }

            function empresa_0aa7e5e5cab501e19dfbe7cbcee73e1a() {
                $("#contenedor-empresa").load("http://localhost/inventarios/empresa/action_grid");
                App.scrollTop();
            }

            function empresa_02e7f7ef522e032a38e0fe91ff8a623b(id) {
                $("#contenedor-empresa").load("http://localhost/inventarios/empresa/action_form_edit", {
                    form_2ce2c79c91811bdac400e483805652a4: id
                });
                App.scrollTop();
            }

            function empresa_12de8c7f5a570874657aeda938561dea(id) {
                $("#contenedor-empresa").load("http://localhost/inventarios/empresa/action_form_delete", {
                    form_2ce2c79c91811bdac400e483805652a4: id
                });
                App.scrollTop();
            }


            function sector_c2f35f184a693693edd62fac2a703c9d(id) {
                var v = $("#" + id).val()

                $("#capa-combo-subsector").load("http://localhost/inventarios/empresa/action_change_subsector", {
                    form_9e7dcc68a5171b1dc8f4e8cc88aef94b: v
                });


            }
        </script>
        <script type="text/javascript">
            function fn_tg_encuesta_nuevo() {
                App.blockUI($('.page-content'), false);
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta/action_form_new", function () {
                    App.unblockUI($('.page-content'), false);
                });

                App.scrollTop();
            }

            function fn_tg_encuesta_cancelar() {
                App.blockUI($('.page-content'), false);
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta/action_grid", function () {
                    App.unblockUI($('.page-content'), false);
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_editar(id) {
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta_editar/action_form_encuesta", {
                    id_encuesta: id
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_copy(id) {
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta/action_form_copy", {
                    id_encuesta: id
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_eliminar(id) {
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta/action_form_delete", {
                    id_encuesta: id
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_pregunta(id) {
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta_pregunta/action_form", {
                    id_encuesta: id
                });
                App.scrollTop();
            }

            function fn_tg_cargar_secciones_encuesta() {
                $("#capa-encuesta-pregunta-sector").load("http://localhost/inventarios/encuesta_pregunta/action_grid", {
                    id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }


            function fn_tg_encuesta_agregar_seccion() {
                $("#capa-encuesta-pregunta-sector").html("Cargando...");
                $("#capa-encuesta-pregunta-sector").load("http://localhost/inventarios/encuesta_pregunta/action_grid_secciones", {
                    id_encuesta: $("#id_encuesta").val()
                });
            }


            function fn_tg_encuesta_contacto(id) {
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta_contacto/action_grid", {
                    id_encuesta: id
                });
                App.scrollTop();
            }



            function fn_tg_encuesta_configurar(id) {
                $("#contenedor-encuesta").load("http://localhost/inventarios/encuesta_configurar/action_form_encuesta", {
                    id_encuesta: id
                });
                App.scrollTop();
            }


            function fn_tg_publicacion_cancelar() {
                App.blockUI($('.page-content'), false);
                $("#contenedor-encuesta").load("http://localhost/inventarios/publicacion/action_grid", function () {
                    App.unblockUI($('.page-content'), false);
                });
                App.scrollTop();
            }


            function fn_tg_encuesta_alerta_nuevo() {
                $("#capa-alertas-datos-encuesta").load("http://localhost/inventarios/encuesta_alerta/action_form_new", {
                    id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_alerta_editar(id) {
                $("#capa-alertas-datos-encuesta").load("http://localhost/inventarios/encuesta_alerta/action_form_edit", {
                    id_encuesta_alerta: id, id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_alerta_eliminar(id) {
                $("#capa-alertas-datos-encuesta").load("http://localhost/inventarios/encuesta_alerta/action_form_delete", {
                    id_encuesta_alerta: id, id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }

            function fn_tg_encuesta_alerta_cancelar() {
                $("#capa-alertas-datos-encuesta").load("http://localhost/inventarios/encuesta_alerta/action_grid", {
                    id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            //GIRO EMPRESA
            function giro_6a28e8d9be68f92eacac2c262958b504() {
                $("#contenedor-giro_empresa").load("http://localhost/inventarios/giro_empresa/action_form_new");
                App.scrollTop();
            }

            function giro_3b200fe33a8f8013620f4f1f7a908325() {
                $("#contenedor-giro_empresa").load("http://localhost/inventarios/giro_empresa/action_grid");
                App.scrollTop();
            }

            function giro_20961e5b0e84d64e5f7f51639b9af8a9(id) {
                $("#contenedor-giro_empresa").load("http://localhost/inventarios/giro_empresa/action_form_edit", {
                    form_ead2672f07a8368c0ab008747f2db26a: id
                });
                App.scrollTop();
            }

            function giro_490a2631b9c947217672677700a06393(id) {
                $("#contenedor-giro_empresa").load("http://localhost/inventarios/giro_empresa/action_form_delete", {
                    form_ead2672f07a8368c0ab008747f2db26a: id
                });
                App.scrollTop();
            }

        </script>
        <script type="text/javascript">
            function fn_tg_opcion_nuevo() {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_new");
                App.scrollTop();
            }

            function fn_tg_opcion_cancelar() {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_grid", {
                    id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }

            function fn_tg_opcion_editar(id) {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_new_edit", {
                    id_opcion: id, id_encuesta_opcion: $("#id_encuesta").val()
                });
                App.scrollTop();
            }
            function fn_tg_opciones_opcion_editar(id_opcion, id_opciones) {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_edit_opciones", {
                    id_opcion: id_opcion, id_opciones: id_opciones, id_encuesta_opcion: $("#id_encuesta").val()
                });
            }

            function fn_tg_opciones_opcion_eliminar(id_opcion, id_opciones) {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_delete_opciones", {
                    id_opcion: id_opcion, id_opciones: id_opciones
                });
                App.scrollTop();
            }

            function fn_tg_editar_opciones(id) {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_new_edit", {
                    id_opcion: id
                });
                App.scrollTop();
            }

            function fn_tg_opcion_editar_inline() {

                $("#capa-respuesta-datos-encuestaes").load("http://localhost/inventarios/opcion/action_form_edit", {
                    id_opcion: $("#id_opcion").val()
                });
                App.scrollTop();
            }


            function fn_tg_opcion_eliminar(id) {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_delete", {
                    id_opcion: id
                });
                App.scrollTop();
            }

            function fn_tg_cancelar_opciones() {
                $("#capa-respuesta-datos-encuesta").load("http://localhost/inventarios/opcion/action_form_new_opciones", {
                    id_opcion: $("#id_opcion").val()
                });
                App.scrollTop();
            }

        </script>
        <script type="text/javascript">    
            function fn_tg_opciones_nuevo() {
                $("#contenedor-opciones").load("http://localhost/inventarios/opciones/action_form_new");
                App.scrollTop();
            }

            function fn_tg_opciones_cancelar() {
                $("#contenedor-opciones").load("http://localhost/inventarios/opciones/action_grid");
                App.scrollTop();
            }

            function fn_tg_opciones_editar(id) {
                $("#contenedor-opciones").load("http://localhost/inventarios/opciones/action_form_edit", {
                    id_opciones: id
                });
                App.scrollTop();
            }

            function fn_tg_opciones_eliminar(id) {
                $("#contenedor-opciones").load("http://localhost/inventarios/opciones/action_form_delete", {
                    id_opciones: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function fn_tg_pregunta_nueva() {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_new_nivel_1", {
                    id_encuesta: $("#id_encuesta").val()
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                });
                App.scrollTop();
            }

            function fn_tg_pregunta_cancelar() {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_grid", {
                    id_encuesta: $("#id_encuesta").val()
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                });
                App.scrollTop();
            }

            function fn_tg_cargar_opciones_grid(id) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#contenedor-lista-opciones").load("http://localhost/inventarios/pregunta/action_grid_opciones", {
                    id_opcion: $("#" + id).val(), id_encuesta: $("#id_encuesta").val()
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
            }

            function fn_tg_pregunta_editar(id) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_edit_nivel_1", {
                    id_pregunta: id, id_encuesta: $("#id_encuesta").val()
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }

            function fn_tg_pregunta_editar_nivel_2(id, id_padre_nivel_1) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_edit_nivel_2", {
                    id_pregunta: id, id_padre_nivel_1: id_padre_nivel_1
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }

            function fn_tg_pregunta_editar_nivel_3(id, id_padre_nivel_2, id_padre_nivel_1) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_edit_nivel_3", {
                    id_pregunta: id, id_padre_nivel_1: id_padre_nivel_1, id_padre_nivel_2: id_padre_nivel_2
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }

            function fn_tg_pregunta_eliminar(id) {
                App.blockUI($('#contenedor-encuesta'), false);
                s
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_delete", {
                    id_pregunta: id
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }

            function fn_tg_seleccionar_formato_pregunta(id) {
                var v = $("#" + id).val();

                if (parseInt(v) == 1) {
                    $("#capa-pregunta-opciones").load("http://localhost/inventarios/pregunta/action_show_opciones", {
                        id_encuesta: $("#id_encuesta").val()
                    });
                    $("#capa-pregunta-codigo").load("http://localhost/inventarios/pregunta/action_codigo");
                } else {
                    $("#capa-pregunta-opciones").html("");
                    $("#capa-pregunta-codigo").html("");
                }
            }

            function fn_tg_finalizar_pregunta_nivel_2() {

                $("#opcion_guardar").val(1);
                $("#form-pregunta-nivel").submit();
                App.scrollTop();
            }

            function fn_tg_continuar_pregunta_nivel_2() {

                $("#opcion_guardar").val(2);
                $("#form-pregunta-nivel").submit();
                App.scrollTop();
            }

            function fn_tg_finalizar_pregunta_nivel_3() {

                $("#opcion_guardar").val(3);
                $("#form-pregunta-nivel").submit();
                App.scrollTop();
            }

            function fn_tg_continuar_pregunta_nivel_3() {

                $("#opcion_guardar").val(2);
                $("#form-pregunta-nivel").submit();
                App.scrollTop();
            }

            function fn_tg_finalizar_regresar_nivel_2(id_pregunta) {
                App.blockUI($('#contenedor-encuesta'), false);
                $('#capa-pregunta-datos-encuesta').load("http://localhost/inventarios/pregunta/action_form_new_nivel_2/" + id_pregunta, {
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                });
                App.scrollTop();
            }

            function fn_tg_nueva_pregunta_nivel_2(id_pregunta) {
                App.blockUI($('#contenedor-encuesta'), false);
                $('#capa-pregunta-datos-encuesta').load("http://localhost/inventarios/pregunta/action_form_new_nivel_2/" + id_pregunta, {
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                });
                App.scrollTop();
            }

            function fn_tg_nueva_pregunta_nivel_3(id_pregunta, id_padre) {
                App.blockUI($('#contenedor-encuesta'), false);
                $('#capa-pregunta-datos-encuesta').load("http://localhost/inventarios/pregunta/action_form_new_nivel_3/" + id_pregunta + '/' + id_padre, {
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                });
                App.scrollTop();
            }


            function fn_tg_pregunta_copy(id) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_copy", {
                    id_pregunta: id
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }


            //==========================================================================


            function fn_tg_pregunta_eliminar_nivel_3(id, id_padre_nivel_2, id_padre_nivel_1) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_delete_nivel_3", {
                    id_pregunta: id, id_padre_nivel_1: id_padre_nivel_1, id_padre_nivel_2: id_padre_nivel_2
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }


            function fn_tg_pregunta_eliminar_nivel_2(id, id_padre_nivel_1) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_delete_nivel_2", {
                    id_pregunta: id, id_padre_nivel_1: id_padre_nivel_1
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }

            function fn_tg_pregunta_eliminar_nivel_1(id) {
                App.blockUI($('#contenedor-encuesta'), false);
                $("#capa-pregunta-datos-encuesta").load("http://localhost/inventarios/pregunta/action_form_delete_nivel_1", {
                    id_pregunta: id, id_encuesta: $("#id_encuesta").val()
                }, function () {
                    App.unblockUI($('#contenedor-encuesta'), false);
                })
                App.scrollTop();
            }

        </script>
        <script type="text/javascript">   
            function fn_tg_seccion_nuevo() {
                $("#capa-seccion-datos-encuesta").load("http://localhost/inventarios/seccion/action_form_new");
                App.scrollTop();
            }

            function fn_tg_seccion_cancelar() {
                $("#capa-seccion-datos-encuesta").load("http://localhost/inventarios/seccion/action_grid", {
                    id_encuesta: $("#id_encuesta").val()
                });
                App.scrollTop();
            }

            function fn_tg_seccion_editar(id) {
                $("#capa-seccion-datos-encuesta").load("http://localhost/inventarios/seccion/action_form_edit", {
                    id_seccion: id
                });
                App.scrollTop();
            }

            function fn_tg_seccion_eliminar(id) {
                $("#capa-seccion-datos-encuesta").load("http://localhost/inventarios/seccion/action_form_delete", {
                    id_seccion: id
                });
                App.scrollTop();
            }
        </script>
        <script type="text/javascript">
            function subsector_2fe9a6f8e1e11ed0e6ce98e86c742f54() {
                $("#contenedor-subsector").load("http://localhost/inventarios/subsector/action_form_new")
            }

            function subsector_906f028f568b4fde1d85554ea5361e8b() {
                $("#contenedor-subsector").load("http://localhost/inventarios/subsector/action_grid")
            }

            function subsector_261f3dedccf04fb8f2911c197fc8db90(id) {
                $("#contenedor-subsector").load("http://localhost/inventarios/subsector/action_form_edit", {
                    form_e821ab3f1dbc1983fdbb0a9620db5478: id
                })
            }
            function subsector_0d555e620776d77f088ead29b03a2c1c(id) {
                $("#contenedor-subsector").load("http://localhost/inventarios/subsector/action_form_delete", {
                    form_e821ab3f1dbc1983fdbb0a9620db5478: id
                })
            }
        </script>
        <script type="text/javascript">
            function cargo_9ca7847e5739c1838b4dd90836c1a62a() {
                $("#contenedor-cargo").load("http://localhost/inventarios/cargo/action_form_new");
                App.scrollTop();
            }

            function cargo_f3ba5c14b2eaac79dd4a8c6f88dc0695() {
                $("#contenedor-cargo").load("http://localhost/inventarios/cargo/action_grid");
                App.scrollTop();
            }

            function cargo_78ee902f96759c3f9c17ef4cb458a90f(id) {
                $("#contenedor-cargo").load("http://localhost/inventarios/cargo/action_form_edit", {
                    form_e784ec7c25227fc0f109f0b4b3bb9220: id
                });
                App.scrollTop();
            }

            function cargo_44c33a58227afcfcf635535e55f5639f(id) {
                $("#contenedor-cargo").load("http://localhost/inventarios/cargo/action_form_delete", {
                    form_e784ec7c25227fc0f109f0b4b3bb9220: id
                });
                App.scrollTop();
            }

            function fn_tg_mostrar_cargo(id) {

                $("#capa-cargo-empresa-info").load("http://localhost/inventarios/contacto/action_cargo_empresa", {
                    id_empresa: $("#" + id).val()
                })
            }
        </script>
        <script type="text/javascript">
            function clase_fd8471fae4758c99f9d6dc8a31b00b77() {
                $("#contenedor-clase").load("http://localhost/inventarios/clase/action_form_new");
                App.scrollTop();
            }

            function clase_6b037b5842980b0a9a765c6834f60278() {
                $("#contenedor-clase").load("http://localhost/inventarios/clase/action_grid");
                App.scrollTop();
            }

            function clase_9b8b8c1abc4b03fcd2624def32e24e40(id) {
                $("#contenedor-clase").load("http://localhost/inventarios/clase/action_form_edit", {
                    form_af7ee2f171632db5f3ced9f325fc4a31: id
                });
                App.scrollTop();
            }

            function clase_2166939cd0849c94d992e96c0c467eaa(id) {
                $("#contenedor-clase").load("http://localhost/inventarios/clase/action_form_delete", {
                    form_af7ee2f171632db5f3ced9f325fc4a31: id
                });
                App.scrollTop();
            }

            function fn_tg_mostrar_clase(id) {

                $("#capa-clase-empresa-info").load("http://localhost/inventarios/contacto/action_clase_empresa", {
                    id_empresa: $("#" + id).val()
                })
            }

        </script>
        <script type="text/javascript">
            function tipo_06d1577ef6dd828913b81283ac6a9f39() {
                $("#contenedor-encuesta_tipo").load("http://localhost/inventarios/encuesta_tipo/action_form_new");
                App.scrollTop();
            }

            function tipo_817448ca1d8c85168bcb6bcafa908f7e() {
                $("#contenedor-encuesta_tipo").load("http://localhost/inventarios/encuesta_tipo/action_grid");
                App.scrollTop();
            }

            function tipo_c424ae8d28d4b8c72d382472d2104bd1(id) {
                $("#contenedor-encuesta_tipo").load("http://localhost/inventarios/encuesta_tipo/action_form_edit", {
                    form_0d62fbf0144698a12f6fa116f2c97b44: id
                });
                App.scrollTop();
            }

            function tipo_a82a3c4abaa84c777ea31a8831d15700(id) {
                $("#contenedor-encuesta_tipo").load("http://localhost/inventarios/encuesta_tipo/action_form_delete", {
                    form_0d62fbf0144698a12f6fa116f2c97b44: id
                });
                App.scrollTop();
            }
        </script>
    </head>
    <body class="login">
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->fetch('script'); ?>
    </body>
</html>