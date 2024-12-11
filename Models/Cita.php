<?php

namespace Models;

use DateTime;

class Cita
{
    private int $id;
    private int $paciente_id;
    private int $medico_id;
    private string $fecha;
    private string $hora;

    public function __construct(int $paciente_id = 0, int $medico_id = 0, string $fecha = '', string $hora = '', int $id = 0)
    {
        $this->id = $id;
        $this->paciente_id = $paciente_id;
        $this->medico_id = $medico_id;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }



    public function getId(): int
    {
        return $this->id;
    }

    public function getPacienteId(): int
    {
        return $this->paciente_id;
    }

    public function getMedicoId(): int
    {
        return $this->medico_id;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function getHora(): string
    {
        return $this->hora;
    }

    public function validarDatos(int $medicoId, string $fecha, string $hora)
    {
        // Validar que la fecha sea a partir de hoy
        $fechaHoy = new DateTime(); // Fecha actual
        $fechaIngresada = DateTime::createFromFormat('Y-m-d', $fecha); // Crear un objeto DateTime de la fecha ingresada
        $errores = [];

        if (!$fechaIngresada || $fechaIngresada < $fechaHoy->setTime(0, 0)) {
            $errores[] = "La fecha debe ser igual o mayor a la fecha actual.";
        }

        // Validar que la hora esté entre las 10:00 y las 18:00
        $horaInicio = DateTime::createFromFormat('H:i', '10:00'); // Hora mínima
        $horaFin = DateTime::createFromFormat('H:i', '18:00'); // Hora máxima
        $horaIngresada = DateTime::createFromFormat('H:i', $hora); // Crear un objeto DateTime de la hora ingresada

        if (!$horaIngresada || $horaIngresada < $horaInicio || $horaIngresada > $horaFin) {
            $errores[] = "La hora debe estar entre las 10:00 y las 18:00.";
        }

        // Validar que la hora no sea inferior a la hora actual si es el mismo día
        if ($fechaIngresada->format('Y-m-d') === $fechaHoy->format('Y-m-d')) {
            $horaActual = new DateTime(); // Hora actual
            if ($horaIngresada < $horaActual) {
                $errores[] = "La hora debe ser posterior a la hora actual.";
            }
        }

        return $errores;
    }
}
