<?php
/**
 * Insertar una nueva calificación en la base de datos
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);
    // Insertar calificación
    $retorno = usuarios::insert_calificacion(
        $body['cal_usuario'],
        $body['cal_categoria'],
        $body['cal_tema'],
        $body['cal_fecha'],
        $body['cal_nota']);
    if ($retorno) {
        $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
    } else {
        $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
    }
}
?>
