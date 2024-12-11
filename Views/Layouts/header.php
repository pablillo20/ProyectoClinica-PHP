<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Médica</title>
    <link rel="stylesheet" href="<?=BASE_URL?>Css/style.css">
</head>

<body>

    <header>
        <nav class="navbar">
            <ul class="navbar-list">
                <?php if (isset($_SESSION['usuario_id'])) { ?>
                    <!-- Acciones que se pueden realizar si tienes sesión iniciada -->

                    <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == "es_secretario") { ?>
                        <!-- Acciones que sólo se pueden realizar si eres secretario -->
                        <li class="navbar-item">
                            <a href="<?=BASE_URL?>paciente/registrar"class="navbar-link">
                                Registrar Paciente
                            </a>
                        </li>

                        <li class="navbar-item">
                            <a href="<?=BASE_URL?>medico/registrar" class="navbar-link">
                                Registrar Medico
                            </a>
                        </li>

                        <li class="navbar-item">
                            <a href="<?=BASE_URL?>medico/mostrarMedicos" class="navbar-link">
                                Mostrar Médicos
                            </a>
                        </li>

                        <li class="navbar-item">
                            <a href="<?=BASE_URL?>paciente/listar" class="navbar-link">
                                Mostrar Pacientes
                            </a>
                        </li>
                    <?php } ?>

                    <li class="navbar-item">
                        <a href="<?=BASE_URL?>cita/reserva" class="navbar-link">
                            Pide tu cita
                        </a>
                    </li>


                    <li class="navbar-item">
                        <a href="<?=BASE_URL?>auth/logout" class="navbar-link">
                            Cerrar sesión
                        </a>
                    </li>
                <?php } else { ?>
                    <!-- Acciones que se pueden realizar cuando no tienes sesión iniciada -->
                    <li class="navbar-item">
                        <a href="<?=BASE_URL?>Dashboard/index" class="navbar-link">
                            Iniciar sesión
                        </a>
                    </li>
                    <li class="navbar-item">
                        <a href="<?=BASE_URL?>paciente/registrar" class="navbar-link">
                            Registrarse
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </header>