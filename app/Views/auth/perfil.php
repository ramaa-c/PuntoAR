<?= view('layout/header', ['titulo' => 'Perfil - PuntoAR', 'estilos' => ['login.css', 'perfil.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>
<div class="main_login">
    <div id="overlay" class="overlay"></div>
    
    <h2>Mi Perfil</h2>

    <div>
        <p><strong>Nombre:</strong> <?= esc($usuario['nombre']) ?></p>
        <p><strong>Email:</strong> <?= esc($usuario['email']) ?></p>
        <p><strong>Teléfono:</strong> 
            <?= !empty($usuario['telefono']) ? esc($usuario['telefono']) : '<em>No registrado</em>' ?>
        </p>

        <div>
            <a href="<?= base_url('/editarPerfil') ?>" class="btn btn-primary">
                Editar datos
            </a>
            <a href="<?= base_url('/logout') ?>" class="btn btn-danger">
                Cerrar sesión
            </a>
        </div>
    </div>
</div>
<?= view('layout/footer') ?>
