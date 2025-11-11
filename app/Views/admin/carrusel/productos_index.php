<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Gestión de Carruseles' ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carruseles de Productos</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Añadir Nuevo Carrusel</h3>
                    </div>

                    <?= form_open(base_url('admin/carrusel/guardar_productos')) ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="titulo">Título del Carrusel</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Las Mejores Ofertas, Novedades" required value="<?= old('titulo') ?>">
                        </div>

                        <div class="form-group mt-3">
                            <label for="id_categoria">Categoría de Productos</label>
                            <select class="form-control" id="id_categoria" name="id_categoria" required>
                                <option value="0" <?= set_select('id_categoria', 0) ?>>-- Mostrar Todas las Categorías --</option>

                                <?php if (!empty($categorias)): ?>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option
                                            value="<?= $cat['id_categoria'] ?>"
                                            <?= set_select('id_categoria', $cat['id_categoria']) ?>>
                                            <?= esc($cat['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="tipo">Tipo de Producto a Mostrar</label>

                            <select class="form-control" id="tipo" name="tipo">
                                <option value="" <?= set_select('tipo', '') ?>>Mostrar Ambos Tipos</option>
                                <option value="estandar" <?= set_select('tipo', 'estandar') ?>>Solo Estándar</option>
                                <option value="personalizable" <?= set_select('tipo', 'personalizable') ?>>Solo Personalizable</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="limite">Límite de Productos a Mostrar</label>
                            <input type="number" class="form-control" id="limite" name="limite" value="12" min="1" required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="orden">Orden de Visualización</label>
                            <input type="number" class="form-control" id="orden" name="orden" value="<?= $siguiente_orden ?? 1 ?>" min="1" required>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="bi bi-plus-circle"></i> Guardar Configuración</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Configuraciones Activas</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="tablaCarruseles">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Orden</th>
                                    <th>Título</th>
                                    <th>Categoría</th>
                                    <th style="width: 15%">Límite</th>
                                    <th style="width: 15%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($configuraciones)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No hay carruseles configurados.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($configuraciones as $conf): ?>
                                        <tr data-id="<?= $conf['id'] ?>">
                                            <td><?= $conf['orden'] ?></td>
                                            <td><?= esc($conf['titulo']) ?></td>
                                            <td>
                                                <?php
                                                if ($conf['id_categoria'] == 0) {
                                                    echo 'Todas';
                                                } else {
                                                    echo esc($conf['nombre_categoria'] ?? 'ID ' . $conf['id_categoria']);
                                                }
                                                ?>
                                            </td>
                                            <td><?= $conf['limite'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm btn-eliminar-carrusel" title="Eliminar" data-id="<?= $conf['id'] ?>" data-nombre="<?= esc($conf['titulo']) ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const botonesEliminar = document.querySelectorAll('.btn-eliminar-carrusel');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', async function(e) {
            e.preventDefault();
            
            const idCarrusel = this.dataset.id;
            const nombre = this.dataset.nombre || 'el carrusel';

            if (!confirm(`¿Seguro que deseas eliminar el carrusel "${nombre}"? Esta acción no se puede deshacer.`)) {
                return;
            }

            try {
                const url = '<?= base_url('admin/carrusel/eliminar/') ?>' + idCarrusel;

                const body = new URLSearchParams();
                body.append('_method', 'POST'); 
                body.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');

                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                    },
                    body: body.toString()
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    const fila = boton.closest('tr');
                    if (fila) fila.remove();
                    alert('✅ Carrusel eliminado correctamente.');
                } else {
                    alert('⚠️ No se pudo eliminar el carrusel. ' + (data.message || ''));
                    console.error(data);
                }
            } catch (err) {
                console.error(err);
                alert('❌ Error en la solicitud.');
            }
        });
    });
});
</script>