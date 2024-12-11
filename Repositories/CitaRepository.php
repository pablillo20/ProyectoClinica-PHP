<?php

namespace Repositories;

use Lib\BaseDatos;

class CitaRepository {

    private BaseDatos $conexion;

    public function __construct() {
        $this->conexion = new BaseDatos();
    }

    public function verificarCitaExistente(int $paciente_id, int $medicoId, string $fecha, string $hora): bool {
        // Consulta SQL para verificar si ya existe una cita para ese médico en esa fecha y hora
        $sql = "SELECT COUNT(*) FROM citas WHERE medico_id = :medico_id AND fecha = :fecha AND hora = :hora AND  paciente_id = :paciente_id";
        $params = [':medico_id' => $medicoId, ':fecha' => $fecha, ':hora' => $hora, ':paciente_id' => $paciente_id];
        
        $resultado = $this->conexion->fetchAll($sql, $params);
    
        return $resultado && $resultado[0]['COUNT(*)'] > 0;
    }
    

    // Registrar una nueva cita en la base de datos
    public function registrarCita(int $medicoId, string $fecha, string $hora, int $paciente_id): bool {
        // Consulta SQL para insertar una nueva cita
        $sql = "INSERT INTO citas (paciente_id, medico_id, fecha, hora) VALUES (:paciente_id, :medico_id, :fecha, :hora)";
        
        // Parámetros para la consulta
        $params = [
            ':paciente_id' => $paciente_id,
            ':medico_id' => $medicoId,
            ':fecha' => $fecha,
            ':hora' => $hora
        ];

        // Ejecutamos la consulta
        return $this->conexion->execute($sql, $params);
    }

    
}
