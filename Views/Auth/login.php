<form action="<?=BASE_URL?>auth/login" method="POST" class="login-form">
    <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input type="email" id="email" name="email" required class="form-input">
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Contraseña:</label>
        <input type="password" id="password" name="password" required class="form-input">
    </div>

    <div class="form-group">
        <input type="submit" value="Login" class="form-submit">
    </div>
</form>
