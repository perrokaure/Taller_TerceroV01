<?php

require 'clases/conexion.php';

session_start();

$sql = "select sp_usuarios(".$_REQUEST['accion'].","
        .$_REQUEST['vusu_cod'].",'"
        .$_REQUEST['vusu_nick']."','"
        .$_REQUEST['vusu_clave']."',"
        .$_REQUEST['vemp_cod'].","
        .$_REQUEST['vgru_cod'].","
        .$_REQUEST['vid_sucursal'].") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=NULL) {
    $_SESSION['mensaje']=$resultado[0]['resul'];
    header("location:usuarios_index.php");
}else{
    $_SESSION['mensaje']="ERROR: ".$sql;
    header("location:usuarios_index.php");
}
 