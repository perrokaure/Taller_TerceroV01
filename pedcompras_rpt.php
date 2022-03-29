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
    require 'menu/css_lte.ctp'; ?>
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
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="fa fa-clipboard"></i>
                                <h3 class="box-title">Reporte de Pedido de Compras</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php $opcion = "2";
                                        if (isset($_GET['opcion'])) {
                                            $opcion = $_GET['opcion'];
                                        }
                                        ?>
                                        <form action="pedcompras_print.php" method="get" accept-charset="utf-8" class="form-horizontal" target="print">
                                            <input type="hidden" name="opcion" value="<?php echo $opcion; ?>" />
                                            <div class="box-body">
                                                <div class="col-lg-4">
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <strong>OPCIONES</strong>
                                                        </div>
                                                        <div class="panel-body">
                                                            <div class="list-group">
                                                                <a href="pedcompras_rpt.php?opcion=1" class="list-group-item">Por Fechas</a>
                                                                <a href="pedcompras_rpt.php?opcion=2" class="list-group-item">Por Proveedor</a>
                                                                <a href="pedcompras_rpt.php?opcion=3" class="list-group-item">Por Articulo</a>
                                                                <a href="pedcompras_rpt.php?opcion=4" class="list-group-item">Por Empleado</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="panel panel-primary">
                                                        <div class="panel-heading">
                                                            <strong>FILTROS</strong>
                                                        </div>
                                                        <div class="panel-body">
                                                            <?php switch ($opcion) {
                                                                case 1: //por fechas
                                                            ?>
                                                                    <div class="form-group has-feedback">
                                                                        <label class="control-label col-lg-2">Desde:</label>
                                                                        <div class="col-lg-6">
                                                                            <input type="date" name="vdesde" class="form-control" />
                                                                            <i class="fa fa-calendar form-control-feedback"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group has-feedback">
                                                                        <label class="control-label col-lg-2">Hasta:</label>
                                                                        <div class="col-lg-6">
                                                                            <input type="date" name="vhasta" class="form-control" />
                                                                            <i class="fa fa-calendar form-control-feedback"></i>
                                                                        </div>
                                                                    </div>
                                                                <?php break;
                                                                case 2: //por clientes
                                                                    $clientes = consultas::get_datos("Select prv_cod,prv_ruc,prv_razonsocial as nombres from proveedor where prv_cod  in (select prv_cod from pedido_cabcompra)"); ?>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Proveedor:</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <select class="form-control select2" name="vproveedor" required="">
                                                                                <option value="">Seleccione un Proveedor</option>
                                                                                <?php foreach ($clientes as $cliente) { ?>
                                                                                    <option value="<?php echo $cliente['prv_cod']; ?>"><?php echo $cliente['nombres']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php break;
                                                                case 3: //por articulos
                                                                    $articulos = consultas::get_datos("select * from v_articulo where art_cod in(select art_cod from detalle_pedcompra)"); ?>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Articulos:</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <select class="form-control select2" name="varticulo" required="">
                                                                                <option value="">Seleccione un articulo</option>
                                                                                <?php foreach ($articulos as $articulo) { ?>
                                                                                    <option value="<?php echo $articulo['art_cod']; ?>"><?php echo $articulo['art_descri'] . " " . $articulo['mar_descri']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                <?php break;
                                                                case 4: //por empleado
                                                                    $empleados = consultas::get_datos("select emp_cod,(emp_nombre||' '||emp_apellido) as nombres from empleado where emp_cod in(select emp_cod from pedido_cabcompra)"); ?>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-lg-2">Empleado:</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <select class="form-control select2" name="vempleado" required="">
                                                                                <option value="">Seleccione un empleado</option>
                                                                                <?php foreach ($empleados as $empleado) { ?>
                                                                                    <option value="<?php echo $empleado['emp_cod']; ?>"><?php echo $empleado['nombres']; ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            <?php break;
                                                            } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-print"></i> Listar</button>
                                            </div>
                                        </form>
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
    </div>
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->
</body>

</html>
