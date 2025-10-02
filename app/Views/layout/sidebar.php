<div id="overlay" class="modal-overlay"></div>

<aside id="carro_sidebar" class="sidebar" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Carrito de compras</h2>
            <button id="closeCart" class="close-btn" aria-label="Cerrar">&times;</button>
        </div>

        <div id="cart-items-container" class="cart-body"></div>

        <div class="cart-footer">
            <button id="cotizar-btn" class="main-action-btn" onclick="iniciarCotizacion()">Cotizar pedido</button>
            <a href="#" class="more-products-link">Ver más productos</a>
        </div>
    </div>
</aside>
<script>
    const BASE_URL = "<?= base_url() ?>";
</script>
<script src="<?= base_url('public/JS/sidebar.js') ?>"></script>
