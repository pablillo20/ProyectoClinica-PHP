<?php

namespace Controllers;

class FrontController
{
    public static function main(): void
    {
        $nombre_controlador = 'Controllers\\' . CONTROLLER_DEFAULT;

        // Si se pasa un parámetro 'controller' en la URL, se actualiza el nombre del controlador
        if (isset($_GET['controller'])) {
            $nombre_controlador = 'Controllers\\' . $_GET['controller'] . 'Controller';
        }

        // Verifica si la clase del controlador existe
        if (! class_exists($nombre_controlador)) {
            // Si no existe la clase, muestra el error 404
            echo ErrorController::show_Error404();
        }

        // Crea una instancia del controlador
        $controlador = new $nombre_controlador();

        // Establece la acción por defecto
        $action = ACTION_DEFAULT;

        // Si se pasa un parámetro 'action' en la URL, se actualiza la acción
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        // Verifica si el método de la acción existe en el controlador
        if (! method_exists($controlador, $action)) {
            // Si no existe el método, muestra el error 404
            echo ErrorController::show_Error404();
        }

        $controlador->$action();
    }
}
