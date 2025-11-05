<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Categorías' ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categorías</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-4">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Añadir Nueva Categoría</h3>
                    </div>
                    <?= form_open(base_url('admin/categorias/guardar')) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Laptops, Componentes, Accesorios" required value="<?= old('nombre') ?>">
                            <?= session('errors.nombre') ? '<small class="text-danger">' . session('errors.nombre') . '</small>' : '' ?>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción (Opcional)</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción breve para la categoría."><?= old('descripcion') ?></textarea>
                            <?= session('errors.descripcion') ? '<small class="text-danger">' . session('errors.descripcion') . '</small>' : '' ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="bi bi-plus-circle"></i> Guardar Categoría</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categorías Existentes</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th style="width: 15%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($categorias)): ?>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            No hay categorías registradas.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($categorias as $cat): ?>
                                        <tr>
                                            <td><?= $cat['id_categoria'] ?></td>
                                            <td><?= $cat['nombre'] ?></td>

                                            <td>
                                                <?= empty($cat['descripcion']) ? '—' : substr($cat['descripcion'], 0, 50) . (strlen($cat['descripcion']) > 50 ? '...' : '') ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url('admin/categorias/editar/' . $cat['id_categoria']) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>