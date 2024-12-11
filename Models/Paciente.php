<?php

namespace Models;

class Paciente
{
    private int $id;
    private string $nombre;
    private string $apellido;
    private string $fecha_nacimiento;
    private string $email;
    private string $password;

    public function __construct(string $nombre = '', string $apellido = '', string $fecha_nacimiento = '', string $email = '', string $password = '', int $id = 0)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getApellido(): string
    {
        return $this->apellido;
    }

    public function getFechaNacimiento(): string
    {
        return $this->fecha_nacimiento;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function validarDatos($nombre, $apellido, $fecha_nacimiento, $email, $password)
    {
        $errores = [];

        // Validar que el nombre no contiene números
        if (preg_match('/\d/', $nombre)) {
            $errores[] = "El nombre no debe contener números.";
        }

        // Validar que el apellido no contiene números
        if (preg_match('/\d/', $apellido)) {
            $errores[] = "El apellido no debe contener números.";
        }

        // Validar que la fecha de nacimiento no es superior a la fecha actual
        if (strtotime($fecha_nacimiento) > time()) {
            $errores[] = "La fecha de nacimiento no puede ser superior a la fecha actual.";
        }

        // Validar que el email contiene una @
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El email debe ser válido y contener una @.";
        }

        // Validar que el password tiene al menos 8 caracteres, una mayúscula, una minúscula y un número
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $errores[] = "La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula y un número.";
        }

        return $errores;
    }

    public function validarDatosEdiccion($nombre, $apellido,  $fecha_nacimiento, $email)
    {
        $errores = [];

        // Validar que el nombre no contiene números
        if (preg_match('/\d/', $nombre)) {
            $errores[] = "El nombre no debe contener números.";
        }

        // Validar que el apellido no contiene números
        if (preg_match('/\d/', $apellido)) {
            $errores[] = "El apellido no debe contener números.";
        }

        // Validar que la fecha de nacimiento no es superior a la fecha actual
        if (strtotime($fecha_nacimiento) > time()) {
            $errores[] = "La fecha de nacimiento no puede ser superior a la fecha actual.";
        }

        // Validar que el email contiene una @
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El email debe ser válido y contener una @.";
        }
        return $errores;
    }
}
