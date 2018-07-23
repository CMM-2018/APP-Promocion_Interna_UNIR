<?php
/**
 * Obtiene las calificaciones de un usuario
 * envían usuario y tema
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['cal_usuario']) &&
            isset ($_GET['cal_tema'])) {
        // Obtener los parámetros que nos pasan
        $parametro1 = $_GET['cal_usuario'];
        $parametro2 = $_GET['cal_tema'];
        // Tratar retorno
        $retorno = usuarios::getByUsuarioTema($parametro1, $parametro2);
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

