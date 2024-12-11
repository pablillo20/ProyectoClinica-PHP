<?php 
    namespace Controllers;

    use Lib\Pages;

    class DashboardController{
        
        private Pages $pages;

        public function __construct() {
            $this->pages = new Pages();
        }
        
        // Método que muestra el dashboard
        public function index(){
            // Renderiza una página de encabezado (header) usando la clase Pages
            $this->pages->render('Auth/login');
        }
    }
?>
