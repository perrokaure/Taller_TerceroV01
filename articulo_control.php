<?php

require 'clases/conexion.php';
session_start();

$sql = "select sp_articulo(" . $_REQUEST['accion'] . "," . $_REQUEST['vart_cod']
        . ",'" . $_REQUEST['vart_codbarra'] . "'," . (!empty($_REQUEST['vmar_cod'])?$_REQUEST['vmar_cod']:"0")
        . ",'" . $_REQUEST['vart_descri'] . "'," . (!empty($_REQUEST['vart_precioc'])?$_REQUEST['vart_precioc']:"0")
        . ", " . (!empty($_REQUEST['vart_preciov'] )?$_REQUEST['vart_preciov']:"0")
        . "," . (!empty($_REQUEST['vtipo_cod'])?$_REQUEST['vtipo_cod']:"0") . ") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:articulo_index.php");
} else {
    $_SESSION['mensaje'] = "Error:".$sql;
    header("location:articulo_index.php");
}
