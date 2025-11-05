<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6"><h3 class="mb-0"><?= $title ?? 'Carrusel Principal' ?></h3></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Carrusel</li>
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
                        <h3 class="card-title">Subir Nueva Imagen</h3>
                    </div>
                    
                    <?= form_open_multipart(base_url('admin/carrusel/subir'), ['id' => 'form-subir-carrusel']) ?>
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="imagen_carrusel">Seleccionar Imagen (JPG/PNG)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imagen_carrusel" name="imagen_carrusel" accept="image/jpeg,image/png" required>
                                    <label class="custom-file-label" for="imagen_carrusel">Elegir archivo...</label>
                                </div>
                            </div>
                            <small class="form-text text-muted">Recomendado: Imágenes grandes y optimizadas para web (ej: 1920x600px).</small>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"><i class="bi bi-upload"></i> Subir y Guardar</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Imágenes Activas y Orden</h3>
                        <small class="text-muted ml-2">Arrastra y suelta para cambiar el orden.</small>
                    </div>
                    <div class="card-body">
                        
                        <ul id="carrusel-list" class="list-group">
                            <?php if (empty($imagenes)): ?>
                                <li class="list-group-item text-center">No hay imágenes activas en el carrusel.</li>
                            <?php else: ?>
                                <?php foreach ($imagenes as $img): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?= $img->id ?>">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-grip-vertical handle-drag mr-2" style="cursor: grab;"></i>
                                            <img src="<?= base_url('public/uploads/carrusel/' . $img->nombre_archivo) ?>" alt="Imagen Carrusel" style="width: 100px; height: 50px; object-fit: cover;" class="img-thumbnail mr-3">
                                            <span>Orden: <?= $img->orden ?></span>
                                        </div>
                                        
                                        <div>
                                            <span class="badge text-bg-secondary mr-2">ID: <?= $img->id ?></span>
                                            <a href="<?= base_url('admin/carrusel/eliminar/' . $img->id) ?>" class="btn btn-danger btn-sm" title="Eliminar Imagen" onclick="return confirm('¿Está seguro de eliminar esta imagen?');"><i class="bi bi-trash"></i></a>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        
                        <div class="mt-3">
                            <button id="guardar-orden-btn" class="btn btn-success"><i class="bi bi-arrow-down-up"></i> Guardar Nuevo Orden</button>
                        </div>
                        
                    </div>
                    </div>
                </div>
        </div>
    </div>
</div>