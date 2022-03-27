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
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <div class="box box-warning">
                            <div class="box-header">
                                <i class="fa fa-edit"></i>
                                <h3 class="box-title">Editar Pedido de Compras</h3>
                                <div class="box-tools">
                                    <a href="pedcompras_index.php" class="btn btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                        <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            </div>
                            <form action="pedcomrpas_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                <?php $pedidos = consultas::get_datos("select * from v_pedido_cabcompra where ped_com =" . $_REQUEST['vped_com']); ?>
                                <div class="box-body">
                                    <input type="hidden" name="accion" value="2" />
                                    <input type="hidden" name="vped_com" value="<?php echo $pedidos[0]['ped_com']; ?>" />
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                            <label>Fecha:</label>
                                            <input type="text" name="vped_fecha" class="form-control" value="<?php echo $pedidos[0]['ped_fecha']; ?>" readonly="" />
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <label>Proveedor:</label>
                                            <div class="input-group">
                                                <?php $clientes = consultas::get_datos("select prv_cod,prv_ruc,(prv_razonsocial) as nombres"
                                                    . " from proveedor order by prv_cod=".$pedidos[0]["prv_cod"]." desc"); ?>
                                                <select class="form-control select2" name="vcli_cod" required="">
                                                    <!--option value="">Seleccione un Proveedor</option-->
                                                    <?php foreach ($clientes as $cliente) { ?>
                                                        <option value="<?php echo $cliente['prv_cod']; ?>"><?php echo "(" . $cliente['prv_ruc'] . ") " . $cliente['nombres']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span class="input-group-btn btn-flat">
                                                    <a class="btn btn-primary" data-title="Agregar Proveedor " rel="tooltip" data-placement="top" data-toggle="modal" data-target="#registrar">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6 col-xs-12">
                                            <label>Sucursal:</label>
                                            <input type="text" class="form-control" value="<?php echo $pedidos[0]['suc_descri']; ?>" readonly="" />
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12">
                                            <label>Empleado:</label>
                                            <input type="text" class="form-control" value="<?php echo $pedidos[0]['empleado']; ?>" readonly="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="reset" class="btn btn-default" data-title="Cancelar" rel="tooltip">
                                        <i class="fa fa-remove"></i> Cancelar</button>
                                    <button type="submit" class="btn btn-warning pull-right" data-title="Guardar" rel="tooltip">
                                        <i class="fa fa-edit"></i> Actualizar</button>
                                </div>
                            </form>
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
