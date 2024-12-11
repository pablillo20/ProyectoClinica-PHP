<?php

namespace Services;

use Repositories\SecretarioRepository;
use Models\Secretario;

class SecretarioService {
    private SecretarioRepository $repository;

    // Constructor que inicializa el repositorio de secretario
    public function __construct() {
        $this->repository = new SecretarioRepository();
    }

    // Método para manejar el inicio de sesión del secretario
    public function login(string $email, string $password): ?Secretario {
        $_SESSION['tipo'] = "es_secretario"; 
        return $this->repository->login($email, $password); 
    }
}
