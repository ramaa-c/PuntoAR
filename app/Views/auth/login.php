<?= view('layout/header', ['titulo' => 'Iniciar Sesión - PuntoAR', 'estilos' => ['login.css']]) ?>
<?= view('layout/navbar') ?>
<div class="main_login">
    <div class="login_container">
        <h1 class="login_titulo">Iniciar Sesión</h1>
        
        <?php if (session()->getFlashdata('success')): ?>
            <p class="success-message"><?= session()->getFlashdata('success') ?></p>
        <?php endif; ?>
        
        <?php if (isset($errors)): ?>
            <div style="color:#e74c3c; margin-bottom:20px;">
                <?php foreach ($errors as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form action="<?= site_url('/login') ?>" method="post">
            <div class="form-group">
                <label class="label_login">Email</label>
                <input class="input_login" type="email" name="email" value="<?= old('email') ?>" required>
                <?php if (session('errors.email')): ?>
                    <small class="error-message"><?= esc(session('errors.email')) ?></small>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label class="label_login">Contraseña</label>
                <input class="input_login" type="password" name="clave" required>
                <?php if (session('errors.clave')): ?>
                    <small class="error-message"><?= esc(session('errors.clave')) ?></small>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="submit-btn"><b>Ingresar</b></button>
        </form>
        <br>
        <div class="link_registro">
            <p>¿No tienes una cuenta? <a href="<?= site_url('/registro') ?>"> Registrarse</a></p>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
