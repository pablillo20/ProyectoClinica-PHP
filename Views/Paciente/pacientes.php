<?php if (isset($_SESSION['mensaje'])): ?>
    <div class="mensaje">
        <?= $_SESSION['mensaje']; ?>
        <?php unset($_SESSION['mensaje']); ?>
    </div>
<?php endif; ?>

<h1 class="page-title">Lista de Pacientes</h1>
<table class="pacientes-table">
    <thead>
        <tr>
            <th class="table-header">ID</th>
            <th class="table-header">Nombre</th>
            <th class="table-header">Apellido</th>
            <th class="table-header">Fecha de Nacimiento</th>
            <th class="table-header">Email</th>
            <th class="table-header">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pacientes as $paciente): ?>
            <tr class="table-row">
                <td class="table-data"><?= $paciente->getId(); ?></td>
                <td class="table-data"><?= $paciente->getNombre(); ?></td>
                <td class="table-data"><?= $paciente->getApellido(); ?></td>
                <td class="table-data"><?= $paciente->getFechaNacimiento(); ?></td>
                <td class="table-data"><?= $paciente->getEmail(); ?></td>
                <td class="table-data">
                    <a href="index.php?controller=paciente&action=editar&id=<?= $paciente->getId(); ?>" class="edit-link">Editar</a>
                    <form action="index.php?controller=paciente&action=borrar" method="POST" class="delete-form" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $paciente->getId(); ?>">
                        <button type="submit" class="delete-button" onclick="return confirm('¿Estás seguro de eliminar este paciente?');">Borrar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<style>
    /* Estilos generales para la página */
    .page-title {
        font-family: Arial, sans-serif;
        font-size: 28px;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    /* Contenedor de la tabla para agregar márgenes */
    .table-container {
        width: 80%;
        margin: 0 auto;
        overflow-x: auto;
    }

    /* Estilos para la tabla de pacientes */
    .pacientes-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Estilos para el encabezado de la tabla */
    .table-header {
        background-color: #4CAF50;
        color: white;
        padding: 12px;
        text-align: left;
        font-weight: bold;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    /* Estilos para las filas de la tabla */
    .table-row:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-row:hover {
        background-color: #f1f1f1;
    }

    /* Estilos para las celdas de la tabla */
    .table-data {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
        color: #333;
    }

    /* Estilo para el enlace de "Volver" */
    .back-link {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .back-link:hover {
        background-color: #45a049;
    }

    .back-link:focus {
        outline: none;
    }

    /* Mensaje de "No hay pacientes registrados" */
    .mensaje {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin-bottom: 20px;
        text-align: center;
        border-radius: 4px;
    }

    /* Estilo para la celda de mensaje en la tabla */
    .table-data[colspan="3"] {
        text-align: center;
        font-style: italic;
        color: #777;
        padding: 20px;
    }

</style>
