<?php
/**
 * Insertar un nuevo usuario en la base de datos
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodifica formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar usuario
    $retorno = usuarios::insert(
        $body['usu_nombre'],
        $body['usu_apellidos'],
        $body['usu_nick'],
        $body['usu_email'],
        $body['usu_pwd'],
        $body['usu_fechaalta'],
        $body['usu_estado']);
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
		//echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
		//echo $json_string;
    }
}
?>
