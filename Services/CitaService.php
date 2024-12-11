<?php

namespace Services;

use Repositories\CitaRepository;

class CitaService {

    private CitaRepository $citaRepository;

    public function __construct() {
        $this->citaRepository = new CitaRepository();
    }

    // Verificar si ya existe una cita para un médico en una fecha y hora
    public function verificarCitaExistente(int $medicoId, string $fecha, string $hora, int $paciente_id): bool {
        return $this->citaRepository->verificarCitaExistente($paciente_id, $medicoId, $fecha, $hora);
    }

    // Registrar una nueva cita
    public function registrarCita(int $medicoId, string $fecha, string $hora,int $paciente_id): bool {
        return $this->citaRepository->registrarCita($medicoId, $fecha, $hora, $paciente_id);
    }
}
