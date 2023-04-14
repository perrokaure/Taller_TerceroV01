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
            <!-- CONTENEDOR PRINCIPAL -->
            <div class="content">
                <!-- FILA 1 -->
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
                            <?php if ($_SESSION['Marca']['leer'] === 't') { ?>
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Modelo</h3>
                                    <div class="box-tools">
                                        <?php if ($_SESSION['Modelo']['insertar'] === 't') { ?>
                                            <a href="modelo_add.php" class="btn btn-primary btn-sm pull-right" data-title='Agregar' rel='tooltip' data-placement='top'><i class="fa fa-plus"></i></a>
                                            <a href="modelo_print.php" class="btn btn-default btn-sm pull-right" data-title='Imprimir' rel='tooltip' data-placement='top' target="_blank"><i class="fa fa-print"></i></a>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <form method="post" accept-charset="utf-8" class="form-horizontal">
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
                                            //consulta a la tabla marca
                                            $modelos = consultas::get_datos("select * from modelo where mod_descri ilike '%" . (isset($_REQUEST['buscar']) ? $_REQUEST['buscar'] : "") . "%' order by mod_cod");
                                            //var_dump($marcas);
                                            if (!empty($modelos)) { ?>
                                                <div class="table-responsive">
                                                    <table class="table table-condensed table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Modelo</th>
                                                                <th class="text-center">Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($modelos as $mod) { ?>
                                                                <tr>
                                                                    <td data-title='Descripción'><?php echo $mod['mod_descri']; ?></td>
                                                                    <td data-title='Acciones' class="text-center">
                                                                        <a href="modelo_edit.php?vmod_cod=<?php echo $mod['mod_cod']; ?>" class="btn btn-warning btn-sm" role='button' data-title='Editar' rel='tooltip' data-placement='top'>
                                                                            <span class="glyphicon glyphicon-edit"></span>
                                                                        </a>
                                                                        <a href="modelo_del.php?vmod_cod=<?php echo $mod['mod_cod']; ?>" class="btn btn-danger btn-sm" role='button' data-title='Borrar' rel='tooltip' data-placement='top'>
                                                                            <span class="glyphicon glyphicon-trash"></span>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php } else { ?>
                                                <div class="alert alert-info flat">
                                                    <span class="glyphicon glyphicon-info-sign"></span>
                                                    No se han registrado marcas...
                                                </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?php } else { ?>
                        <div class="box-body">
                            <div class="alert alert-info flat">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                No posee permisos para la página...
                            </div>
                        </div>
                    <?php }
                    ?>
                    </div>
                </div>
                <!-- FIN FILA 1 -->
            </div>
            <!-- FIN CONTENEDOR PRINCIPAL -->
        </div>
        <?php require 'menu/footer_lte.ctp'; ?>
        <!--ARCHIVOS JS-->
    </div>
    <?php require 'menu/js_lte.ctp'; ?>
    <!--ARCHIVOS JS-->
    <script>
        $("#mensaje").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        })
    </script>
</body>

</html>