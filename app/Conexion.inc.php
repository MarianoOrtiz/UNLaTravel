<?php

class Conexion {

    private static $conexion;

    public static function abrir_conexion() {
        if (!isset(self::$conexion)) {
            try {
                $nombre_servidor = 'localhost';
                $nombre_usuario = 'root';
                $password = '';
                $nombre_db = 'unlatravel';

                self::$conexion = new PDO("mysql:host=$nombre_servidor; dbname=$nombre_db", $nombre_usuario, $password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET CHARACTER SET utf8");
            } catch (PDOException $ex) {
                print "ERROR: " . $ex->getMessage() . "<br>";
                die();
            }
        }
    }

    public static function cerrar_conexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
        }
    }

    public static function getConexion() {
        return self::$conexion;
    }

}
