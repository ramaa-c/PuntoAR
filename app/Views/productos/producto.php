<?= view('layout/header', ['titulo' => $producto['nombre'] . ' - PuntoAR', 'estilos' => ['producto.css', 'sidebar.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>

<div class="product-wrapper">
    <div id="overlay" class="overlay"></div>

    <div class="product-container">

        <!-- ===== SECCIÓN DE IMÁGENES ===== -->
        <div class="product-image-section">
            
            <?php if (!empty($imagenesGaleria)): ?>
                <div class="product-thumbnails">
                    <?php foreach ($imagenesGaleria as $index => $img): ?>
                        <img 
                            src="<?= base_url('public/' . $img['ruta_imagen']) ?>" 
                            alt="Miniatura <?= $index + 1 ?>" 
                            class="thumbnail-image <?= $index === 0 ? 'active' : '' ?>"
                            data-full-src="<?= base_url('public/' . $img['ruta_imagen']) ?>" 
                        >
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="main-image-display">
                <img 
                    id="main-product-image"
                    src="<?= base_url('public/' . $producto['imagen']) ?>" 
                    alt="<?= esc($producto['nombre']) ?>" 
                    class="main-product-image"
                >
            </div>
        </div>

        <!-- ===== DETALLES DEL PRODUCTO ===== -->
        <div class="product-details-section">
            <h1 class="product-name"><?= esc($producto['nombre']) ?></h1>
            
            <div class="price-info">
                <p class="main-price">$<?= number_format($producto['precio'], 2, ',', '.') ?></p>
                <p class="installments">3 cuotas de $<?= number_format($producto['precio'] / 3, 2, ',', '.') ?></p>
            </div>
            
            <div class="quantity-control">
                <div class="input-group">
                    <button class="qty-btn">-</button>
                    <input type="text" value="1" class="qty-input">
                    <button class="qty-btn">+</button>
                </div>
                <button 
                    class="btn-add"
                    data-id="<?= $producto['id_producto'] ?>"
                    data-nombre="<?= esc($producto['nombre']) ?>"
                    data-precio="<?= $producto['precio'] ?>"
                    data-imagen="<?= esc($producto['imagen']) ?>"
                >
                    Agregar al carrito
                </button>
            </div>

            <div class="purchase-benefits">
                <div class="benefit-item">
                    <i class="fas fa-lock"></i>
                    <p><b>Compra protegida</b><br>Tus datos cuidados durante toda la compra.</p>
                </div>
                <div class="benefit-item">
                    <i class="fas fa-undo"></i>
                    <p><b>Cambios y devoluciones</b><br>Si no te gusta, podés cambiarlo por otro o devolverlo.</p>
                </div>
            </div>

            <p class="description-title">Descripción</p>
            <p class="product-description">
                <?= esc($producto['descripcion']) ?>
            </p>
        </div>

    </div>
</div>

<script src="<?= base_url('public/JS/producto.js') ?>"></script>

<?= view('layout/footer') ?>
