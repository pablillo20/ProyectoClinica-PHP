<?php 
    namespace Controllers;

    use Lib\Pages;
    use Services\AuthService;

    class AuthController {

        private Pages $pages;

        function __construct() {
            $this->pages = new Pages();
        }
        // Maneja el inicio de sesión
        public function login(): void {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Verifica si los campos están vacíos
            if (empty($email) || empty($password)) {
                ErrorController::show_error("Debes indicar un email y una contraseña.");
            }
            
            $authService = new AuthService();
            $response = $authService->login($email, $password);
            
            // Si las credenciales son incorrectas
            if (!$response) {
                ErrorController::show_error("No se puede acceder al sistema con las credenciales obtenidas.");
            }

            // Redirige al dashboard
            $this->pages->render("Auth/login");
            exit;
        }

        // Cierra la sesión
        public function logout() {
            session_start();
            session_unset();
            session_destroy();
            $this->pages->render("Auth/login");
            exit();
        }

        // Muestra la página de inicio de sesión
        public function index(): void {
            $pages = new Pages();
            $pages->render('auth/login');
        }
    }
