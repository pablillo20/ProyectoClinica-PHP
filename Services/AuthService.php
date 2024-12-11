<?php

namespace Services;

use Models\Secretario;

class AuthService {
    private SecretarioService $secretarioService;
    private PacienteService $pacienteService;

    // Constructor que inicializa los servicios de secretario y paciente
    function __construct() {
        $this->pacienteService = new PacienteService();
        $this->secretarioService = new SecretarioService();
    }

    // Método para realizar el login
    public function login(string $email, string $password): bool {
        session_start();
        // Verifica si el usuario es un secretario
        $esSecretario = $this->secretarioService->login($email, $password);

        if ($esSecretario) {
            // Si es secretario, guarda su ID en la sesión y retorna true
            $_SESSION['usuario_id'] = $esSecretario->getId();
            return true;
        }

        // Si no es secretario, verifica si es un paciente
        $esPaciente = $this->pacienteService->login($email, $password);

        if ($esPaciente) {
            // Si es paciente, guarda su ID en la sesión y retorna true
            $_SESSION['usuario_id'] = $esPaciente->getId();
            return true;
        }

        // Si no se encuentra ningún usuario con las credenciales proporcionadas, retorna false
        return false;
    }    
}
?>
