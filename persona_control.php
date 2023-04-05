<?php

require 'clases/conexion.php';

session_start();

$sql = "select sp_persona(" . $_REQUEST['accion'] . ","
    . $_REQUEST['vpers_cod'] . ",'"
    . $_REQUEST['vpers_estado'] . "','"
    . $_REQUEST['vpers_nombres'] . "',"
    . $_REQUEST['vpers_apellidos'] . ","
    . $_REQUEST['vpers_direcc'] . ","
    . $_REQUEST['vpers_tel'] . ","
    . $_REQUEST['vpers_tipodoc'] . ","
    . $_REQUEST['vpers_documento'] . ","
    . $_REQUEST['vpers_tipodoc'] . ","
    . $_REQUEST['vpers_tipo'] . ") as resul";

$resultado = consultas::get_datos($sql);

if ($resultado[0]['resul'] != NULL) {
    $_SESSION['mensaje'] = $resultado[0]['resul'];
    header("location:persona_index.php");
} else {
    $_SESSION['mensaje'] = "ERROR: " . $sql;
    header("location:persona_index.php");
}
