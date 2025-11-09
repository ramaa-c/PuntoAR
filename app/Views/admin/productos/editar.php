<div class="app-content-header">
    <div class="container-fluid">
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= form_open_multipart(base_url('admin/productos/actualizar/' . $producto['id_producto']), ['id' => 'form-editar-producto']) ?>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Información Básica</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nombre">Nombre del Producto</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nombre"
                                name="nombre"
                                placeholder="Ej: Taza Mágica"
                                required
                                value="<?= set_value('nombre', $producto['nombre']) ?>">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada del producto..." required><?= set_value('descripcion', $producto['descripcion']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="id_categoria">Categoría</label>
                                <select class="form-control" id="id_categoria" name="id_categoria" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option
                                            value="<?= $cat['id_categoria'] ?>"
                                            <?= set_select('id_categoria', $cat['id_categoria'], (int)$producto['id_categoria'] === (int)$cat['id_categoria']) ?>>
                                            <?= $cat['nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tipo">Tipo de Producto</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="estandar" <?= set_select('tipo', 'estandar', $producto['tipo'] === 'estandar') ?>>Estándar</option>
                                    <option value="personalizable" <?= set_select('tipo', 'personalizable', $producto['tipo'] === 'personalizable') ?>>Personalizable</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="precio">Precio ($)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" placeholder="0.00" required value="<?= set_value('precio', $producto['precio']) ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="stock">Stock Inicial</label>
                                <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="0" required value="<?= set_value('stock', $producto['stock']) ?>">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Imágenes del Producto</h3>
                    </div>
                    <div class="card-body">

                        <h4>Imágenes Actuales (Galería)</h4>
                        <div class="row mb-4">
                            <?php if (!empty($imagenes)): ?>
                                <?php foreach ($imagenes as $img): ?>
                                    <div class="col-md-2 mb-3">
                                        <img
                                            src="<?= base_url('public/' . $img['ruta_imagen']) ?>"
                                            class="img-fluid border"
                                            alt="Imagen producto"
                                            style="height: 100px; object-fit: cover;">
                                        <div class="text-center mt-1">
                                            <a href="#" class="btn btn-sm btn-danger btn-eliminar-imagen" data-id="<?= $img['id'] ?>">Eliminar</a>
                                        </div>
                                        <small class="d-block text-center text-muted">Orden: <?= $img['orden'] ?></small>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted">No hay imágenes cargadas para este producto.</p>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <h4>Añadir o Reemplazar Imágenes</h4>
                        <div class="form-group mb-4">
                            <label for="imagen_principal">Imagen Principal (Reemplazar)</label>
                            <input type="file" class="form-control" id="imagen_principal" name="imagen_principal" accept="image/*">
                            <small class="form-text text-muted">Subir una nueva reemplazará la imagen principal actual.</small>
                        </div>

                        <div class="row">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="form-group col-md-4">
                                    <label for="imagen_secundaria_<?= $i ?>">Imagen Secundaria <?= $i ?> (Añadir/Reemplazar)</label>
                                    <input type="file" class="form-control" id="imagen_secundaria_<?= $i ?>" name="imagen_secundaria_<?= $i ?>" accept="image/*">
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <div class="pb-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-arrow-up-circle"></i> Actualizar Producto
                    </button>
                </div>

                <?= form_close() ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelectorAll('.btn-eliminar-imagen').forEach(button => {
                            button.addEventListener('click', function(e) {
                                e.preventDefault();

                                const idImagen = this.getAttribute('data-id');
                                const row = this.closest('.col-md-2');

                                if (confirm('¿Está seguro de eliminar esta imagen de la galería?')) {
                                    fetch('<?= base_url('admin/productos/eliminar-imagen/') ?>' + idImagen, {
                                            method: 'POST',
                                            headers: {
                                                'X-Requested-With': 'XMLHttpRequest',
                                                '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                                            }
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                row.style.display = 'none';
                                                alert('Imagen eliminada.');
                                            } else {
                                                alert('Error al eliminar: ' + data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Ocurrió un error en la solicitud.');
                                        });
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>