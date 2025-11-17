<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Crear Nuevo Producto' ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/productos') ?>">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <?= form_open_multipart(base_url('admin/productos/crear_guardar'), ['id' => 'form-crear-producto']) ?>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Información Básica</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nombre">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Taza Mágica" required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción<small class="text-muted">(opcional)</small></label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada del producto..."></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="categoria_id">Categoría</label>

                                <select class="form-control" id="id_categoria" name="id_categoria" required>
                                    <option value="">Seleccione una categoría</option>

                                    <?php foreach ($categorias as $cat): ?>
                                        <option
                                            value="<?= $cat['id_categoria'] ?>"
                                            <?= set_select('id_categoria', $cat['id_categoria']) ?>>
                                            <?= $cat['nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                                <?php if (session('errors.id_categoria')): ?>
                                    <small class="text-danger"><?= session('errors.id_categoria') ?></small>
                                <?php endif; ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tipo">Tipo de Producto</label>
                                <select class="form-control" id="tipo" name="tipo" required>
                                    <option value="estandar" <?= set_select('tipo', 'estandar') ?>>Estándar</option>
                                    <option value="personalizable" <?= set_select('tipo', 'personalizable') ?>>Personalizable</option>
                                </select>
                                <?= session('errors.tipo') ? '<small class="text-danger">' . session('errors.tipo') . '</small>' : '' ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="precio">Precio ($)<small class="text-muted">(opcional)</small></label>
                                <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" placeholder="0.00">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="stock">Stock Inicial<small class="text-muted">(opcional)</small></label>
                                <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="0">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Imágenes del Producto</h3>
                        <small class="float-end text-white-50">Máximo 6 imágenes.</small>
                    </div>
                    <div class="card-body">

                        <div class="form-group mb-4">
                            <label for="imagen_principal">Imagen Principal</label>
                            <input type="file" class="form-control" id="imagen_principal" name="imagen_principal" accept="image/*">
                            <small class="form-text text-muted">Esta será la imagen de miniatura y listado.</small>
                        </div>

                        <div class="row">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="form-group col-md-4">
                                    <label for="imagen_secundaria_<?= $i ?>">Imagen Secundaria <?= $i ?> (Opcional)</label>
                                    <input type="file" class="form-control" id="imagen_secundaria_<?= $i ?>" name="imagen_secundaria_<?= $i ?>" accept="image/*">
                                </div>
                            <?php endfor; ?>
                        </div>

                    </div>
                </div>
                <div class="pb-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-save"></i> Guardar Producto
                    </button>
                </div>

                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>