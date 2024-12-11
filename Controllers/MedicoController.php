<?php

namespace Controllers;

use Services\MedicoService;
use Lib\Pages;
use Models\Medico;

class MedicoController
{

    private MedicoService $medicoService;
    private Pages $pages;
    private Medico $medico;

    public function __construct()
    {
        $this->medicoService = new MedicoService();
        $this->pages = new Pages();
        $this->medico = new Medico();
    }

    // Método para registrar un nuevo médico
    public function registrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $especialidad_id = (int)$_POST['especialidad_id'];

            // Validacion
            $errores = $this->medico->validarDatos($nombre, $especialidad_id);
            if (!$errores) {
                // Intenta registrar al médico usando el servicio
                if ($this->medicoService->registrarMedico($nombre, $especialidad_id)) {
                    echo "Registro exitoso.";
                } else {
                    echo "Error en el registro.";
                }
            } else {
                $this->pages->render('Medicos/registrar', ['errores' => $errores]);
            }
        } else {
            // Si no es una solicitud POST, muestra el formulario de registro
            $this->pages->render('Medicos/registrar');
        }
    }

    // Método para obtener todos los médicos
    public function obtenerMedicos(): array
    {
        return $this->medicoService->obtenerMedicos();
    }

    // Método para mostrar la lista de médicos
    public function mostrarMedicos()
    {
        $medicos = $this->obtenerMedicos();
        $this->pages->render("Medicos/medicos", ['medicos' => $medicos]);
    }

    // Método para editar un médico
    public function editar()
    {
        // Si la solicitud es de tipo POST (envío de formulario)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];
            $nombre = $_POST['nombre'];
            $id_especialidad = $_POST['id_especialidad'];
            // Validacion
            $errores = $this->medico->validarDatos($nombre, $id_especialidad);
            if (!$errores) {

                // Intenta editar el médico usando el servicio
                if ($this->medicoService->editarMedico($id, $nombre, $id_especialidad)) {
                    $_SESSION['mensaje'] = "Paciente actualizado con éxito.";
                } else {
                    $_SESSION['mensaje'] = "Error al actualizar el paciente.";
                }

                // Redirige a la lista de médicos después de la edición
                $this->mostrarMedicos();
                exit();
            }else{
                $this->pages->render('Medicos/editarMedicos', ['errores' => $errores]);
            }
        } else {
            $id = (int)$_GET['id'];
            $medico = $this->medicoService->obtenerMedicoPorID($id);

            // Si el médico existe, muestra el formulario de edición
            if ($medico) {
                $this->pages->render('Medicos/editarMedicos', ['medico' => $medico]);
            } else {
                $this->mostrarMedicos();
                exit();
            }
        }
    }

    // Método para borrar un médico
    public function borrar()
    {
        // Si la solicitud es de tipo POST (envío de formulario)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];

            // Intenta eliminar al médico usando el servicio
            if ($this->medicoService->borrarMedico($id)) {
                $_SESSION['mensaje'] = "Medico eliminado con éxito.";
            }

            // Redirige a la lista de médicos después de la eliminación
            $this->mostrarMedicos();
            exit();
        }
    }
}
