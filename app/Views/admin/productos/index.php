<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0"><?= $title ?? 'Productos' ?></h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Productos</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Listado Completo del Catálogo</h3>
                        <div class="card-tools">
                            <a href="<?= base_url('admin/productos/crear') ?>" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-lg"></i> Agregar Producto
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th style="width: 15%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($productos)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            No hay productos registrados en este momento.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($productos as $producto): ?>
                                        <tr>
                                            <td><?= $producto['id_producto'] ?></td>
                                            <td>
                                                <?php if (!empty($producto['imagen'])): ?>
                                                    <img
                                                        src="<?= base_url('public/' . $producto['imagen']) ?>"
                                                        alt="<?= $producto['nombre'] ?>"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else: ?>
                                                    [Sin Imagen]
                                                <?php endif; ?>
                                            </td>

                                            <td><?= $producto['nombre'] ?></td>

                                            <td><?= $producto['nombre_categoria'] ?></td>

                                            <td>$<?= number_format($producto['precio'], 2) ?></td>
                                            <td><?= $producto['stock'] ?></td>

                                            <td>
                                                <a href="<?= base_url('admin/productos/editar/' . $producto['id_producto']) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

                                                <button type="button"
                                                    class="btn btn-danger btn-sm btn-eliminar-producto"
                                                    title="Eliminar"
                                                    data-id="<?= $producto['id_producto'] ?>"
                                                    data-nombre="<?= esc($producto['nombre']) ?>">
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
        const botones = document.querySelectorAll('.btn-eliminar-producto');

        botones.forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                const boton = this;
                const id = boton.dataset.id;
                const nombre = boton.dataset.nombre || 'producto';

                if (!confirm(`¿Seguro que deseas eliminar "${nombre}"? Esta acción no se puede deshacer.`)) {
                    return;
                }

                try {
                    const url = '<?= base_url('admin/productos/eliminar/') ?>' + id;

                    const body = new URLSearchParams();
                    body.append('_method', 'DELETE');
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
                        alert('✅ Producto eliminado correctamente.');
                    } else {
                        alert('⚠️ No se pudo eliminar el producto. ' + (data.message || ''));
                        console.error(data);
                    }
                } catch (err) {
                    console.error(err);
                    alert('❌ Error en la solicitud. Revisa la consola/Network.');
                }
            });
        });
    });
</script>