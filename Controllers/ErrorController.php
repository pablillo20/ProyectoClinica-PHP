<?php 
    namespace Controllers;

    class ErrorController{
        public static function show_error(string $mensaje): string{
            print_r("<p>{$mensaje}</p>");
            exit;
        }
        
        public static function show_Error404():string{
            print_r("<p>La página que buscas no existe</p>");
            exit;
        }
    }
?>