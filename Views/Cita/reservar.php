
<?php if(isset($citaRealizada) && $citaRealizada != ''): ?>
    <div class="realizada">
            <p><?= htmlspecialchars($citaRealizada)?></p>
    </div>

<?php endif; ?>

<?php if(isset($errores) && $errores != ''): ?>
    <div class="error">
        <?php foreach ($errores as $error): ?>
            <p><?= htmlspecialchars($error)?></p>
        <?php endforeach; ?>
    </div>

<?php endif; ?>


<form action="<?=BASE_URL?>cita/reservarCita" method="POST" class="form-cita">
    <div class="form-group">
        <label for="medico_id" class="form-label">Médico:</label>
        <select id="medico_id" name="medico_id" required class="form-input">
            <option value="">Seleccione un médico</option>
            <?php if (!empty($medicos)): ?>
                <?php foreach ($medicos as $medico): ?>
                    <option value="<?= $medico->getId(); ?>"><?= $medico->getNombre(); ?> - <?= $medico->getEspecialidad(); ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No hay médicos disponibles</option>
            <?php endif; ?>
        </select>
    </div>
    
    <?php if($_SESSION['tipo'] === "es_secretario"):?>
        <div class="form-group">
        <label for="paciente_id" class="form-label">Paciente:</label>
        <select id="paciente_id" name="paciente_id" required class="form-input">
            <option value="">Seleccione un paciente</option>
            <?php if (!empty($pacientes)): ?>
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente->getId(); ?>"><?= $paciente->getNombre(); ?></option>
                <?php endforeach; ?>
            <?php else: ?>
                <option value="">No hay pacientes disponibles</option>
            <?php endif; ?>
        </select>
    </div>
    <?php endif ?>


    <div class="form-group">
        <label for="hora" class="form-label">Hora:</label>
        <input type="time" id="hora" name="hora" required class="form-input">
    </div>

    <div class="form-group">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required class="form-input">
    </div>

    <div class="form-group">
        <input type="submit" value="Reservar Cita" class="form-submit">
    </div>
    
</form>
