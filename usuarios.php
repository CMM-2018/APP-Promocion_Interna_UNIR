<?php
/**
 * Representa el la estructura de los usuarios y calificaciones
 * almacenadas en la base de datos
 */
require 'Database.php';
class usuarios
{
    function __construct()
    {
    }
    /**
     * Busca todos los registros de la tabla usuarios
     */
    public static function getAll()
    {
        $consulta = "SELECT * FROM usuarios";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            return $comando->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
    /**
     * Busca un usuario determinado en la tabla usuarios por "usu_id"
     */
    public static function getById($usu_id)
    {
        // Consulta de la tabla usuarios
        $consulta = "SELECT usu_id,
                            usu_nombre,
                            usu_apellidos,
                            usu_nick,
                            usu_email,
                            usu_pwd,
                            usu_fechaalta,
                            usu_estado
                            FROM usuarios
                            WHERE usu_id = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usu_id));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
           } catch (PDOException $e) {
            return -1;
        }
    }
    /**
     * Busca un usuario determinado en la tabla usuarios por "usu_email" y "usu_pwd"
     */
    public static function getByEmail($usu_email, $usu_pwd)
    {
        // Consulta de la tabla usuarios
        $consulta = "SELECT usu_id,
                            usu_nombre,
                            usu_apellidos,
                            usu_nick,
                            usu_email,
                            usu_pwd,
                            usu_fechaalta,
                            usu_estado
                            FROM usuarios
                            WHERE usu_email = ? and usu_pwd = ?";
        try {
            // Preparar sentencia
            
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usu_email, $usu_pwd));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
           } catch (PDOException $e) {
            return -1;
        }
    }
	/**
     * Busca un usuario determinado en la tabla usuarios por "usu_email"
     */
        public static function getByEmail_solo($usu_email)
    {
        // Consulta de la tabla usuarios
        $consulta = "SELECT usu_id,
                            usu_nombre,
                            usu_apellidos,
                            usu_nick,
                            usu_email,
                            usu_pwd,
                            usu_fechaalta,
                            usu_estado
                            FROM usuarios
                            WHERE usu_email = ?";
        try {
            // Preparar sentencia
            
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($usu_email));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
           } catch (PDOException $e) {
            return -1;
        }
    }
  /**
     * Actualiza la tabla de usuarios
     */
    public static function update(
        $usu_id,
        $usu_nombre,
        $usu_apellidos,
        $usu_nick,
        $usu_email,
        $usu_pwd,
        $usu_fechaalta,
        $usu_estado
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE usuarios" .
            " SET usu_nombre=?, usu_apellidos=?, usu_nick=?, usu_email=?, usu_pwd=?, usu_fechaalta=?, usu_estado=? " .
            "WHERE usu_id=?";
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($usu_nombre, $usu_apellidos, $usu_nick, $usu_email, $usu_pwd, $usu_fechaalta, $usu_estado, $usu_id));
        return $cmd;
    }
    
	/**
     * Inserte un usuario en la tabla usuarios
     */
    public static function insert(
        $usu_nombre,
        $usu_apellidos,
        $usu_nick,
        $usu_email,
        $usu_pwd,
        $usu_fechaalta,
        $usu_estado
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO usuarios ( " .
            "usu_nombre, usu_apellidos, usu_nick, usu_email, usu_pwd, usu_fechaalta," .
            " usu_estado)" .
            " VALUES( ?,?,?,?,?,?,?)";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $usu_nombre,
                $usu_apellidos,
                $usu_nick,
                $usu_email,
                $usu_pwd,
                $usu_fechaalta,
                $usu_estado
            )
        );
    }
	
     /**
     * Elimina un usuario determinado en la tabla usuarios por "usu_id"
     */
    public static function delete($usu_id)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM usuarios WHERE usu_id=?";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($usu_id));
    }
	
	/** CALIFICACIONES */
	
	/**
     * Insertar una nueva calificación
     *
     */
    public static function insert_calificacion(
        $cal_usuario,
        $cal_categoria,
        $cal_tema,
        $cal_fecha,
        $cal_nota
    )
    {
        // Sentencia INSERT
        $comando = "INSERT INTO calificaciones ( " .
            "cal_usuario, cal_categoria, cal_tema, cal_fecha, cal_nota)" .
            " VALUES(?,?,?,?,?)";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(
            array(
                $cal_usuario,
                $cal_categoria,
                $cal_tema,
                $cal_fecha,
                $cal_nota
            )
        );
    }
	
     /**
     * Busca calificaciones para un usuario "usu_id" de un tema "cal_tema"
     */ 
    public static function getByUsuarioTema($cal_usuario, $cal_tema)
    {
        // Consulta de la tabla calificaciones
        $consulta = "SELECT cal_id,
                            cal_usuario,
                            cal_categoria,
                            cal_tema,
                            cal_fecha,
                            cal_nota
                            FROM calificaciones
                            WHERE cal_usuario = ? and cal_tema = ?";
        try {
            // Preparar sentencia
            
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($cal_usuario, $cal_tema));
            // Capturar todos los resultados
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;
           } catch (PDOException $e) {
            return -1;
        }
    }
	
	/**
     * Busca todas las calificaciones obtenidas en un  tema "cal_tema"
     */
    public static function getByTema($cal_tema)
    {
        // Consulta de la tabla calificaciones
        $consulta = "SELECT cal_id,
                            cal_usuario,
                            cal_categoria,
                            cal_tema,
                            cal_fecha,
                            cal_nota
                            FROM calificaciones
                            WHERE cal_tema = ?";
        try {
            // Preparar sentencia
            
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($cal_tema));
            // Capturar todos los resultados
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return $row;
           } catch (PDOException $e) {
            return -1;
        }
    }
}
?>

