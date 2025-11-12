document.addEventListener("DOMContentLoaded", function () {
  const mainImage = document.getElementById("main-product-image");
  const thumbnails = document.querySelectorAll(".thumbnail-image");

  if (mainImage && thumbnails.length > 0) {
    thumbnails.forEach((thumbnail) => {
      thumbnail.addEventListener("click", function () {
        const newSrc = this.getAttribute("data-full-src");

        mainImage.src = newSrc;

        thumbnails.forEach((t) => t.classList.remove("active"));
        this.classList.add("active");
      });
    });

    if (thumbnails[0]) {
      thumbnails[0].classList.add("active");
    }
  }

  const qtyButtons = document.querySelectorAll(".qty-btn");

  qtyButtons.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      const controlDiv = this.closest(".quantity-control");
      const qtyInput = controlDiv.querySelector(".qty-input");

      let current = parseInt(qtyInput.value) || 1;

      if (this.textContent === "+" && current < 99) {
        qtyInput.value = current + 1;
      } else if (this.textContent === "-" && current > 1) {
        qtyInput.value = current - 1;
      }
    });
  });

  const buyButtons = document.querySelectorAll(".btn-add");

  buyButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.stopPropagation();

      const id = this.getAttribute("data-id");
      const nombre = this.getAttribute("data-nombre");
      const precio = parseFloat(this.getAttribute("data-precio"));
      const imagen = this.getAttribute("data-imagen");

      const controlDiv = this.closest(".quantity-control");
      const qtyInput = controlDiv.querySelector(".qty-input");
      const cantidad = parseInt(qtyInput.value) || 1;

      if (typeof window.agregarAlCarrito === "function") {
        window.agregarAlCarrito({
          id: id,
          nombre: nombre,
          precio: precio,
          cantidad: cantidad,
          imagen: imagen,
        });
      } else {
        console.warn(
          "La función agregarAlCarrito no está definida en la ventana global."
        );
      }
    });
  });
});
