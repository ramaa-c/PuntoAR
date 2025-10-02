<?= view('layout/header', ['titulo' => 'PuntoAR', 'estilos' => ['principal.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>

<div class="contenedor_principal">
    <div id="overlay" class="overlay"></div>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="contenido_principal">
        <!-- ===== CARRUSEL BANNERS ===== -->
        <div class="carousel">
            <div class="carousel-track">
            <div class="carousel-slide"><img src="<?= base_url('public/images/bannerdianiño.png') ?>" alt="Imagen 1"></div>
            <div class="carousel-slide"><img src="<?= base_url('public/images/bannernavidad.jpg') ?>" alt="Imagen 2"></div>
            <div class="carousel-slide"><img src="<?= base_url('public/images/bannerregresoaclase.jpg') ?>" alt="Imagen 3"></div>
            </div>
            <button class="carousel-btn prev"><i class="fa-solid fa-circle-arrow-left"></i></button>
            <button class="carousel-btn next"><i class="fa-solid fa-circle-arrow-right"></i></button>
        </div>
        <!-- ===== CARRUSEL PRODUCTOS ===== -->
        <section class="product-carousel-visible">
            <h2 class="carousel-title">Productos Personalizables</h2>
            
            <div class="carousel-wrapper" id="personalizables-wrapper">
                <button class="carousel-arrow left-arrow" onclick="moveProductCarousel('personalizables', -1)"><i class="fa-solid fa-circle-arrow-left"></i></button>
                <div class="carousel-track-visible" id="personalizables-track">

                    <?php if (!empty($personalizables)): ?>
                        <?php foreach ($personalizables as $producto): ?>
                            <div class="product-item-visible" data-url="<?= site_url('producto/' . $producto['id_producto']) ?>">
                                <div class="product-image-container">
                                    <img src="<?= esc($producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" class="product-image">
                                </div>
                                <p class="product-name"><b><?= esc($producto['nombre']) ?></b></p>
                                <button 
                                    class="buy-button"
                                    data-id="<?= $producto['id_producto'] ?>"
                                    data-nombre="<?= esc($producto['nombre']) ?>"
                                    data-precio="<?= $producto['precio'] ?>"
                                    data-imagen="<?= esc($producto['imagen']) ?>"
                                >
                                    Comprar
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay productos disponibles.</p>
                    <?php endif; ?>

                    </div>
                <button class="carousel-arrow right-arrow" onclick="moveProductCarousel('personalizables', 1)"><i class="fa-solid fa-circle-arrow-right"></i></button>
            </div>
            <div class="carousel-dots" id="personalizables-dots">
                </div>
        </section>

        <section class="product-carousel-visible">
            <h2 class="carousel-title">Tazas Mágicas</h2>
            
            <div class="carousel-wrapper" id="magicas-wrapper">
                <button class="carousel-arrow left-arrow" onclick="moveProductCarousel('magicas', -1)"><i class="fa-solid fa-circle-arrow-left"></i></button>
                <div class="carousel-track-visible" id="magicas-track">

                    <?php if (!empty($tazas_magicas)): ?>
                        <?php foreach ($tazas_magicas as $producto): ?>
                            <div class="product-item-visible" data-url="<?= site_url('producto/' . $producto['id_producto']) ?>">
                                <div class="product-image-container">
                                    <img src="<?= esc($producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" class="product-image">
                                </div>
                                <p class="product-name"><b><?= esc($producto['nombre']) ?></b></p>
                                <button 
                                    class="buy-button"
                                    data-id="<?= $producto['id_producto'] ?>"
                                    data-nombre="<?= esc($producto['nombre']) ?>"
                                    data-precio="<?= $producto['precio'] ?>"
                                    data-imagen="<?= esc($producto['imagen']) ?>"
                                >
                                    Comprar
                                </button>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No hay tazas mágicas disponibles.</p>
                    <?php endif; ?>

                    </div>
                <button class="carousel-arrow right-arrow" onclick="moveProductCarousel('magicas', 1)"><i class="fa-solid fa-circle-arrow-right"></i></button>
            </div>
            <div class="carousel-dots" id="magicas-dots">
                </div>
        </section>

    </main>
    <script src="<?= base_url('public/JS/banners.js') ?>"></script>
    <script src="<?= base_url('public/JS/productos_carrusel.js') ?>"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const productItems = document.querySelectorAll(".product-item-visible");

        productItems.forEach(item => {
            item.addEventListener("click", function (e) {
                if (!e.target.classList.contains("buy-button")) {
                    const url = item.getAttribute("data-url");
                    if (url) {
                        window.location.href = url;
                    }
                }
            });
        });

        // ===== BOTONES COMPRAR ===== //
        const buyButtons = document.querySelectorAll(".buy-button");

        buyButtons.forEach(button => {
            button.addEventListener("click", function (e) {
                e.stopPropagation(); 

                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");
                const precio = parseFloat(this.getAttribute("data-precio"));
                const imagen = this.getAttribute("data-imagen");

                agregarAlCarrito({
                    id: id,
                    nombre: nombre,
                    precio: precio,
                    cantidad: 1,
                    imagen: imagen
                });
            });
        });
    });
    </script>

</div>

<?= view('layout/footer') ?>
