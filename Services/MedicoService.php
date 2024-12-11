<?php

namespace Services;

use Models\Medico;
use Repositories\MedicoRepository;

class MedicoService {

    private MedicoRepository $medicoRepository;

    // Constructor que inicializa el repositorio de médicos
    public function __construct() {
        $this->medicoRepository = new MedicoRepository();
    }

    // Método para registrar un médico
    public function registrarMedico(string $nombre, int $especialidad_id): bool {
        $medico = new Medico($nombre, $especialidad_id);  // Crea una instancia de Medico
        return $this->medicoRepository->registrar($medico);  // Llama al repositorio para registrar el médico
    }

    // Método para obtener la lista de médicos con sus especialidades
    public function obtenerMedicos(): array {
        return $this->medicoRepository->obtenerMedicos();  // Llama al repositorio para obtener los médicos
    }

    // Método para editar un médico
    public function editarMedico(int $id, string $nombre, int $id_especialidad): bool {
        return $this->medicoRepository->editar($id, $nombre, $id_especialidad);  // Llama al repositorio para editar el médico
    }

    // Método para borrar un médico
    public function borrarMedico(int $id): bool {
        // Verifica si el médico tiene citas asociadas
        if ($this->medicoRepository->tieneCitas($id)) {
            $_SESSION['mensaje'] = "No se puede eliminar el medico porque tiene citas asociadas.";  // Mensaje de error
            return false;
        }
        return $this->medicoRepository->borrar($id);  // Llama al repositorio para borrar el médico
    }

    // Método para obtener un médico por su ID
    public function obtenerMedicoPorID(int $id): ?Medico {
        return $this->medicoRepository->obtenerPorId($id);  // Llama al repositorio para obtener el médico por ID
    }
}
?>
