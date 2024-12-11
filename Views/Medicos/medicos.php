<h1 class="page-title">Lista de Médicos</h1>
<div class="table-container">
    <table class="medicos-table">
        <thead>
            <tr>
                <th class="table-header">ID</th>
                <th class="table-header">Nombre</th>
                <th class="table-header">Especialidad</th>
                <th class="table-header">Acciones</th> <!-- Nueva columna para los botones -->
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($medicos)): ?>
                <?php foreach ($medicos as $medico): ?>
                    <tr class="table-row">
                        <td class="table-data"><?= htmlspecialchars($medico->getId(), ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="table-data"><?= htmlspecialchars($medico->getNombre(), ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="table-data"><?= htmlspecialchars($medico->getEspecialidad(), ENT_QUOTES, 'UTF-8') ?></td>
                        <td class="table-data">
                            <a href="<?=BASE_URL?>Medico/editar&id=<?= $medico->getId(); ?>" class="edit-link">Editar</a>
                            <form action="<?=BASE_URL?>Medico/borrar" method="POST" class="delete-form" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $medico->getId(); ?>">
                                <button type="submit" class="delete-button" onclick="return confirm('¿Estás seguro de eliminar este medico?');">Borrar</button>
                            </form>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="table-row">
                    <td class="table-data" colspan="4">No hay médicos registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

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

    /* Estilos para la tabla */
    .medicos-table {
        width: 100%;
        border-collapse: collapse;
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

    /* Estilo para los botones de editar y borrar */
    .edit-btn,
    .delete-btn {
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .edit-btn {
        background-color: #4CAF50;
        color: white;
        margin-right: 10px;
    }

    .edit-btn:hover {
        background-color: #45a049;
    }

    .delete-btn {
        background-color: #f44336;
        color: white;
        border: none;
        cursor: pointer;
    }

    .delete-btn:hover {
        background-color: #e53935;
    }

    .delete-btn:focus {
        outline: none;
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

    /* Mensaje de "No hay médicos registrados" */
    .table-data[colspan="4"] {
        text-align: center;
        font-style: italic;
        color: #777;
        padding: 20px;
    }
</style>