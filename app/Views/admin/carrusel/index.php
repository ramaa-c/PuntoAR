<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0"><?= $title ?? 'Gestión de Banners Principales' ?></h3>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header"><h3 class="card-title">Subir Nuevo Banner</h3></div>
                    
                    <?= form_open_multipart(base_url('admin/carrusel/subir'), ['id' => 'form-subir-banner']) ?>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="imagen_banner">Seleccionar Banner (JPG/PNG)</label>
                            <input type="file" class="form-control" id="imagen_banner" name="imagen_banner" accept="image/jpeg,image/png" required>
                            <small class="form-text text-muted">Asegúrate de que la imagen sea de alta resolución para la web.</small>
                        </div>
                        </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="bi bi-upload"></i> Subir Banner</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Banners Activos</h3></div>
                    <div class="card-body">
                        
                        <div class="row">
                            <?php if (empty($imagenes)): ?>
                                <p class="text-muted text-center">No hay banners activos.</p>
                            <?php else: ?>
                                <?php foreach ($imagenes as $img): ?>
                                    <div class="col-md-4 mb-3 d-flex flex-column align-items-center" data-id="<?= $img['id'] ?>">
                                        <img src="<?= base_url('public/' . $img['ruta_imagen']) ?>" 
                                             alt="Banner #<?= $img['orden'] ?>" 
                                             class="img-fluid border mb-2" 
                                             style="height: 100px; object-fit: cover;">
                                        
                                        <small class="text-muted">Orden: <?= $img['orden'] ?></small>
                                        
                                        <button type="button" 
                                                class="btn btn-danger btn-sm btn-eliminar-banner mt-2" 
                                                data-id="<?= $img['id'] ?>">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-eliminar-banner').forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const idBanner = this.getAttribute('data-id');
            const row = this.closest('.col-md-4');
            
            if (confirm('¿Seguro de eliminar este banner?')) {
                fetch('<?= base_url('admin/carrusel/eliminar_banner/') ?>' + idBanner, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest', '<?= csrf_header() ?>': '<?= csrf_hash() ?>' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove();
                        alert('Banner eliminado.');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => { alert('Fallo en la solicitud.'); });
            }
        });
    });
});
</script>