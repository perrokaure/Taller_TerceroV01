<?php

require 'clases/conexion.php';


$sql = "select sp_marca(" . $_REQUEST['accion'] . "," . $_REQUEST['vmar_cod'] . ",'" . $_REQUEST['vmar_descri'] . "') as resul";
session_start(); /* reanudar la sesión */

//echo $sql;
$resultado = consultas::get_datos($sql);
//echo $resultado;


if ($resultado[0]['resul'] != null) {
    $valor = explode("*", $resultado[0]['resul']);

    $_SESSION['mensaje'] = $valor[0];
    header("location:" . $valor[1]);
} else {
    $_SESSION['mensaje'] = "ERROR:" . $sql;
    header("location:marca_index.php");
}
