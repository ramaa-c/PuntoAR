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
            <span class="cart-badge" id="cart-count">0</span>
        </button>
        
    </div>
</header>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const contador = document.getElementById('cart-count');

  // función para actualizar el contador leyendo localStorage
  function actualizarContadorCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    const total = carrito.reduce((acc, item) => acc + (item.cantidad || 0), 0);

    if (!contador) return;
    contador.textContent = total > 0 ? total : 0;
    contador.style.display = total > 0 ? 'inline-flex' : 'none';
  }

  // Actualización inicial
  actualizarContadorCarrito();

  // Escuchar evento personalizado que disparamos desde sidebar.js
  document.addEventListener('carritoActualizado', (e) => {
    // si el evento trae detalle con total, lo podemos usar, si no, recalculamos
    const totalFromEvent = e?.detail?.total;
    if (typeof totalFromEvent === 'number') {
      contador.textContent = totalFromEvent > 0 ? totalFromEvent : 0;
      contador.style.display = totalFromEvent > 0 ? 'inline-flex' : 'none';
    } else {
      actualizarContadorCarrito();
    }
  });

  // Por si otras partes llaman directamente a localStorage sin disparar el evento:
  // sincronizar si otra pestaña cambia el localStorage
  window.addEventListener('storage', (e) => {
    if (e.key === 'carrito') actualizarContadorCarrito();
  });
});
</script>

