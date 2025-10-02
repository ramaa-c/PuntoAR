<?php
$session = session();
$isLoggedIn = $session->get('logged_in');
$userEmail = $session->get('email');
?>

<header class="navbar">
    <div class="navbar_center">
        <a href="<?= base_url('/')?>">
            <img src="<?= base_url('public/images/logoar.png')?>" alt="PuntoAR" class="logo">
        </a>
    </div>
    <div class="navbar_right">

        <?php if ($isLoggedIn): ?>
            
            <a href="<?= base_url('/perfil') ?>" class="btn_login" aria-label="Ver Perfil">
                <i class="fa-solid fa-circle-user"></i>
            </a>

        <?php else: ?>
            <a href="<?= base_url('/login') ?>" class="btn_login" aria-label="Iniciar Sesión">
                <i class="fa-solid fa-circle-user"></i>
            </a>
        <?php endif; ?>

        <button id="btn_carrito" type="button" class="btn_carrito" aria-label="Abrir carrito">
            <i class="fa-solid fa-cart-shopping"></i>
        </button>
        
    </div>
</header>
