<?php

require 'clases/conexion.php';

session_start();

$sql = "select sp_sucursal("
    . $_REQUEST['accion'] . ","
    . $_REQUEST['vsuc_cod'] . ",'"
    . $_REQUEST['vsuc_descri'] . "') as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != null) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:sucursal_index.php");
} else {
    $_SESSION['mensaje'] = "Error:" . $sql;
    header("location:sucursal_index.php");
}
