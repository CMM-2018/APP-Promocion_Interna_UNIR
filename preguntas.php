<?php
/**
 * Representa el la estructura de las preguntas
 * almacenadas en la base de datos
 */
require 'Database.php';
class preguntas
{
    function __construct()
    {
    }
      
    /**
     * Obtiene 10 preguntas de un tema determinado de forma aleatoria
     */
    public static function getById($tem_id_tema)
    {
        // Consulta de la tabla de preguntas
        $consulta = "SELECT tem_id,
                            tem_id_cat,
                            tem_id_tema,
                            tem_enunciado,
                            tem_opcion_1,
                            tem_opcion_2,
                            tem_opcion_3,
                            tem_opcion_4,
                            tem_opcion_5,
                            tem_respuesta,
                            tem_ayuda
                            FROM preguntas
                            WHERE tem_id_tema = ? ORDER BY RAND() LIMIT 10";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($tem_id_tema));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;
           } catch (PDOException $e) {
         return -1;
        }
    }
}   
?>

