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
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header">
                                        <i class="fa fa-plus"></i>
                                        <h3 class="box-title">Agregar usuario</h3>
                                        <div class="box-tools">
                                            <a href="usuarios_index.php" class="btn-primary btn-sm" data-title="Volver" rel="tooltip">
                                                <i class="fa fa-arrow-left"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <form action="usuarios_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                        <div class="box-body">
                                            <input type="hidden" name="accion" value="1">
                                            <input type="hidden" name="vusu_cod" value="0">
                                            <div class="form-group">
                                                <label class="control-label col-lg-2 col-md-2 col-sm-2">Usuario:</label>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <input type="text" name="vusu_nick" class="form-control" required="" autofocus=""/>
                                                </div>
                                            </div>  
                                      
                                         <div class="form-group">
                                                <label class="control-label col-sm-2">Clave:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <input type="text" name="vusu_clave" class="form-control" required=""/>
                                                </div>
                                        </div>
                                          <div class="form-group">
                                               <label class="control-label col-lg-2">Empleado:</label>
                                               <div class="col-lg-5 col-md-5 col-sm-5">
                                                   <div class="input-group">
                                                       <?php $empleado = consultas::get_datos("select * from empleado  order by emp_cod"); ?>
                                                       <select class="form-control select2" name="vemp_cod" required="">
                                                           <option value="">Seleccione el codigo</option>
                                                           <?php foreach ($empleado as $empleado) { ?>
                                                              <option value="<?php echo $empleado['emp_cod']; ?>"><?php echo $empleado['emp_cod']; ?></option> 
                                                          <?php } ?>
                                                       </select> 
                                                       <span class="input-group-btn btn-flat">
                                                           <a class="btn btn-primary" data-title="Agregar al empleado" rel="tooltip" data-placement="top"
                                                              data-toggle="modal" data-target="#registrar2">
                                                               <i class="fa fa-plus"></i>
                                                           </a>
                                                       </span>
                                                   </div>
                                               </div>
                                           </div>
                                             <div class="form-group">
                                               <label class="control-label col-lg-2">Grupo:</label>
                                               <div class="col-lg-5 col-md-5 col-sm-5">
                                                   <div class="input-group">
                                                       <?php $grupos = consultas::get_datos("select * from grupos  order by gru_cod"); ?>
                                                       <select class="form-control select2" name="vgru_cod" required="">
                                                           <option value="">Seleccione el codigo</option>
                                                           <?php foreach ($grupos as $grupos) { ?>
                                                              <option value="<?php echo $grupos['gru_cod']; ?>"><?php echo $grupos['gru_cod']; ?></option> 
                                                          <?php } ?>
                                                       </select> 
                                                       <span class="input-group-btn btn-flat">
                                                           <a class="btn btn-primary" data-title="Agregar el grupo" rel="tooltip" data-placement="top"
                                                              data-toggle="modal" data-target="#registrar2">
                                                               <i class="fa fa-plus"></i>
                                                           </a>
                                                       </span>
                                                   </div>
                                               </div>
                                           </div>
                                             <div class="form-group">
                                               <label class="control-label col-lg-2">ID-Sucaursal:</label>
                                               <div class="col-lg-5 col-md-5 col-sm-5">
                                                   <div class="input-group">
                                                       <?php $sucursal = consultas::get_datos("select * from sucursal  order by id_sucursal "); ?>
                                                       <select class="form-control select2" name="vid_sucursal" required="">
                                                           <option value="">Seleccione el codigo</option>
                                                           <?php foreach ($sucursal as $sucursal) { ?>
                                                              <option value="<?php echo $sucursal['id_sucursal']; ?>"><?php echo $sucursal['id_sucursal']; ?></option> 
                                                          <?php } ?>
                                                       </select> 
                                                       <span class="input-group-btn btn-flat">
                                                           <a class="btn btn-primary" data-title="Agregar el sucursal" rel="tooltip" data-placement="top"
                                                              data-toggle="modal" data-target="#registrar2">
                                                               <i class="fa fa-plus"></i>
                                                           </a>
                                                       </span>
                                                   </div>
                                               </div>
                                           </div>
                                         </div>
                                        <div class="box-footer">
                                            <button type="reset" class="btn-default" data-title="Cancelar" rel="tooltip">
                                                <i class="fa fa-remove"></i> Cancelar</button>
                                            <button type="submit" class="btn-primary pull-right" data-title="Guardar" rel="tooltip">
                                            <i class="fa fa-floppy-o"></i> Registrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  <?php require 'menu/footer_lte.ctp'; ?><!--ARCHIVOS JS-->  
                  <div class="modal fade" id="registrar2" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" arial-label="close">x</button>
                                   <h4 class="modal-title"><i class="fa fa-plus"></i><strong> Empleado </strong></h4>
                              </div>
                              <form action="empleado_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vemp_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">codigo:</label>
                                          <div class="col-sm-10">
                                              <input type="number" name="vemp_cod" class="form-control" required=""/>
                                          </div>
                                      </div>    
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">nombre:</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="vemp_nombre" class="form-control" required="" />
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
                   <div class="modal fade" id="registrar2" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" arial-label="close">x</button>
                                   <h4 class="modal-title"><i class="fa fa-plus"></i><strong>Grupo</strong></h4>
                              </div>
                              <form action="grupos_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vgru_cod" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Codigo:</label>
                                          <div class="col-sm-10">
                                              <input type="number" name="vgru_cod" class="form-control" required=""/>
                                          </div>
                                      </div>    
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Nombre:</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="vgru_nombre" class="form-control" required="" />
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
                   <div class="modal fade" id="registrar2" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" arial-label="close">x</button>
                                   <h4 class="modal-title"><i class="fa fa-plus"></i><strong> Sucursal </strong></h4>
                              </div>
                              <form action="sucursal_control.php" method="post" accept-charset="utf-8" class="form-horizontal">
                                  <input type="hidden" name="accion" value="4">
                                  <input type="hidden" name="vid_sucursal" value="0">
                                  <div class="modal-body">
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">ID:</label>
                                          <div class="col-sm-10">
                                              <input type="number" name="vid_sucursal" class="form-control" required=""/>
                                          </div>
                                      </div>    
                                      <div class="form-group">
                                          <label class="control-label col-sm-2">Descripsion:</label>
                                          <div class="col-sm-4">
                                              <input type="text" name="vsuc_descri" class="form-control" required="" />
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
            </div>                  
        <?php require 'menu/js_lte.ctp'; ?><!--ARCHIVOS JS-->
        <script>
            $("#mensaje").delay(4000).slideUp(200, function(){
                $(this).alert('close');
            });
            $(".modal").on('shown.bs.modal', function(){
                $(this).find('input:text:visible:first').focus();
            });
        </script>
    </body>
</html>


