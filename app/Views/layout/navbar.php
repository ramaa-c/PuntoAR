<?php
$session = session();
$isLoggedIn = $session->get('logged_in');
$userEmail = $session->get('email');
?>

<header class="navbar">
  <div class="navbar_center">
    <a href="<?= base_url('/') ?>">
      <img src="<?= base_url('public/images/logoar.png') ?>" alt="PuntoAR" class="logo">
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

  <nav class="navbar-bottom">
    <div class="navbar-bottom-wrapper">
      <div class="search-bar-container">
        <input id="navbar-search" type="text" placeholder="¿Qué estás buscando?">
        <button id="navbar-search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>

      <ul>
        <li><a href="<?= base_url('/') ?>">Inicio</a></li>

        <li class="has-submenu">
          <a href="#">Categorías <i class="fa-solid fa-chevron-down"></i></a>
          <ul class="submenu" id="categorias-menu">
            <li><em>Cargando...</em></li>
          </ul>
        </li>

        <li><a href="<?= base_url('/productos') ?>">Ver todo</a></li>
        <li><a href="<?= base_url('/contacto') ?>">Contacto</a></li>
      </ul>
    </div>
  </nav>
</header>
<div id="toast-container"
  style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {

    const contador = document.getElementById('cart-count');
    const actualizarContadorCarrito = () => {
      const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
      const total = carrito.reduce((acc, item) => acc + (item.cantidad || 0), 0);
      contador.textContent = total > 0 ? total : 0;
      contador.style.display = total > 0 ? 'inline-flex' : 'none';
    };

    actualizarContadorCarrito();

    window.addEventListener('storage', e => {
      if (e.key === 'carrito') actualizarContadorCarrito();
    });

    window.addEventListener('carritoActualizado', actualizarContadorCarrito);

    const searchInput = document.getElementById('navbar-search');
    const searchBtn = document.getElementById('navbar-search-btn');
    const categoriasMenu = document.getElementById('categorias-menu');

    function buscarCatalogo() {
      const q = searchInput.value.trim();
      if (q) {
        window.location.href = `<?= base_url('/productos') ?>?q=${encodeURIComponent(q)}`;
      } else {
        window.location.href = `<?= base_url('/productos') ?>`;
      }
    }
    searchBtn.addEventListener('click', buscarCatalogo);
    searchInput.addEventListener('keypress', e => {
      if (e.key === 'Enter') buscarCatalogo();
    });

    document.querySelectorAll('[data-tipo]').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        const tipo = link.dataset.tipo;
        window.location.href = `<?= base_url('/productos') ?>?tipo=${encodeURIComponent(tipo)}`;
      });
    });

    fetch('<?= base_url('/categorias') ?>')
      .then(res => res.json())
      .then(categorias => {
        if (!Array.isArray(categorias) || !categorias.length) {
          categoriasMenu.innerHTML = '<li><em>No hay categorías disponibles</em></li>';
          return;
        }

        categoriasMenu.innerHTML = categorias.map(cat => `
        <li>
          <a href="<?= base_url('/productos') ?>?categorias=${cat.id_categoria}">
            ${cat.nombre}
          </a>
        </li>
      `).join('');
      })
      .catch(err => {
        console.error('Error cargando categorías:', err);
        categoriasMenu.innerHTML = '<li><em>Error al cargar categorías</em></li>';
      });

  });

  function mostrarToast(mensaje) {
    const cont = document.getElementById('toast-container');

    const toast = document.createElement('div');
    toast.textContent = mensaje;
    toast.style.background = '#333';
    toast.style.color = '#fff';
    toast.style.padding = '12px 18px';
    toast.style.marginTop = '8px';
    toast.style.borderRadius = '8px';
    toast.style.fontSize = '14px';
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 0.3s ease';

    cont.appendChild(toast);

    setTimeout(() => (toast.style.opacity = '1'), 50);
    setTimeout(() => {
      toast.style.opacity = '0';
      setTimeout(() => toast.remove(), 300);
    }, 2500);
  }
</script>