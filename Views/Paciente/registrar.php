<?php if(isset($errores) && $errores != ''): ?>
    <div class="error">
        <?php foreach ($errores as $error): ?>
            <p><?= htmlspecialchars($error)?></p>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

<form action="<?=BASE_URL?>paciente/registrar" method="POST" class="form-register">
    <h1 class="page-title">Registrar Paciente</h1>
    
    <div class="form-group">
        <label for="nombre" class="form-label">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required class="form-input">
    </div>

    <div class="form-group">
        <label for="apellido" class="form-label">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required class="form-input">
    </div>

    <div class="form-group">
        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required class="form-input">
    </div>

    <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" required class="form-input">
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" name="password" required class="form-input">
    </div>

    <div class="form-actions">
        <input type="submit" value="Registrar" class="form-submit">
    </div>
</form>

<style>
    /* Estilos generales para el formulario */
.form-register {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.page-title {
    text-align: center;
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    font-family: 'Arial', sans-serif;
}

/* Estilos para cada grupo de formulario */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-size: 14px;
    color: #555;
    display: block;
    margin-bottom: 8px;
    font-family: 'Arial', sans-serif;
}

/* Estilos para los campos de entrada */
.form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    color: #333;
    box-sizing: border-box;
}

.form-input:focus {
    border-color: #4CAF50;
    outline: none;
}

/* Estilos para el botón de envío */
.form-submit {
    width: 100%;
    padding: 12px;
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

/* Añadir márgenes y ajuste de posición de la acción de enviar */
.form-actions {
    text-align: center;
}


</style>