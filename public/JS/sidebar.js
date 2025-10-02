document.addEventListener("DOMContentLoaded", function() {
    let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    function guardarCarrito() {
        localStorage.setItem("carrito", JSON.stringify(carrito));
    }

    function renderCarrito() {
        const container = document.getElementById("cart-items-container");
        const footer    = document.querySelector(".cart-footer");
        container.innerHTML = "";

        if (carrito.length === 0) {
            container.innerHTML = "<p>Tu carrito está vacío</p>";
            footer.style.display = "none";
            return;
        }

        footer.style.display = "block";

        carrito.forEach((item, index) => {
            container.innerHTML += `
                <div class="cart-item" data-index="${index}">
                    <div class="item-info">
                        <img src="${item.imagen}" alt="${item.nombre}">
                        <div>
                            <p class="item-name">${item.nombre}</p>
                            <div class="quantity-control-sidebar">
                                <button onclick="cambiarCantidad(${index}, -1)">-</button>
                                <input type="text" value="${item.cantidad}" readonly>
                                <button onclick="cambiarCantidad(${index}, 1)">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="item-actions">
                        <a href="#" onclick="eliminarProducto(${index})" class="eliminar-btn">Eliminar</a>
                        <p class="item-price">$${(item.precio * item.cantidad).toFixed(2)}</p>
                    </div>
                </div>
                <hr class="subtotal-separator">
            `;
        });
    }

    window.agregarAlCarrito = function(producto) {
        let existe = carrito.find(p => p.id === producto.id);
        if (existe) {
            existe.cantidad += producto.cantidad;
        } else {
            carrito.push(producto);
        }
        guardarCarrito();
        renderCarrito();
    }

    window.cambiarCantidad = function(index, delta) {
        carrito[index].cantidad += delta;
        if (carrito[index].cantidad <= 0) {
            carrito.splice(index, 1);
        }
        guardarCarrito();
        renderCarrito();
    }

    window.eliminarProducto = function(index) {
        carrito.splice(index, 1);
        guardarCarrito();
        renderCarrito();
    }

    // ====== ABRIR / CERRAR SIDEBAR ====== //
    const body     = document.body;
    const sidebar  = document.getElementById("carro_sidebar");
    const toggleBtn= document.getElementById("btn_carrito");
    const overlay  = document.getElementById("overlay");
    const closeBtn = document.getElementById("closeCart");

    function openCart(){
        body.classList.add("cart-open");
        sidebar.classList.add("active");
        overlay.classList.add("active");
        sidebar.setAttribute("aria-hidden", "false");
    }

    function closeCart(){
        body.classList.remove("cart-open");
        sidebar.classList.remove("active");
        overlay.classList.remove("active");
        sidebar.setAttribute("aria-hidden", "true");
    }

    toggleBtn.addEventListener("click", openCart);
    closeBtn.addEventListener("click", closeCart);
    overlay.addEventListener("click", (e) => {
        if (e.target === overlay) {
            closeCart();
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && body.classList.contains("cart-open")) {
            closeCart();
        }
    });

    renderCarrito();
});
function iniciarCotizacion() {
    const carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    if (carrito.length === 0) {
        alert("Tu carrito está vacío.");
        return;
    }

    const form = document.createElement("form");
    form.method = "POST";
    form.action = BASE_URL + "pedidos/enviar";

    carrito.forEach((item, index) => {
        form.innerHTML += `
            <input type="hidden" name="productos[${index}][id]" value="${item.id}">
            <input type="hidden" name="productos[${index}][nombre]" value="${item.nombre}">
            <input type="hidden" name="productos[${index}][cantidad]" value="${item.cantidad}">
            <input type="hidden" name="productos[${index}][precio]" value="${item.precio}">
        `;
    });

    document.body.appendChild(form);
    form.submit();
}
