<?php
namespace Services;

use Repositories\PacienteRepository;
use Models\Paciente;

class PacienteService {
    private PacienteRepository $pacienteRepo;

    // Constructor que inicializa el repositorio de pacientes
    public function __construct() {
        $this->pacienteRepo = new PacienteRepository();
    }

    // Método para registrar un paciente
    public function registrarPaciente(string $nombre, string $apellido, string $fecha_nacimiento, string $email, string $password): bool {
        $paciente = new Paciente($nombre, $apellido, $fecha_nacimiento, $email, $password); 
        return $this->pacienteRepo->registrar($paciente); 
    }

    // Método para iniciar sesión de un paciente
    public function login(string $email, string $password): ?Paciente {
        $_SESSION['tipo'] = "es_paciente";
        return $this->pacienteRepo->login($email, $password);
    }

    // Método para obtener el correo electrónico de un paciente por su ID
    public function obtenerCorreo(int $id): ?string {
        return $this->pacienteRepo->obtenerCorreo($id);
    }

    // Método para listar todos los pacientes
    public function listarPacientes(): array {
        return $this->pacienteRepo->getAllPacientes(); // Obtener la lista de pacientes del repositorio
    }

    // Método para editar un paciente
    public function editarPaciente(int $id, string $nombre, string $apellido, string $fecha_nacimiento, string $email): bool {
        return $this->pacienteRepo->editar($id, $nombre, $apellido, $fecha_nacimiento, $email); 
    }

    // Método para borrar un paciente
    public function borrarPaciente(int $id): bool {
        if ($this->pacienteRepo->tieneCitas($id)) { 
            $_SESSION['mensaje'] = "No se puede eliminar el paciente porque tiene citas asociadas."; 
            return false;
        }
        return $this->pacienteRepo->borrar($id); 
    }

    // Método para obtener un paciente por su ID
    public function obtenerPacientePorId(int $id): ?Paciente {
        return $this->pacienteRepo->obtenerPorId($id); 
    }
}
?>
