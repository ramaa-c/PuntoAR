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
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada del producto..." required></textarea>
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
                                <label for="precio">Precio ($)</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" placeholder="0.00" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="stock">Stock Inicial</label>
                                <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="0" required>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Imágenes del Producto</h3>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="imagenes">Seleccionar Imágenes</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagenes" name="imagenes[]" multiple accept="image/*">
                                    <label class="custom-file-label" for="imagenes">Elegir archivos...</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Máximo 5 imágenes. Formatos: JPG, PNG.</small>
                        </div>

                    </div>
                </div>
                <div class="pb-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-save"></i> Guardar Producto
                    </button>
                    <a href="<?= base_url('admin/productos') ?>" class="btn btn-secondary btn-lg ml-2">
                        Cancelar
                    </a>
                </div>

                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>