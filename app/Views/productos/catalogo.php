<?= view('layout/header', ['titulo' => 'Catalogo - PuntoAR', 'estilos' => ['catalogo.css']]) ?>
<?= view('layout/navbar') ?>
<?= view('layout/sidebar') ?>

<div class="contenedor-catalogo">

    <aside class="catalogo-filtros">
        <h2>Filtrar por</h2>

        <div class="filtro-grupo">
            <h4>BUSCAR</h4>
            <input type="search" id="filtro-buscar" placeholder="Buscar por nombre..." class="filtro-buscar">
        </div>

        <div class="filtro-grupo">
            <h4>TIPO</h4>
            <label><input type="radio" name="tipo" value="" checked> Todos</label><br>
            <label><input type="radio" name="tipo" value="estandar"> Estándar</label><br>
            <label><input type="radio" name="tipo" value="personalizable"> Personalizable</label>
        </div>

        <div class="filtro-grupo">
            <h4>CATEGORÍAS</h4>
            <div id="filtro-categorias">
                <?php foreach ($categorias as $cat): ?>
                    <label class="filtro-opcion">
                        <input type="checkbox" name="categoria[]" value="<?= $cat['id_categoria'] ?>">
                        <?= esc($cat['nombre']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <a href="#" class="ver-mas">Ver más</a>
        </div>
    </aside>

    <main class="catalogo-productos">
        <div class="catalogo-header">
            <label for="ordenar">Ordenar por:</label>
            <select id="ordenar">
                <option value="fecha-desc">Más nuevos</option>
                <option value="fecha-asc">Más antiguos</option>
                <option value="nombre-asc">Nombre A → Z</option>
                <option value="nombre-desc">Nombre Z → A</option>
                <option value="precio-asc">Precio (Menor → Mayor)</option>
                <option value="precio-desc">Precio (Mayor → Menor)</option>
            </select>
        </div>

        <div id="productos-listado">
            <?php foreach ($productos as $producto): ?>
                <?php
                $imagenUrl = !empty($producto['imagen_url'])
                    ? $producto['imagen_url']
                    : base_url('public/' . ($producto['imagen'] ?? 'images/placeholder.png'));
                ?>
                <div class="producto-card"
                    data-url="<?= site_url('producto/' . $producto['id_producto']) ?>">
                    <img src="<?= esc($imagenUrl) ?>"
                        alt="<?= esc($producto['nombre']) ?>">
                    <p class="producto-precio">
                        <?= ($producto['precio'] && $producto['precio'] > 0)
                            ? '$' . number_format($producto['precio'], 0)
                            : '<span class="sin-precio">Cotizable</span>' ?>
                    </p>
                    <p class="producto-nombre"><?= esc($producto['nombre']) ?></p>
                    <button class="btn-comprar"
                        data-id="<?= $producto['id_producto'] ?>"
                        data-nombre="<?= esc($producto['nombre']) ?>"
                        data-precio="<?= $producto['precio'] ?? '' ?>"
                        data-imagen="<?= esc($producto['imagen']) ?>"
                        data-producto-tipo="<?= esc($producto['tipo']) ?>">
                        Comprar
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<script src="<?= base_url('public/JS/sidebar.js') ?>"></script>
<script src="<?= base_url('public/JS/catalogo.js') ?>"></script>

<?= view('layout/footer') ?>