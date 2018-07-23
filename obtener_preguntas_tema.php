<?php
 /**
 * obtiene las preguntas de un tema 
 */
require 'preguntas.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['tem_id_tema']) ) {
        // Obtener parámetro tem_id_tema
        $parametro = $_GET['tem_id_tema'];
        // Tratar retorno
        $retorno = preguntas::getById($parametro);
        if ($retorno) {
            $pregunta = $retorno;
            // Enviar objeto json del alumno
            print json_encode($pregunta);
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

