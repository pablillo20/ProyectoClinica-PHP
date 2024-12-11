<?php
namespace Lib;

use PDO;
use PDOException;

class BaseDatos {
    private PDO $conexion;

    public function __construct(
        private $tipo_de_base = 'mysql',
        private string $servidor = SERVERNAME,
        private string $usuario = USERNAME,
        private string $pass = PASSWORD,
        private string $base_datos = DATABASE
    ) {
        $this->conexion = $this->conectar();
    }

    private function conectar(): PDO {
        try {
            $opciones = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::MYSQL_ATTR_FOUND_ROWS => true
            );

            $conexion = new PDO("mysql:host={$this->servidor};dbname={$this->base_datos}", $this->usuario, $this->pass, $opciones);
            return $conexion;
        } catch (PDOException $e) {
            echo "Ha surgido un error y no se puede conectar a la base de datos. Detalle: " . $e->getMessage();
            exit;
        }
    }

    // Método para ejecutar consultas con parámetros (INSERT, UPDATE, DELETE)
    public function prepare($sql) {
        return $this->conexion->prepare($sql);
    }

    // Método para ejecutar consultas sin parámetros (SELECT)
    public function query($sql) {
        return $this->conexion->query($sql);
    }

    // Método para realizar una consulta con parámetros y devolver los resultados
    public function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retorna todos los resultados de la consulta
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return [];
        }
    }
    

    // Método para ejecutar una consulta de actualización (INSERT, UPDATE, DELETE)
    public function execute($sql, $params = []) {
        $stmt = $this->prepare($sql);
        return $stmt->execute($params);  // Retorna true si la ejecución fue exitosa
    }

    public function fetchOne(string $sql, array $params = []): ?array
    {
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
}
