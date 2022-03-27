
<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_pedcompras(".$_REQUEST['accion'].",".$_REQUEST['vped_com'].","
        .$_SESSION['emp_cod'].",".(!empty($_REQUEST['vprv_cod'])?$_REQUEST['vprv_cod']:"0").",".$_SESSION['id_sucursal'].") as resul";

//echo $sql;

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul']!=null) {
    $valor = explode("*",$resultado[0]['resul']);
    $_SESSION['mensaje'] = $valor[0];
    header("location:".$valor[1]);
}else{
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:pedcompras_index.php");
}
