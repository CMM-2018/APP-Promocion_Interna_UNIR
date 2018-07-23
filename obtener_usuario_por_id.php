<?php
/**
 * Consulta por "idalumno" y recupera los datos de la BD
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['usu_id'])) {
        // Obtener parámetro usu_id
        $parametro = $_GET['usu_id'];
        // Tratar retorno
        $retorno = usuarios::getById($parametro);
        if ($retorno) {
            $usuario = $retorno;
            print json_encode($usuario);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }
    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}

