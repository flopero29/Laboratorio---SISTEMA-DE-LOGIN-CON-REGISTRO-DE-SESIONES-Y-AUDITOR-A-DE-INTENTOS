<?php
// db.php - Conexión a la base de datos
class Database {
    private $conexion;
    private $debug = true;
    
    public function __construct() {
        $sql_host = "localhost";
        $sql_name = "company_info";
        $sql_user = "root";
        $sql_pass = ""; 
        
        $dsn = "mysql:host=$sql_host;dbname=$sql_name;charset=utf8mb4";
        
        try {
            $this->conexion = new PDO($dsn, $sql_user, $sql_pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ($this->debug) {
                echo "Conexión exitosa a la base de datos<br>";
            }
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit;
        }
    }
    
    public function getConnection() {
        return $this->conexion;
    }
}
?>