<?php
namespace Repositories;

use Lib\BaseDatos;
use Models\Paciente;
USE PDO;

class PacienteRepository
{
    private BaseDatos $conexion;

    public function __construct()
    {
        $this->conexion = new BaseDatos();
    }

    // Registra un nuevo paciente en la base de datos
    public function registrar(Paciente $paciente): bool
    {
        $sql = "INSERT INTO pacientes (nombre, apellido, fecha_nacimiento, email, password) 
                VALUES (:nombre, :apellido, :fecha_nacimiento, :email, :password)";
        return $this->conexion->execute($sql, [
            ':nombre' => $paciente->getNombre(),
            ':apellido' => $paciente->getApellido(),
            ':fecha_nacimiento' => $paciente->getFechaNacimiento(),
            ':email' => $paciente->getEmail(),
            ':password' => password_hash($paciente->getPassword(), PASSWORD_DEFAULT)
        ]);
    }

    // Realiza el login de un paciente verificando el email y la contraseña
    public function login(string $email, string $password): ?Paciente
    {
        $sql = "SELECT * FROM pacientes WHERE email = :email";
        $result = $this->conexion->fetchAll($sql, [':email' => $email]);

        if (count($result) > 0) {
            $paciente = $result[0];

            if (password_verify($password, $paciente['password'])) {
                return new Paciente($paciente['nombre'], $paciente['apellido'], $paciente['fecha_nacimiento'], $paciente['email'], $paciente['password'], $paciente['id']);
            }
        }

        return null;
    }

    // Obtiene el correo del paciente por su ID
    public function obtenerCorreo(int $id)
    {
        $sql = "SELECT id, nombre, apellido, fecha_nacimiento, email, password FROM pacientes WHERE id = :id";
        $result = $this->conexion->fetchOne($sql, [":id" => $id]);

        if ($result) {
            $paciente = new Paciente(
                $result['nombre'],
                $result['apellido'],
                $result['fecha_nacimiento'],
                $result['email'],
                $result['password'],
                $result['id']
            );
            return $paciente->getEmail();  
        }
        return null;
    }

    // Obtiene todos los pacientes de la base de datos
    public function getAllPacientes(): array
    {
        $query = $this->conexion->query("SELECT * FROM pacientes");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $pacientes = [];
        foreach ($result as $row) {
            $pacientes[] = new Paciente(
                $row['nombre'],
                $row['apellido'],
                $row['fecha_nacimiento'],
                $row['email'],
                $row['password'],
                (int)$row['id']
            );
        }

        return $pacientes;
    }

    // Actualiza los datos de un paciente
    public function editar(int $id, string $nombre, string $apellido, string $fecha_nacimiento, string $email): bool
    {
        $sql = "UPDATE pacientes SET nombre = :nombre, apellido = :apellido, fecha_nacimiento = :fecha_nacimiento, email = :email WHERE id = :id";
        return $this->conexion->execute($sql, [
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':fecha_nacimiento' => $fecha_nacimiento,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    // Verifica si el paciente tiene citas registradas
    public function tieneCitas(int $id): bool
    {
        $sql = "SELECT COUNT(*) AS total FROM citas WHERE paciente_id = :id";
        $result = $this->conexion->fetchOne($sql, [':id' => $id]);

        return $result && $result['total'] > 0;
    }

    // Elimina un paciente si no tiene citas asociadas
    public function borrar(int $id): bool
    {
        if ($this->tieneCitas($id)) {
            return false; 
        }

        $sql = "DELETE FROM pacientes WHERE id = :id";
        return $this->conexion->execute($sql, [':id' => $id]);
    }

    // Obtiene un paciente por su ID
    public function obtenerPorId(int $id): ?Paciente
    {
        $sql = "SELECT * FROM pacientes WHERE id = :id";
        $result = $this->conexion->fetchOne($sql, [':id' => $id]);

        if ($result) {
            return new Paciente(
                $result['nombre'],
                $result['apellido'],
                $result['fecha_nacimiento'],
                $result['email'],
                $result['password'],
                $result['id']
            );
        }

        return null;
    }
}
