<?php
/**
 * Actualiza un usuario especificado por su identificador
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Actualizar alumno
    $retorno = usuarios::update(
        $body['usu_id'],
        $body['usu_nombre'],
        $body['usu_apellidos'],
        $body['usu_nick'],
        $body['usu_email'],
        $body['usu_pwd'],
        $body['usu_fechaalta'],    
        $body['usu_estado']);
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Actualizacion correcta"));
		echo $json_string;
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se actualizo el registro"));
		echo $json_string;
    }
}
?>

