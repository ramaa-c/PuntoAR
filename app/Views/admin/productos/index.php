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
                                    <th style="width: 10%">Estado</th>
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
                                                <span class="badge text-bg-<?= ($producto['activo'] == 1 ? 'success' : 'danger') ?>">
                                                    <?= $producto['activo'] == 1 ? 'Activo' : 'Inactivo' ?>
                                                </span>
                                            </td>

                                            <td>
                                                <a href="<?= base_url('admin/productos/editar/' . $producto['id_producto']) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="bi bi-pencil"></i></a>

                                                <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    title="Eliminar"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEliminar"
                                                    data-id="<?= $producto['id_producto'] ?>"
                                                    data-nombre="<?= $producto['nombre'] ?>">
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
<div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro de que desea eliminar permanentemente el producto **<span id="nombreProductoEliminar"></span>**? Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <form id="formEliminar" method="POST" action="">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE" /> <button type="submit" class="btn btn-danger">Sí, Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalEliminar = document.getElementById('modalEliminar');
        modalEliminar.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            const idProducto = button.getAttribute('data-id');
            const nombreProducto = button.getAttribute('data-nombre');

            const nombreSpan = modalEliminar.querySelector('#nombreProductoEliminar');
            nombreSpan.textContent = nombreProducto;

            const form = modalEliminar.querySelector('#formEliminar');
            form.action = '<?= base_url('admin/productos/eliminar/') ?>' + idProducto;
        });
    });
</script>