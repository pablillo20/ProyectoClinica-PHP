<?php if(isset($errores) && $errores != ''): ?>
    <div class="error">
        <?php foreach ($errores as $error): ?>
            <p><?= htmlspecialchars($error)?></p>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<h1 class="page-title">Editar Medicos</h1>
<form action="<?=BASE_URL?>Medico/editar" method="POST" class="form-edit">
    <input type="hidden" name="id" value="<?= $medico->getId(); ?>">

    <div class="form-group">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" name="nombre" value="<?= $medico->getNombre(); ?>" required class="form-input">
    </div>


    <label for="especialidad_id" class="form-label">Médico:</label>
        <select id="medico_id" name="id_especialidad" required class="form-input">
            <option value="">Seleccione una Especialidad</option>
            <option value="1">1- Cardiología</option>
            <option value="2">2- Dermatología</option>
            <option value="3">3- Pediatría</option>
            <option value="4">4- Ginecología/option>
            <option value="5">5- Neurología</option>
            <option value="6">6- Oftalmología</option>
            <option value="7">7- Odontología</option>
        </select>

    <div class="form-actions">
        <button type="submit" class="form-submit">Guardar Cambios</button>
        <a href="<?=BASE_URL?>Medico/mostrarMedicos" class="form-cancel">Cancelar</a>
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