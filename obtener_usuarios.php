<?php
/**
 * Obtiene todos los usuarios de la base de datos
 */
require 'usuarios.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Petición GET
    $usuarios = usuarios::getAll();
    if ($usuarios) {
        $datos["estado"] = 1;
        $datos["usuarios"] = $usuarios;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
?>
