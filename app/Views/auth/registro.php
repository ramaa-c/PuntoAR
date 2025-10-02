<?= view('layout/header', ['titulo' => 'Iniciar Sesión - PuntoAR', 'estilos' => ['login.css']]) ?>
<?= view('layout/navbar') ?>
<div class="main_login">
<div class="login_container">
    <h1 class="login_titulo">Registro de Usuario</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="success-message"><?= session('success') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/registro') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label class="label_login" for="nombre">Nombre y apellido</label>
            <input class="input_login" type="text" name="nombre" value="<?= old('nombre') ?>" required>
            <?php if (session('errors.nombre')): ?>
                <small class="error-message"><?= esc(session('errors.nombre')) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="label_login" for="email">Email</label>
            <input class="input_login" type="email" name="email" value="<?= old('email') ?>" required>
            <?php if (session('errors.email')): ?>
                <small class="error-message"><?= esc(session('errors.email')) ?></small>
            <?php endif; ?>

        </div>
        
        <div class="form-group">
            <label class="label_login" for="telefono">Teléfono (opcional)</label>
            <input class="input_login" type="text" name="telefono" value="<?= old('telefono') ?>">
            <?php if (session('errors.telefono')): ?>
                <small class="error-message"><?= esc(session('errors.telefono')) ?></small>
            <?php endif; ?>

        </div>  

        <div class="form-group">
            <label class="label_login" for="clave">Contraseña</label>
            <input class="input_login" type="password" name="clave" required>
            <?php if (session('errors.clave')): ?>
                <small class="error-message"><?= esc(session('errors.clave')) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="label_login" for="confirmClave">Confirmar contraseña</label>
            <input class="input_login" type="password" name="confirmClave" required>
            <?php if (session('errors.confirmClave')): ?>
                <small class="error-message"><?= esc(session('errors.confirmClave')) ?></small>
            <?php endif; ?>
        </div>

        <button type="submit" class="submit-btn"><b>Registrarse</b></button>
    </form>
    <br>
    <div class="link_registro">
        <p>¿Ya tenés cuenta? <a href="<?= base_url('/login') ?>">Iniciar sesión</a></p>
    </div>
</div>
</div>
<?= view('layout/footer') ?>
