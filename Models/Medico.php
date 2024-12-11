<?php

namespace Models;

class Medico {
    private int $id;
    private string $nombre;
    private string $especialidad;

    public function __construct( string $nombre = '', string $especialidad ='', int $id = 0) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->especialidad = $especialidad;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getEspecialidad(): string {
        return $this->especialidad;
    }

    public function validarDatos(string $nombre, int $especialidad)
{
    $errores = [];

    // Validar que el nombre solo contiene letras, espacios y acentos comunes
    if (!preg_match('/^[\p{L}\s]+$/u', $nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios.";
    }

    // Validar que la especialidad está entre 1 y 7
    if ($especialidad < 1 || $especialidad > 7) {
        $errores[] = "La especialidad debe ser un número entre 1 y 7.";
    }

    return $errores;
}
}
