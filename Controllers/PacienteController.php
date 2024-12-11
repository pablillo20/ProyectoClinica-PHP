<?php

namespace Controllers;

use Services\PacienteService;
use Lib\Pages;
use Models\Paciente;

class PacienteController
{
    private PacienteService $pacienteService;
    private Pages $pages;
    private Paciente $paciente;

    public function __construct()
    {
        $this->pacienteService = new PacienteService();
        $this->pages = new Pages();
        $this->paciente = new Paciente();
    }

    // Método para registrar un paciente
    public function registrar()
    {
        // Si la solicitud es POST (se envió un formulario)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $email = $_POST['email'];
            $password = $_POST['password'];


            // Validacion
            $errores = $this->paciente->validarDatos($nombre, $apellido,  $fecha_nacimiento, $email, $password);
            if (!$errores) {

                // Llamar al servicio para registrar el paciente
                if ($this->pacienteService->registrarPaciente($nombre, $apellido, $fecha_nacimiento, $email, $password)) {
                    echo "Registro exitoso.";
                } else {
                    echo "Error en el registro.";
                }
            } else {
                $this->pages->render('Paciente/registrar', ['errores' => $errores]);
            }
        } else {
            // Si no es una solicitud POST, mostrar el formulario de registro
            $this->pages->render('Paciente/registrar');
        }
    }

    // Método para hacer login de un paciente
    public function login()
    {
        // Si la solicitud es POST (se envió un formulario)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Llamar al servicio para verificar las credenciales
            $paciente = $this->pacienteService->login($email, $password);
            if ($paciente) {
                session_start();  // Iniciar la sesión
                $_SESSION['usuario_id'] = $paciente->getId();

                // Establecer cookies para recordar al usuario (por 30 días)
                setcookie('usuario_id', $_SESSION['usuario_id'], time() + 3600 * 24 * 30, '/', '', true, true);  // Secure y HttpOnly
                setcookie('tipo', 'paciente', time() + 3600 * 24 * 30, '/', '', true, true);  // Secure y HttpOnly
                $this->pages->render('Cita/reservar');
                exit();
            } else {
                $_SESSION['mensaje'] = "Email o contraseña incorrectos.";
            }
        } else {
            // Si no es una solicitud POST, mostrar el formulario de login
            $this->pages->render('Paciente/login');
        }
    }

    // Método para hacer logout de un paciente
    public function logout()
    {
        session_start();  // Asegurarse de que la sesión esté iniciada
        // Elimina las cookies al cerrar sesión (establece su tiempo de expiración en el pasado)
        setcookie('usuario_id', '', time() - 3600, '/'); // Eliminar la cookie 'usuario_id'
        setcookie('tipo', '', time() - 3600, '/'); // Eliminar la cookie 'tipo'
        session_unset();  // Eliminar todas las variables de sesión
        session_destroy();  // Destruir la sesión

        $this->pages->render('Paciente/login');


        exit();
    }

    // Método para listar todos los pacientes
    public function listar(): void
    {
        $pacientes = $this->pacienteService->listarPacientes();
        $this->pages->render('Paciente/pacientes', ['pacientes' => $pacientes]);
    }

    // Método para editar los datos de un paciente
    public function editar()
    {
        // Si la solicitud es POST (se envió un formulario)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $id = (int)$_POST['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $email = $_POST['email'];

            // Validacion
            $errores = $this->paciente->validarDatosEdiccion($nombre, $apellido,  $fecha_nacimiento, $email);
            if (!$errores) {

                // Llamar al servicio para editar el paciente
                if ($this->pacienteService->editarPaciente($id, $nombre, $apellido, $fecha_nacimiento, $email)) {
                    $_SESSION['mensaje'] = "Paciente actualizado con éxito.";
                } else {
                    $_SESSION['mensaje'] = "Error al actualizar el paciente.";
                }

                // Redirigir a la lista de pacientes después de la edición
                $this->listar();
                exit();
            } else {
                $this->pages->render('Paciente/editar', ['errores' => $errores]);
            }
        } else {
            $id = (int)$_GET['id'];
            $paciente = $this->pacienteService->obtenerPacientePorId($id);
            if ($paciente) {
                // Mostrar el formulario de edición con los datos del paciente
                $this->pages->render('Paciente/editar', ['paciente' => $paciente]);
            } else {
                $_SESSION['mensaje'] = "Paciente no encontrado.";
                $this->pages->render('paciente/listar');
                exit();
            }
        }
    }

    // Método para eliminar un paciente
    public function borrar()
    {
        // Si la solicitud es POST (se envió un formulario)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)$_POST['id'];

            // Llamar al servicio para eliminar el paciente
            if ($this->pacienteService->borrarPaciente($id)) {
                $_SESSION['mensaje'] = "Paciente eliminado con éxito.";
            }

            // Redirigir a la lista de pacientes después de la eliminación
            $this->listar();
            exit();
        }
    }
}
