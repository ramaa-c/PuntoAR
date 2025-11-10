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
            <!-- Formulario para nueva categoría -->
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

            <!-- Tabla de categorías -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categorías Existentes</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="tablaCategorias">
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
                                        <td colspan="4" class="text-center">No hay categorías registradas.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($categorias as $cat): ?>
                                        <tr data-id="<?= $cat['id_categoria'] ?>" data-nombre="<?= esc($cat['nombre']) ?>" data-descripcion="<?= esc($cat['descripcion'] ?? '') ?>">
                                            <td><?= $cat['id_categoria'] ?></td>
                                            <td class="col-nombre"><?= esc($cat['nombre']) ?></td>
                                            <td class="col-descripcion"><?= empty($cat['descripcion']) ? '—' : esc(substr($cat['descripcion'], 0, 50)) . (strlen($cat['descripcion']) > 50 ? '...' : '') ?></td>
                                            <td>
                                                <button class="btn btn-warning btn-sm btnEditar" title="Editar"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm btnEliminar" title="Eliminar"><i class="bi bi-trash"></i></button>
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

<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditarCategoria">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalEditarCategoriaLabel"><i class="bi bi-pencil"></i> Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id_categoria" name="id_categoria">

                    <div class="form-group">
                        <label for="edit_nombre">Nombre</label>
                        <input type="text" id="edit_nombre" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group mt-2">
                        <label for="edit_descripcion">Descripción</label>
                        <textarea id="edit_descripcion" name="descripcion" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {

    // === ELIMINAR CATEGORÍA ===
    document.querySelectorAll(".btnEliminar").forEach(btn => {
        btn.addEventListener("click", async (e) => {
            const fila = e.target.closest("tr");
            const id = fila.dataset.id;
            const nombre = fila.dataset.nombre;

            if (!confirm(`¿Seguro que deseas eliminar la categoría "${nombre}"?`)) return;

            try {
                const resp = await fetch(`<?= base_url('admin/categorias/eliminar/') ?>${id}`, {
                    method: "POST",
                    headers: { "X-Requested-With": "XMLHttpRequest" }
                });
                const data = await resp.json();

                if (data.success) {
                    alert("✅ Categoría eliminada correctamente.");
                    fila.remove();
                } else {
                    alert(data.message || "⚠️ No se pudo eliminar la categoría.");
                }
            } catch (err) {
                alert("⚠️ Error al eliminar la categoría.");
                console.error(err);
            }
        });
    });

    // === EDITAR CATEGORÍA ===
    const modalEl = document.getElementById("modalEditarCategoria");
    const modalInstance = new bootstrap.Modal(modalEl);
    const formEditar = document.getElementById("formEditarCategoria");

    document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", (e) => {
            const fila = e.target.closest("tr");
            document.getElementById("edit_id_categoria").value = fila.dataset.id;
            document.getElementById("edit_nombre").value = fila.dataset.nombre;
            document.getElementById("edit_descripcion").value = fila.dataset.descripcion;
            modalInstance.show();
        });
    });

    formEditar.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = document.getElementById("edit_id_categoria").value;
        const formData = new FormData(formEditar);

        try {
            const resp = await fetch(`<?= base_url('admin/categorias/editar/') ?>${id}`, {
                method: "POST",
                body: formData,
                headers: { "X-Requested-With": "XMLHttpRequest" }
            });

            const data = await resp.json();

            if (data.success) {
                alert("✅ Categoría actualizada correctamente.");

                modalInstance.hide();

                const fila = document.querySelector(`tr[data-id="${id}"]`);
                if (fila) {
                    const nombre = formData.get("nombre");
                    const descripcion = formData.get("descripcion") || "—";

                    fila.dataset.nombre = nombre;
                    fila.dataset.descripcion = descripcion;
                    fila.querySelector(".col-nombre").textContent = nombre;
                    fila.querySelector(".col-descripcion").textContent = descripcion;
                }
            } else {
                alert(data.message || "⚠️ No se pudo actualizar la categoría.");
            }

        } catch (err) {
            alert("⚠️ Error al editar la categoría.");
            console.error(err);
        }
    });
});
</script>