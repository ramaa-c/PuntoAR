<?= view('layout/header', ['titulo' => 'Editar Perfil - PuntoAR', 'estilos' => ['login.css', 'sidebar.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>
<div class="main_login">
    <div id="overlay" class="overlay"></div>
<div class="login_container">
    <h1 class="login_titulo">Editar perfil</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p class="success-message"><?= session('success') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/editarPerfil') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label class="label_login" for="nombre">Nombre y apellido</label>
            <input class="input_login" type="text" name="nombre" value="<?= old('nombre') ?? $usuario['nombre'] ?>" required>
            <?php if (session('errors.nombre')): ?>
                <small class="error-message"><?= esc(session('errors.nombre')) ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="label_login" for="email">Email</label>
            <input class="input_login" type="email" name="email" value="<?= old('email') ?? $usuario['email'] ?>" required>
            <?php if (session('errors.email')): ?>
                <small class="error-message"><?= esc(session('errors.email')) ?></small>
            <?php endif; ?>

        </div>
        <div class="form-group">
            <label class="label_login" for="telefono">Teléfono (opcional)</label>
            <input class="input_login" type="text" name="telefono" value="<?= old('telefono') ?? ($usuario['telefono'] ?? '') ?>">
            <?php if (session('errors.telefono')): ?>
                <small class="error-message"><?= esc(session('errors.telefono')) ?></small>
            <?php endif; ?>

        </div>        

        <button type="submit" class="submit-btn"><b>Guardar Cambios</b></button>
    </form>
    <br>
    <div class="link_registro">
        <a href="<?= base_url('/') ?>">¿Quieres cambiar la contraseña?</a>
    </div>
</div>
</div>
<?= view('layout/footer') ?>
