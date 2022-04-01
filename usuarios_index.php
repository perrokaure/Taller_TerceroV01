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
        require 'menu/css_lte.ctp'; ?><!--ARCHIVOS CSS-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php require 'menu/header_lte.ctp'; ?><!--CABECERA PRINCIPAL-->
            <?php require 'menu/toolbar_lte.ctp';?><!--MENU PRINCIPAL-->
            <div class="content-wrapper">
                <div class="content">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php 
                                if (!empty($_SESSION['mensaje'])) { ?>
                                    <div class="alert alert-danger" id="mensaje">
                                        <span class="glyphicon glyphicon-info-sign"></span>
                                        <?php
                                         echo $_SESSION['mensaje'];
                                         $_SESSION['mensaje']='';
                                        ?>
                                    </div>
                                <?php } ?>
                                <div class="box box-primary">
                                    <div class="box-header">
                                     <i class="ion ion-clipboard"></i>
                                        <h3 class="box-title">Usuarios</h3>
                                        <div class="box-tools">
                                             <a href="usuarios_add.php" class="btn btn-primary btn-sm" data-title='Agregar' rel='tooltip' data-placement='bottom'>
                                                <i class="fa fa-plus"></i>
                                            </a> 
                                            <a href="usuarios_print.php" class="btn btn-default btn-sm" data-title='Imprimir' rel='tooltip' data-placement='bottom'>
                                                <i class="fa fa-print"></i>
                                            </a>                                          
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12>"
                                                 <form action="usuarios_index.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                                      <div class="box-body">
                                                          <div class="form-group">
                                                              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                  <div class="input-group custom-search-form">
                                                                      <input type="search" class="form-control" name="buscar" placeholder="Ingrese valor a buscar..."
                                                                             autofocus=""/>
                                                                      <span class="input-group-btn">
                                                                          <button type="submit" class="btn btn-primary" data-title="Buscar" rel="tooltip">
                                                                              <i class="fa fa-search"></i>
                                                                          </button>
                                                                      </span>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </form>
                                                 <?php 
                                                 $usuarios = consultas::get_datos("select * from usuarios where usu_nick ilike '%".(isset($_REQUEST['buscar'])?$_REQUEST['buscar']:"")."%' order by usu_cod"); 
                                                    if (!empty($usuarios)){ ?>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Usuarios</th> 
                                                                        <th>Clave</th> 
                                                                        <th>Empleados</th> 
                                                                        <th>Grupo</th>
                                                                          <th>ID Sucursal</th> 
                                                                        <th class="text-center">Acciones</th> 
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                     foreach ($usuarios as $usuarios) { ?>
                                                                        <tr>
                                                                            <td data-title='Usuarios'><?php echo $usuarios['usu_nick'];?></td>
                                                                            <td data-title='Clave'><?php echo $usuarios['usu_clave'];?></td>
                                                                            <td data-title='Empleados'><?php echo $usuarios['emp_cod'];?></td>
                                                                            <td data-title='Grupo'><?php echo $usuarios['gru_cod'];?></td>
                                                                            <td data-title='ID Sucursal'><?php echo $usuarios['id_sucursal'];?></td>
                                                                            <td data-title='Acciones' class="text-center">
                                                                                <a href="usuarios_edit.php?vusu_cod=<?php echo $usuarios['usu_cod'];?>" class="btn btn-warning btn-sm" role='button' 
                                                                                   data-title='Editar' rel='tooltip' data-placement='top'>
                                                                                    <span class="glyphicon glyphicon-edit"></span>
                                                                                </a>
                                                                                 <a onclick="borrar(<?php echo "'".$usuarios['usu_cod']."_".$usuarios['usu_nick']."_".$usuarios['usu_clave']."_".$usuarios['emp_cod']."_".$usuarios['gru_cod']."_".$usuarios['id_sucursal']."'"; ?>)" class="btn btn-danger btn-sm" role="buttom"
                                                                                    data-title="Borrar" rel="tooltip" data-toggle="modal" data-target="#borrar">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php }?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                   <?php  }else{ ?>
                                                        <div class="alert alert-info flat">
                                                            <span class="glyphicon glyphicon-info-sign"></span>
                                                            No se han registrado articulos..
                                                        </div>
                                                   <?php  }
                                                 ?>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?>
                   <div class="modal fade" id="borrar" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" arial-label="close">X</button>
                                   <h4 class="modal-title custom-align">ATENCI&Oacute;N!!!</h4>
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
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200,function(){
                $(this).alert('close');
            })
        </script>
        <script>
            function borrar(datos){
               var dat = datos.split("_");
               $('#si').attr('href','usuarios_control.php?vusu_cod='+dat[0]+'&vusu_nick='+dat[1]+'&vusu_clave='+dat[2]+'&vemp_cod='+dat[3]+'&vgru_cod='+dat[4]+'&vid_sucursal='+dat[5]+'&accion=3');
               $('#confirmacion').html('<span class="glyphicon glyphicon-warning-sign"></span> \n\
                 Desea Borrar al usuarios <strong>'+dat[1]+'</strong> ?');
            };
            
        </script>
    </body>
</html>


