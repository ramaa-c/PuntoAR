document.addEventListener("DOMContentLoaded", () => {
  const contenedorProductos = document.getElementById("productos-listado");
  const ordenarSelect = document.getElementById("ordenar");
  const buscarInput = document.getElementById("filtro-buscar");
  const aplicarPrecioBtn = document.getElementById("aplicar-precio");
  const precioDesde = document.getElementById("precio-desde");
  const precioHasta = document.getElementById("precio-hasta");
  const categoriaCheckboxes = document.querySelectorAll(
    "#filtro-categorias input[type='checkbox']"
  );
  const tipoRadios = document.querySelectorAll("input[name='tipo']");
  const totalElem = document.getElementById("totalProductos");

  function debounce(fn, delay = 300) {
    let t;
    return (...args) => {
      clearTimeout(t);
      t = setTimeout(() => fn(...args), delay);
    };
  }

  function obtenerFiltros() {
    const categorias = Array.from(categoriaCheckboxes)
      .filter((chk) => chk.checked)
      .map((chk) => chk.value);

    const tipo = (() => {
      const r = Array.from(tipoRadios).find((r) => r.checked);
      return r ? r.value : "";
    })();

    return {
      categorias,
      tipo,
      q: buscarInput ? buscarInput.value.trim() : "",
      orden: ordenarSelect ? ordenarSelect.value : "",
      precio_desde: precioDesde ? precioDesde.value : "",
      precio_hasta: precioHasta ? precioHasta.value : "",
    };
  }

  async function filtrarProductos() {
    const filtros = obtenerFiltros();

    const body = new URLSearchParams();
    if (filtros.categorias && filtros.categorias.length > 0)
      body.append("categorias", filtros.categorias.join(","));
    if (filtros.tipo) body.append("tipo", filtros.tipo);
    if (filtros.q) body.append("q", filtros.q);
    if (filtros.orden) body.append("orden", filtros.orden);
    if (filtros.precio_desde) body.append("precio_desde", filtros.precio_desde);
    if (filtros.precio_hasta) body.append("precio_hasta", filtros.precio_hasta);

    try {
      console.log("Filtros enviados:", filtros);
      const resp = await fetch("productos/filtrar", {
        method: "POST",
        headers: {
          "X-Requested-With": "XMLHttpRequest",
          "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
        },
        body: body.toString(),
      });

      if (!resp.ok) throw new Error("Error en la petición");

      const productos = await resp.json();

      const totalHeader = resp.headers.get("X-Total-Count");
      const total = totalHeader ? Number(totalHeader) : productos.length;

      renderizarProductos(productos);

      if (totalElem) {
        totalElem.textContent = `Total de productos: ${total}`;
      }
    } catch (err) {
      console.error(err);
      contenedorProductos.innerHTML =
        '<p class="text-muted">Error al cargar los productos.</p>';
    }
  }

  function renderizarProductos(productos) {
    const columnasVisibles = 3;
    const conteo = productos ? productos.length : 0;

    contenedorProductos.innerHTML = "";

    if (conteo > 0 && conteo < columnasVisibles) {
      contenedorProductos.classList.add("ajuste-conteo-bajo");
    } else {
      contenedorProductos.classList.remove("ajuste-conteo-bajo");
    }

    if (conteo === 0) {
      contenedorProductos.innerHTML = "<p>No se encontraron productos.</p>";
      return;
    }

    productos.forEach((p) => {
      const card = document.createElement("div");
      card.className = "producto-card";
      card.innerHTML = `
        <img src="${p.imagen}" alt="${escapeHtml(p.nombre)}">
        <p class="producto-precio">$${Number(p.precio).toLocaleString()}</p>
        <p class="producto-nombre">${escapeHtml(p.nombre)}</p>
        <button class="btn-comprar" data-id="${p.id_producto}" 
                data-nombre="${escapeHtml(p.nombre)}" 
                data-precio="${p.precio}" 
                data-imagen="${p.imagen}">
          Comprar
        </button>
      `;
      contenedorProductos.appendChild(card);
    });

    document.querySelectorAll(".btn-comprar").forEach((btn) => {
      btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-id");
        const nombre = btn.getAttribute("data-nombre");
        const precio = parseFloat(btn.getAttribute("data-precio"));
        const imagen = btn.getAttribute("data-imagen");

        if (typeof window.agregarAlCarrito === "function") {
          window.agregarAlCarrito({ id, nombre, precio, cantidad: 1, imagen });
        } else {
          console.warn("agregarAlCarrito no está definida");
        }
      });
    });
  }

  function escapeHtml(text) {
    return String(text)
      .replace(/&/g, "&amp;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#39;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;");
  }

  categoriaCheckboxes.forEach((chk) =>
    chk.addEventListener("change", filtrarProductos)
  );
  tipoRadios.forEach((r) => r.addEventListener("change", filtrarProductos));
  ordenarSelect.addEventListener("change", filtrarProductos);

  aplicarPrecioBtn?.addEventListener("click", (e) => {
    e.preventDefault();
    filtrarProductos();
  });

  if (buscarInput) {
    const buscarDebounced = debounce(filtrarProductos, 350);
    buscarInput.addEventListener("input", buscarDebounced);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const productos = document.querySelectorAll(".producto-card");

  productos.forEach((item) => {
    item.addEventListener("click", function (e) {
      if (!e.target.classList.contains("btn-comprar")) {
        const url = item.getAttribute("data-url");
        if (url) {
          window.location.href = url;
        }
      }
    });
  });

  const botonesComprar = document.querySelectorAll(".btn-comprar");

  botonesComprar.forEach((button) => {
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
        imagen: imagen,
      });
    });
  });
});
