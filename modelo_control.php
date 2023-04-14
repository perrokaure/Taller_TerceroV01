<?php

require 'clases/conexion.php';


$sql = "select sp_modelo(" . $_REQUEST['accion'] . "," . $_REQUEST['vmod_cod'] . ",'" . $_REQUEST['vmod_descri'] . "') as resul";
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
    header("location:modelo_index.php");
}
