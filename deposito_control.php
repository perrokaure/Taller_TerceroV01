<?php

require 'clases/conexion.php';

session_start();

$sql="select sp_deposito("
.$_REQUEST['accion'].","
.$_REQUEST['vdep_cod'].",'"
.$_REQUEST['vdep_descri']."',"
//.$_REQUEST['vid_sucursal'].") as resul";
. (!empty($_REQUEST['vid_sucursal'])?$_REQUEST['vid_sucursal']:"0") . ") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $_SESSION['mensaje']= $resultado[0]['resul'];
    header("location:deposito_index.php");
}else{
    $_SESSION['mensaje']= "Error:".$sql;
    header("location:deposito_index.php");
}
