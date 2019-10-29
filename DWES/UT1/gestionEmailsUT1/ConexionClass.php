<?php

/**
 * Description of Mysql
 *
 * @author bryan
 */
class ConexionClass {

    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = null;
    private $dbname = "gestionemails";
    private $conn = null;
    private static $conexionClass = null;

    private function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    public static function getConexion() {
        if (self::$conexionClass == null) {
            self::$conexionClass = new ConexionClass();
        } 
        return self::$conexionClass;
    }
    
    public function getTerminal(){
        return $this->conn;
    }

}
