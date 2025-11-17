<?= view('layout/header', ['titulo' => 'PuntoAR', 'estilos' => ['principal.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>

<div class="contenedor_principal">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="mensaje-exito">
            <?= session()->getFlashdata('success') ?>
        </div>
        <script>
            setTimeout(() => {
                document.querySelector('.mensaje-exito')?.remove();
            }, 3500);
        </script>
    <?php endif; ?>
    <div id="overlay" class="overlay"></div>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="contenido_principal">
        <!-- ===== CARRUSEL BANNERS ===== -->
        <div class="carousel">
            <div class="carousel-track">

                <?php if (!empty($banners)): ?>
                    <?php foreach ($banners as $banner): ?>
                        <div class="carousel-slide">
                            <a href="<?= esc($banner['enlace'] ?? '#') ?>">
                                <img
                                    src="<?= base_url('public/' . $banner['ruta_imagen']) ?>"
                                    alt="<?= esc($banner['titulo'] ?? 'Banner') ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="carousel-slide"><img src="<?= base_url('public/images/default_banner.png') ?>" alt="Banner por defecto"></div>
                <?php endif; ?>

            </div>
            <button class="carousel-btn prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="carousel-btn next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>
        <!-- ===== CARRUSEL PRODUCTOS ===== -->
        <?php if (!empty($carruseles)): ?>
            <?php foreach ($carruseles as $carrusel): ?>

                <section class="product-carousel-visible">
                    <h2 class="carousel-title"><?= esc($carrusel['titulo']) ?></h2>

                    <button class="carousel-arrow left-arrow" onclick="moveProductCarousel('<?= esc($carrusel['id_wrapper']) ?>', -1)"><i class="fa-solid fa-circle-arrow-left"></i></button>

                    <div class="carousel-wrapper" id="<?= esc($carrusel['id_wrapper']) ?>-wrapper">
                        <div class="carousel-track-visible" id="<?= esc($carrusel['id_wrapper']) ?>-track">

                            <?php if (!empty($carrusel['productos'])): ?>
                                <?php foreach ($carrusel['productos'] as $producto): ?>

                                    <div class="product-item-visible" data-url="<?= site_url('producto/' . $producto['id_producto']) ?>">
                                        <div class="product-image-container">
                                            <img
                                                src="<?= base_url('public/' . $producto['imagen']) ?>"
                                                alt="<?= esc($producto['nombre']) ?>"
                                                class="product-image">
                                        </div>
                                        <p class="product-name"><b><?= esc($producto['nombre']) ?></b></p>
                                        <button
                                            class="buy-button"
                                            data-id="<?= $producto['id_producto'] ?>"
                                            data-nombre="<?= esc($producto['nombre']) ?>"
                                            data-precio="<?= $producto['precio'] ?>"
                                            data-imagen="<?= esc($producto['imagen']) ?>"
                                            data-producto-tipo="<?= esc($producto['tipo']) ?>"> Comprar
                                        </button>
                                    </div>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No hay productos disponibles en esta categoría.</p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <button class="carousel-arrow right-arrow" onclick="moveProductCarousel('<?= esc($carrusel['id_wrapper']) ?>', 1)"><i class="fa-solid fa-circle-arrow-right"></i></button>

                    <div class="carousel-dots" id="<?= esc($carrusel['id_wrapper']) ?>-dots"></div>
                </section>

            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay carruseles de productos configurados.</p>
        <?php endif; ?>

        <section class="instagram-feed-section">
            <div class="instagram-header">
                <a href="https://www.instagram.com/puntoarsanluis?igsh=M3V4YndhNjBoamRh" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                    <p>
                        <strong>Seguinos en @puntoarsanluis</strong>
                    </p>
                </a>
            </div>

            <div class="instagram-grid">

                <div class="instagram-item">
                    <a href="https://www.instagram.com/p/DLLw9watohy/" target="_blank" rel="noopener noreferrer">
                        <img src="<?= base_url('public/images/instagram/ig1.webp') ?>" alt="Instagram Post 1">
                    </a>
                </div>

                <div class="instagram-item">
                    <a href="https://www.instagram.com/p/DNrS7G_4gLB/?img_index=1" target="_blank" rel="noopener noreferrer">
                        <img src="<?= base_url('public/images/instagram/ig2.webp') ?>" alt="Instagram Post 2">
                    </a>
                </div>

                <div class="instagram-item">
                    <a href="https://www.instagram.com/p/DNOkhJUJ2lI/?img_index=1" target="_blank" rel="noopener noreferrer">
                        <img src="<?= base_url('public/images/instagram/ig3.webp') ?>" alt="Instagram Post 3">
                    </a>
                </div>

                <div class="instagram-item">
                    <a href="https://www.instagram.com/p/DNTVdY-tFyo/?img_index=1" target="_blank" rel="noopener noreferrer">
                        <img src="<?= base_url('public/images/instagram/ig4.webp') ?>" alt="Instagram Post 4">
                    </a>
                </div>

            </div>
        </section>

    </main>
    <script src="<?= base_url('public/JS/banners.js') ?>"></script>
    <script src="<?= base_url('public/JS/productos_carrusel.js') ?>"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const productItems = document.querySelectorAll(".product-item-visible");

            productItems.forEach(item => {
                item.addEventListener("click", function(e) {
                    if (!e.target.classList.contains("buy-button")) {
                        const url = item.getAttribute("data-url");
                        if (url) {
                            window.location.href = url;
                        }
                    }
                });
            });

            const alertSuccess = document.querySelector('.mensaje-exito');
            if (alertSuccess) {
                localStorage.setItem('carrito', JSON.stringify([]));

                const ev = new CustomEvent('carritoActualizado', {
                    detail: {
                        total: 0
                    }
                });
                document.dispatchEvent(ev);
                window.dispatchEvent(ev);

                window.dispatchEvent(new CustomEvent('carritoVaciado'));

                console.log('Carrito vaciado tras pedido exitoso.');
            }

            // ===== BOTONES COMPRAR ===== //
            const buyButtons = document.querySelectorAll(".buy-button");

            buyButtons.forEach(button => {
                button.addEventListener("click", function(e) {
                    e.stopPropagation();

                    const id = this.getAttribute("data-id");
                    const nombre = this.getAttribute("data-nombre");
                    const precio = parseFloat(this.getAttribute("data-precio"));
                    const imagen = this.getAttribute("data-imagen");
                    const tipo = this.getAttribute("data-producto-tipo");

                    agregarAlCarrito({
                        id: id,
                        nombre: nombre,
                        precio: precio,
                        cantidad: 1,
                        imagen: imagen,
                        tipo: tipo
                    });
                });
            });
            initializeProductCarousels();
        });
    </script>

</div>

<?= view('layout/footer') ?>