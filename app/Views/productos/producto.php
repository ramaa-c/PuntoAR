<?= view('layout/header', ['titulo' => $producto['nombre'] . ' - PuntoAR', 'estilos' => ['producto.css', 'sidebar.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>


<div class="product-wrapper">
    <div id="overlay" class="overlay"></div>

    <div class="product-container">
        <div class="product-image-section">
            <img src="<?= esc($producto['imagen']) ?>" alt="<?= esc($producto['nombre']) ?>" class="main-product-image">
            <p class="description-title">Descripción</p>
            <p class="product-description">
                <?= esc($producto['descripcion']) ?>
            </p>
        </div>

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
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productItems = document.querySelectorAll(".product-item-visible");

        productItems.forEach(item => {
            item.addEventListener("click", function (e) {
                if (!e.target.classList.contains("btn-add")) {
                    const url = item.getAttribute("data-url");
                    if (url) {
                        window.location.href = url;
                    }
                }
            });
        });

        const buyButtons = document.querySelectorAll(".btn-add");

        buyButtons.forEach(button => {
            button.addEventListener("click", function (e) {
                e.stopPropagation(); 

                const id = this.getAttribute("data-id");
                const nombre = this.getAttribute("data-nombre");
                const precio = parseFloat(this.getAttribute("data-precio"));
                const imagen = this.getAttribute("data-imagen");

                const qtyInput = this.closest(".quantity-control").querySelector(".qty-input");
                const cantidad = parseInt(qtyInput.value) || 1;

                agregarAlCarrito({
                    id: id,
                    nombre: nombre,
                    precio: precio,
                    cantidad: cantidad,
                    imagen: imagen
                });
            });
        });
    });

document.addEventListener("DOMContentLoaded", () => {
    const qtyInput = document.querySelector(".qty-input");
    const buttons = document.querySelectorAll(".qty-btn");

    buttons.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            let current = parseInt(qtyInput.value) || 1;

            if (btn.textContent === "+" && current < 99) {
                qtyInput.value = current + 1;
            } else if (btn.textContent === "-" && current > 1) {
                qtyInput.value = current - 1;
            }
        });
    });
});
</script>

<?= view('layout/footer') ?>
