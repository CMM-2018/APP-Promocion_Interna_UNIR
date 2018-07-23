<?php
/**
 * Obtiene el usuario por "usu_email" y "usu_pwd"
*/
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['usu_email']) &&
            isset ($_GET['usu_pwd'])) {
        // Obtener parámetro usu_email y usu_pwd
        $parametro1 = $_GET['usu_email'];
        $parametro2 = $_GET['usu_pwd'];
        // Tratar retorno
        $retorno = usuarios::getByEmail($parametro1, $parametro2);
        if ($retorno) {
            $usuario = $retorno;
            // Enviar objeto json del alumno
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

