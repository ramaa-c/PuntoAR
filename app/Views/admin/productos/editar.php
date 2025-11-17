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
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada del producto..."><?= set_value('descripcion', $producto['descripcion'] ?? '') ?></textarea>
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
                                <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" placeholder="0.00" value="<?= set_value('precio', $producto['precio'] ?? '') ?>">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="stock">Stock Inicial</label>
                                <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="0" value="<?= set_value('stock', $producto['stock'] ?? '') ?>">
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
                            <small class="form-text text-muted">Subir una nueva reemplazará la imagen principal actual (oreden 1).</small>
                        </div>

                        <div class="row">
                            <?php
                            $ordenesExistentes = array_column($imagenes, 'orden');
                            $maxOrden = !empty($ordenesExistentes) ? max($ordenesExistentes) : 1;
                            for ($orden = 2; $orden <= max(6, $maxOrden); $orden++):
                            ?>
                                <div class="form-group col-md-4">
                                    <label for="imagen_secundaria_<?= $orden ?>">Imagen Secundaria <?= $orden - 1 ?> (Añadir/Reemplazar)</label>
                                    <input type="file" class="form-control" id="imagen_secundaria_<?= $orden ?>" name="imagen_secundaria[<?= $orden ?>]" accept="image/*">
                                    <small class="form-text text-muted">Esta reemplaza la imagen con orden <?= $orden ?> o la crea.</small>
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
                        const form = document.getElementById('form-editar-producto');
                        const btnSubmit = form.querySelector('button[type="submit"]');

                        const msgBox = document.createElement('div');
                        msgBox.style.position = 'fixed';
                        msgBox.style.top = '20px';
                        msgBox.style.right = '20px';
                        msgBox.style.zIndex = '2000';
                        document.body.appendChild(msgBox);

                        form.addEventListener('submit', async function(e) {
                            e.preventDefault();

                            const formData = new FormData(form);

                            btnSubmit.disabled = true;
                            btnSubmit.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Guardando...';

                            try {
                                const response = await fetch(form.action, {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                });

                                const result = await response.json();

                                if (response.ok && result.success) {
                                    showMessage('✅ Producto actualizado correctamente', 'success');
                                    setTimeout(() => window.location.reload(), 1500);
                                } else {
                                    showMessage('⚠️ Ocurrió un error al actualizar', 'error');
                                    console.error(result);
                                }

                            } catch (err) {
                                console.error(err);
                                showMessage('❌ Error en la solicitud', 'error');
                            } finally {
                                btnSubmit.disabled = false;
                                btnSubmit.innerHTML = '<i class="bi bi-arrow-up-circle"></i> Actualizar Producto';
                            }
                        });

                        function showMessage(text, type = 'info') {
                            const div = document.createElement('div');
                            div.textContent = text;
                            div.className = `fade-message ${type}`;
                            msgBox.appendChild(div);

                            setTimeout(() => {
                                div.style.opacity = '0';
                                setTimeout(() => div.remove(), 500);
                            }, 2000);
                        }
                    });
                </script>

                <style>
                    .fade-message {
                        background: #2d3436;
                        color: white;
                        padding: 10px 16px;
                        margin-top: 8px;
                        border-radius: 8px;
                        font-weight: 500;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
                        transition: opacity 0.5s ease;
                    }

                    .fade-message.success {
                        background: #27ae60;
                    }

                    .fade-message.error {
                        background: #c0392b;
                    }

                    .spin {
                        animation: spin 1s linear infinite;
                    }

                    @keyframes spin {
                        from {
                            transform: rotate(0deg);
                        }

                        to {
                            transform: rotate(360deg);
                        }
                    }
                </style>

            </div>
        </div>
    </div>
</div>