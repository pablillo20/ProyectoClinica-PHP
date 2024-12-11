<?php

namespace Repositories;

use Models\Medico;
use Lib\BaseDatos;

class MedicoRepository {

    private BaseDatos $conexion;  

    public function __construct() {
        $this->conexion = new BaseDatos();  
    }

    public function registrar(Medico $medico): bool
    {
        // Sentencia SQL para insertar un nuevo médico
        $sql = "INSERT INTO medicos (nombre, especialidad_id) 
                VALUES (:nombre, :especialidad_id)";
        // Ejecutar la consulta con los datos del médico
        return $this->conexion->execute($sql, [
            ':nombre' => $medico->getNombre(), 
            ':especialidad_id' => $medico->getEspecialidad(),  
        ]);
    }

    // Método para obtener todos los médicos activos
    public function obtenerMedicos(): array {
        // Consulta SQL para obtener médicos y su especialidad
        $sql = "SELECT m.id, m.nombre, e.nombre AS especialidad
                FROM medicos m
                LEFT JOIN especialidades e ON m.especialidad_id = e.id
                WHERE m.activo = 1";
    
        $resultados = $this->conexion->fetchAll($sql);
    
        $medicos = []; 
        if ($resultados) {
            // Si se obtuvieron resultados, crear un objeto Medico para cada uno
            foreach ($resultados as $fila) {
                $medicos[] = new Medico($fila['nombre'], $fila['especialidad'], $fila['id']);
            }
        }
        return $medicos;  
    }

    // Método para editar un médico existente
    public function editar(int $id, string $nombre, int $id_especialidad): bool {
        // Sentencia SQL para actualizar los datos de un médico
        $sql = "UPDATE medicos SET nombre = :nombre, especialidad_id = :id_especialidad WHERE id = :id";
        // Ejecutar la consulta con los datos del médico
        return $this->conexion->execute($sql, [
            ':nombre' => $nombre,  
            ':id_especialidad' => $id_especialidad, 
            ':id' => $id,  
        ]);
    }

    // Método para verificar si un médico tiene citas asignadas
    public function tieneCitas(int $id): bool {
        // Sentencia SQL para contar las citas asignadas a un médico
        $sql = "SELECT COUNT(*) AS total FROM citas WHERE medico_id = :id";
        // Ejecutar la consulta y obtener el resultado
        $result = $this->conexion->fetchOne($sql, [':id' => $id]);
    
        // Si tiene citas, devolver true, de lo contrario false
        return $result && $result['total'] > 0;
    }

    // Método para borrar un médico
    public function borrar(int $id): bool {
        // Verificar si el médico tiene citas asignadas
        if ($this->tieneCitas($id)) {
            return false;  // Si tiene citas, no se puede borrar
        }
    
        // Sentencia SQL para eliminar el médico
        $sql = "DELETE FROM medicos WHERE id = :id";
        // Ejecutar la consulta para eliminar el médico
        return $this->conexion->execute($sql, [':id' => $id]);
    }

    // Método para obtener un médico por su ID
    public function obtenerPorId(int $id): ?Medico {
        // Sentencia SQL para obtener los datos de un médico por su ID
        $sql = "SELECT * FROM medicos WHERE id = :id";
        // Ejecutar la consulta y obtener el resultado
        $result = $this->conexion->fetchOne($sql, [':id' => $id]);
    
        // Si se encuentra el médico, devolver un objeto Medico
        if ($result) {
            return new Medico(
                $result['id'],
                $result['nombre'],
                $result['especialidad_id']
            );
        }
    
        // Si no se encuentra el médico, devolver null
        return null;
    }
}
