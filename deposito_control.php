<?php

require 'clases/conexion.php';

session_start();

$sql = "select sp_deposito("
    . $_REQUEST['accion'] . ","
    . $_REQUEST['vddps_cod'] . ",'"
    . $_REQUEST['vdsp_descripcion'] . "',"
    //.$_REQUEST['vid_sucursal'].") as resul";
    . (!empty($_REQUEST['vdpsuc_cod']) ? $_REQUEST['vdpsuc_cod'] : "0") . ") as resul";
$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:deposito_index.php");
} else {
    $_SESSION['mensaje'] = "Error:" . $sql;
    header("location:deposito_index.php");
}
