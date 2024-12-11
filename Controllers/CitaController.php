<?php

namespace Controllers;

use Services\MedicoService;
use Services\CitaService;
use Services\PacienteService;
use Lib\Pages;
use Controllers\ErrorController;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Models\Cita;

class CitaController
{
    // Definición de servicios y clases utilizadas
    private MedicoService $medicoService;
    private PacienteService $pacienteService;
    private CitaService $citaService;
    private Pages $pages;
    private Cita $cita;

    public function __construct()
    {
        // Inicialización de los servicios y la clase Pages
        $this->medicoService = new MedicoService();
        $this->pacienteService = new PacienteService();
        $this->citaService = new CitaService();
        $this->pages = new Pages();
        $this->cita = new Cita();
    }

    // Muestra el formulario para reservar una cita
    public function reserva($errores = '', $citaCompletada = '')
    {
        // Obtiene los médicos y pacientes para mostrarlos en el formulario
        $medicos = $this->medicoService->obtenerMedicos();
        $pacientes = $this->pacienteService->listarPacientes();

        // Muestra la vista de reservar cita con la lista de médicos, pacientes y errores (si existen)
        $this->pages->render('Cita/reservar', ['medicos' => $medicos, 'pacientes' => $pacientes, 'errores' => $errores, 'citaRealizada' => $citaCompletada]);
    }

    // Procesa la solicitud para reservar una cita
    public function reservarCita()
    {
        session_start();
        // Verifica si se han enviado los datos necesarios del formulario
        if (isset($_POST['medico_id'], $_POST['fecha'], $_POST['hora'])) {
            $medicoId = $_POST['medico_id'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];

            // Valida los datos de la cita
            $errores = $this->cita->validarDatos($medicoId, $fecha, $hora);
            if (!$errores) {
                // Verifica el paciente dependiendo de su rol
                if ($_SESSION['tipo'] === "es_secretario") {
                    $idPaciente = $_POST["paciente_id"];
                } else {
                    $idPaciente = $_SESSION['usuario_id'];
                }

                // Verifica si ya existe una cita para ese médico, fecha y hora
                $citaExistente = $this->citaService->verificarCitaExistente($medicoId, $fecha, $hora, $idPaciente);

                if ($citaExistente) {
                    // Si ya existe la cita, muestra un mensaje de error
                    ErrorController::show_error("Ya existe una cita para ese médico a esa hora.");
                } else {
                    // Si la cita no existe, la registra
                    $citaRegistrada = $this->citaService->registrarCita($medicoId, $fecha, $hora, $idPaciente);

                    if ($citaRegistrada) {
                        // Si la cita fue registrada, se envía un correo de confirmación
                        $asunto = "Cita Clinica";
                        $mensaje = "Cita con el medico " . $medicoId . " el dia " . $fecha . " a las " . $hora;

                        // Obtiene el correo del paciente
                        $correo = $this->pacienteService->obtenerCorreo($idPaciente);

                        // Envia el correo con los detalles de la cita
                        $this->enviarCorreo($correo, $asunto, $mensaje);
                        
                    } else {
                        // Si ocurre un error al registrar la cita, muestra un mensaje de error
                        ErrorController::show_error("Error al reservar la cita. Inténtalo nuevamente.");
                    }
                }
            } else {
                // Si hay errores en los datos, vuelve a mostrar el formulario con los errores
                $this->reserva($errores);
            }
        } else {
            // Si faltan datos en el formulario, muestra un mensaje de error
            ErrorController::show_error("Faltan Datos para procesar la cita");
        }
        // Muestra un mensaje de éxito
        $CitaRealizada =("Cita reservada con éxito.");
        // Redirige al formulario de reservas después de procesar la cita
        $this->reserva('', $CitaRealizada);
        exit();
    }

    // Función para enviar un correo de confirmación
    private function enviarCorreo(string $correo, string $asunto, string $mensaje): void
    {
        // Configura el cliente de correo PHPMailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL;
        $mail->Password = PASS;
        $mail->setFrom(EMAIL, 'Clinica');
        $mail->addAddress($correo);
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);

        // Si no se puede enviar el correo, se registra el error
        if (!$mail->send()) {
            error_log('Error al enviar correo: ' . $mail->ErrorInfo);
        }
    }
}
