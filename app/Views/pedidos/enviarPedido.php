<?= view('layout/header', ['titulo' => 'Enviar Pedido - PuntoAR', 'estilos' => ['pedido.css']]) ?>
<?= view('layout/navbar') ?>

<div class="pedido-container">
    <h1>Confirmar Pedido</h1>

    <div class="pedido-content-wrapper">

        <div class="pedido-left-panel">
            <form action="<?= base_url('/pedidos/crear') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <table class="pedido-tabla">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                            <th>Especificaciones</th>
                            <th>Imagen Personalizada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $i => $p): ?>
                            <tr>
                                <!-- 🖼️ Imagen + nombre -->
                                <td style="display: flex; align-items: center; gap: 8px;">
                                    <?php if (!empty($p['imagen'])): ?>
                                        <img
                                            src="<?= base_url('public/' . $p['imagen']) ?>"
                                            alt="<?= esc($p['nombre']) ?>"
                                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                    <?php else: ?>
                                        <span>[Sin Imagen]</span>
                                    <?php endif; ?>
                                    <span><?= esc($p['nombre']) ?></span>
                                </td>

                                <!-- 📦 Cantidad -->
                                <td><?= esc($p['cantidad']) ?></td>

                                <!-- 💰 Precio -->
                                <td>$<?= number_format($p['precio'], 2, ',', '.') ?></td>

                                <!-- 🧮 Subtotal -->
                                <td>$<?= number_format($p['precio'] * $p['cantidad'], 2, ',', '.') ?></td>

                                <!-- 📝 Especificaciones -->
                                <td>
                                    <textarea
                                        name="productos[<?= $i ?>][especificaciones]"
                                        rows="2"
                                        placeholder="Ej: color, ubicación, texto adicional..."></textarea>
                                </td>

                                <!-- 📸 Imagen personalizada -->
                                <td style="text-align:center;">
                                    <?php if (isset($p['tipo']) && strtolower($p['tipo']) === 'personalizable'): ?>
                                        <div style="display: flex; flex-direction: column; align-items: center; gap: 4px;">
                                            <input
                                                type="file"
                                                name="productos[<?= $i ?>][imagen_personalizada]"
                                                accept="image/*"
                                                class="input-imagen-personalizada"
                                                data-preview="preview-<?= $i ?>">
                                            <img
                                                id="preview-<?= $i ?>"
                                                src=""
                                                alt="Vista previa"
                                                style="display:none; width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                                        </div>
                                    <?php else: ?>
                                        <span style="color:#777;">No aplica</span>
                                    <?php endif; ?>
                                </td>


                                <!-- Campos ocultos -->
                                <input type="hidden" name="productos[<?= $i ?>][id]" value="<?= esc($p['id']) ?>">
                                <input type="hidden" name="productos[<?= $i ?>][nombre]" value="<?= esc($p['nombre']) ?>">
                                <input type="hidden" name="productos[<?= $i ?>][cantidad]" value="<?= esc($p['cantidad']) ?>">
                                <input type="hidden" name="productos[<?= $i ?>][precio]" value="<?= esc($p['precio']) ?>">
                                <input type="hidden" name="productos[<?= $i ?>][imagen]" value="<?= esc($p['imagen']) ?>">
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="pedido-footer-actions">
                    <p class="pedido-total"><b>Total: $<?= number_format($total, 2, ',', '.') ?></b></p>
                    <button type="submit" class="main-action-btn">Enviar Pedido</button>
                </div>

            </form>
        </div>

        <div class="pedido-info-panel">
            <div class="info-card personalizacion-card">
                <h3 class="card-title"><i class="fa-solid fa-palette"></i> Cómo Personalizar</h3>
                <ul class="card-list">
                    <li>Elegí el talle.</li>
                    <li>Por mail te escribimos sobre la imagen elegida. Si tenés alguna especificación, escribila.</li>
                    <li>Si la imagen no está en buena calidad, te avisaremos.</li>
                </ul>
            </div>

        </div>
    </div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.input-imagen-personalizada').forEach(input => {
            input.addEventListener('change', e => {
                const file = e.target.files[0];
                const previewId = e.target.dataset.preview;
                const preview = document.getElementById(previewId);

                if (file) {
                    const reader = new FileReader();
                    reader.onload = e2 => {
                        preview.src = e2.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        });
    });
</script>
<?= view('layout/footer') ?>