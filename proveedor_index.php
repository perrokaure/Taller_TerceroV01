<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="/lp3/favicon.ico">
    <title>LP3</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php
    session_start();/*Reanudar sesion*/
    require 'menu/css_lte.ctp';
    ?>
    <!--ARCHIVOS CSS-->
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <?php require 'menu/header_lte.ctp'; ?>
        <!--CABECERA PRINCIPAL-->
        <?php require 'menu/toolbar_lte.ctp'; ?>
        <!--MENU PRINCIPAL-->
        <div class="content-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php if (!empty($_SESSION['mensaje'])) { ?>
                            <div class="alert alert-danger" id="mensaje">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                <?php echo $_SESSION['mensaje'];
                                $_SESSION['mensaje'] = '';
                                ?>
                            </div>
                        <?php } ?>
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Proveedor</h3>
                                <div class="box-tools">
                                    <a class="btn btn-primary btn-sm" data-title="Agregar" rel="tooltip" data-toggle="modal" data-target="#registrar">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="proveedor_print.php" class="btn btn-default btn-sm" data-title="Imprimir" rel="tooltip" target="print">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <form action="proveedor_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="input-group custom-search-form">
                                                            <input type="search" class="form-control" name="buscar" placeholder="Ingrese valor a buscar..." autofocus="" />
                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-primary btn-flat" data-title="Buscar" rel="tooltip"><i class="fa fa-search"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <?php
                                        $cargos = consultas::get_datos("Select * from proveedor where 	prv_razonsocial like '%" . (isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : "") . "%'order by prv_cod");
                                        if (!empty($cargos)) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-condensed table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>RUT</th>
                                                            <th>Razón Social</th>
                                                            <th>Dirección</th>
                                                            <th>Telefono  </th>
                                                            <th class="text-center">Acciones</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php foreach ($cargos as $cargo) { ?>
                                                            <tr>
                                                                <td data-title="RUT"><?php echo $cargo['prv_ruc']; ?></td>
                                                                <td data-title="Razón Social"><?php echo $cargo['prv_razonsocial']; ?></td>
                                                                <td data-title="Dirección"><?php echo $cargo['prv_direccion']; ?></td>
                                                                <td data-title="Telefono"><?php echo $cargo['prv_telefono']; ?></td>

                                                                <td data-title="Acciones" class="text-center">

                                                                    <a onclick="editar(<?php echo "'" . $cargo['prv_ruc'] . "_" . $cargo['prv_razonsocial'] . "_" . $cargo['prv_direccion'] . "_" . $cargo['prv_telefono'] . "'"; ?>)" class="btn btn-warning btn-sm" role="buttom" data-title="Editar" rel="tooltip" data-toggle="modal" data-target="#editar">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                    <a onclick="borrar(<?php echo "'" . $cargo['prv_cod'] . "_" . $cargo['prv_cod'] . "'"; ?>)" class="btn btn-danger btn-sm" role="buttom" data-title="Borrar" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>


                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        <?php }
                                        else { ?>
                                            <div class="alert alert-info flat">
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                                No se han registrado Proveedores...
                                            </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'menu/footer_lte.ctp'; ?>
        <!--ARCHIVOS JS-->

        <!-- MODAL REGISTRAR -->
        <div class="modal fade" id="registrar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><i class="fa fa-plus"></i> <strong>Registrar Proveedor</strong></h4>
                    </div>
                    <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                        <input type="hidden" name="accion" value="1">
                        <!--input type="hidden" name="vprv_cod" value="0">
                        <input type="hidden" name="vprv_ruc" value="0">
                        <input type="hidden" name="vprv_razonsocial" value="0">
                        <input type="hidden" name="vprv_direccion" value="0">
                        <input type="hidden" name="vprv_telefono" value="0"-->
                        <input type="hidden" name="vprv_cod" value="0">
                        <!--div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">Codigo Proveedor:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vsuc_descri" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div-->

                        <!--input type="hidden" name="vprv_ruc" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">RUC:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_ruc" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>

                        <!--input type="hidden" name="vprv_razonsocial" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">RAZON SOCIAL:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_razonsocial" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>

                        <!--input type="hidden" name="vprv_direccion" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">DIRECCION:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_direccion" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>

                        <!--input type="hidden" name="vprv_telefono" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">TELEFONO:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_telefono" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>



                        <div class="modal-footer">
                            <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                <i class="fa fa-remove"></i> Cerrar</button>
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-floppy-o"></i> Registrar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- FIN MODAL REGISTRAR -->


        <!-- MODAL EDITAR -->
        <div class="modal fade" id="editar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title"><i class="fa fa-edit"></i> <strong>Editar Proveedor</strong></h4>
                    </div>
                    <form action="proveedor_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                        <input type="hidden" name="accion" value="2">
                        <input type="hidden" name="vprv_cod" id="cod" value="0" >

                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">RUC:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_ruc" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>

                        <!--input type="hidden" name="vprv_razonsocial" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">RAZON SOCIAL:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_razonsocial" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>

                        <!--input type="hidden" name="vprv_direccion" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">DIRECCION:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_direccion" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>

                        <!--input type="hidden" name="vprv_telefono" value="0"-->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-sm-2">TELEFONO:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="vprv_telefono" class="form-control" required="" autofocus="" />
                                </div>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="reset" data-dismiss="modal" class="btn btn-default pull-left">
                                <i class="fa fa-remove"></i> Cerrar</button>
                            <button type="submit" class="btn btn-warning pull-right">
                                <i class="fa fa-edit"></i> Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIN MODAL EDITAR -->
        <!-- MODAL BORRAR -->
        <div class="modal fade" id="borrar" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">x</button>
                        <h4 class="modal-title custom_align">Atenci&oacute;n!!!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="confirmacion"></div>
                    </div>
                    <div class="modal-footer">
                        <a id="si" class="btn btn-primary">
                            <i class="fa fa-check"></i> Si</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-remove"></i> No</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN MODAL BORRAR -->
    </div>
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->

    <script>
        $("#mensaje").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
        $(".modal").on('shown.bs.modal', function() {
            $(this).find('input:text:visible:first').focus();
        });
    </script>

    <script>
        function editar(datos) {
            var dat = datos.split("_");
          $("#cod").val(dat[0]);
            $("#descri").val(dat[1]);
        };

        function borrar(datos) {
            var dat = datos.split("_");
          //  $('#si').attr('href', 'proveedor_control.php? vprv_ruc =' + dat[0] + '&prv_ruc=' +  dat[1] + '&accion=3');
            $('#si').attr('href', 'proveedor_control.php? vprv_cod =' + dat[0] + '&vprv_cod=' +  dat[1] + '&accion=3');
            $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
            Desea borrrar la proveedor <strong>' + dat[1] + '</strong>?');
        }
    </script>


</body>

</html>
