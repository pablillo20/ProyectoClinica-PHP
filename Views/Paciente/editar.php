<?php if(isset($errores) && $errores != ''): ?>
    <div class="error">
        <?php foreach ($errores as $error): ?>
            <p><?= htmlspecialchars($error)?></p>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

<h1 class="page-title">Editar Paciente</h1>
<form action="<?=BASE_URL?>paciente/editar" method="POST" class="form-edit">
    <input type="hidden" name="id" value="<?= $paciente->getId(); ?>">

    <div class="form-group">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" name="nombre" value="<?= $paciente->getNombre(); ?>" required class="form-input">
    </div>

    <div class="form-group">
        <label for="apellido" class="form-label">Apellido:</label>
        <input type="text" name="apellido" value="<?= $paciente->getApellido(); ?>" required class="form-input">
    </div>

    <div class="form-group">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= $paciente->getFechaNacimiento(); ?>" required class="form-input">
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" value="<?= $paciente->getEmail(); ?>" required class="form-input">
    </div>

    <div class="form-actions">
        <button type="submit" class="form-submit">Guardar Cambios</button>
        <a href="<?=BASE_URL?>paciente/listar" class="form-cancel">Cancelar</a>
    </div>
</form>


<style>
    /* Estilos generales para el título de la página */
.page-title {
    font-family: Arial, sans-serif;
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

/* Estilos para el formulario */
.form-edit {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

/* Estilos para los grupos de formulario */
.form-group {
    margin-bottom: 20px;
}

/* Estilos para las etiquetas del formulario */
.form-label {
    font-size: 14px;
    color: #333;
    margin-bottom: 8px;
    display: block;
}

/* Estilos para los campos de entrada */
.form-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
}

/* Estilos para las acciones del formulario (botones) */
.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

/* Estilos para el botón de envío */
.form-submit {
    padding: 12px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-submit:hover {
    background-color: #45a049;
}

.form-submit:focus {
    outline: none;
}

/* Estilos para el enlace "Cancelar" */
.form-cancel {
    padding: 12px 20px;
    background-color: #f44336;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
    transition: background-color 0.3s ease;
}

.form-cancel:hover {
    background-color: #e53935;
}

.form-cancel:focus {
    outline: none;
}

</style>