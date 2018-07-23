<?php
/**
 * Obtiene el usuario por "usu_email"
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['usu_email']) ) {
        // Obtener parámetro usu_email
        $parametro = $_GET['usu_email'];
        
        // Tratar retorno
        $retorno = usuarios::getByEmail_solo($parametro);
        if ($retorno) {
            $usuario = $retorno;
            // Enviar objeto json del usuario
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

