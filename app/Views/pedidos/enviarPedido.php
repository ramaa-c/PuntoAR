<?= view('layout/header', ['titulo' => 'Enviar Pedido - PuntoAR', 'estilos' => ['pedido.css']]) ?>
<?= view('layout/navbar') ?>

<div class="pedido-container">
    <h1>Confirmar Pedido</h1>

    <div class="pedido-content-wrapper">

        <div class="pedido-left-panel">
            <!-- MOVÍ los datos del cliente DENTRO del mismo <form> -->
            <form action="<?= base_url('/pedidos/crear') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <?php $sess = session(); ?>

                <!-- Si no está logueado mostramos el form para completar -->
                <?php if (! $sess->get('logged_in')): ?>
                    <div class="cliente-form-wrapper">
                        <div class="cliente-form">
                            <h3>Datos del Cliente</h3>

                            <div class="form-group">
                                <label for="nombre_cliente">Nombre *</label>
                                <input type="text" id="nombre_cliente" name="nombre_cliente"
                                    value="<?= esc(old('nombre_cliente') ?? '') ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email_cliente">Email *</label>
                                <input type="email" id="email_cliente" name="email_cliente"
                                    value="<?= esc(old('email_cliente') ?? '') ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="telefono_cliente">Teléfono (opcional)</label>
                                <input type="text" id="telefono_cliente" name="telefono_cliente"
                                    value="<?= esc(old('telefono_cliente') ?? '') ?>">
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Si está logueado, agrego campos hidden con los datos de sesión
                         (esto hace explícito lo que se envía y evita dependencia implícita) -->
                    <input type="hidden" name="nombre_cliente" value="<?= esc($sess->get('nombre')) ?>">
                    <input type="hidden" name="email_cliente" value="<?= esc($sess->get('email')) ?>">
                    <input type="hidden" name="telefono_cliente" value="<?= esc($sess->get('telefono') ?? '') ?>">
                <?php endif; ?>

                <div class="pedido-tabla-wrapper">
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

                        <tbody class="<?= count($productos) >= 5 ? 'scroll-tbody' : '' ?>">
                            <?php foreach ($productos as $i => $p): ?>
                                <tr>
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

                                    <td><?= esc($p['cantidad']) ?></td>

                                    <td>$<?= number_format($p['precio'], 2, ',', '.') ?></td>

                                    <td>$<?= number_format($p['precio'] * $p['cantidad'], 2, ',', '.') ?></td>

                                    <td>
                                        <textarea
                                            name="productos[<?= $i ?>][especificaciones]"
                                            rows="2"
                                            placeholder="Escriba aquí..."></textarea>
                                    </td>

                                    <td style="text-align:center;">
                                        <?php if (isset($p['tipo']) && strtolower($p['tipo']) === 'personalizable'): ?>
                                            <div class="input-img">

                                                <input
                                                    type="file"
                                                    name="productos[<?= $i ?>][imagen]"
                                                    accept="image/*"
                                                    class="input-imagen-personalizada"
                                                    id="file-<?= $i ?>"
                                                    data-preview="preview-<?= $i ?>"
                                                    style="display:none">

                                                <button type="button"
                                                    class="btn-upload"
                                                    data-target="file-<?= $i ?>">
                                                    <i class="fa-solid fa-image"></i>
                                                </button>

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

                                    <!-- Campos ocultos: envio de datos del producto -->
                                    <input type="hidden" name="productos[<?= $i ?>][id]" value="<?= esc($p['id']) ?>">
                                    <input type="hidden" name="productos[<?= $i ?>][nombre]" value="<?= esc($p['nombre']) ?>">
                                    <input type="hidden" name="productos[<?= $i ?>][cantidad]" value="<?= esc($p['cantidad']) ?>">
                                    <input type="hidden" name="productos[<?= $i ?>][precio]" value="<?= esc($p['precio']) ?>">
                                    <!-- imagen original como ruta relativa (sin base_url), el controller ya lo maneja -->
                                    <?php if (!empty($p['imagen'])): ?>
                                        <input type="hidden"
                                            name="productos[<?= $i ?>][imagen_original]"
                                            value="<?= esc($p['imagen']) ?>">
                                    <?php endif; ?>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pedido-footer-actions">
                    <p class="pedido-total"><b>Total: $<?= number_format($total, 2, ',', '.') ?></b></p>
                    <input type="hidden" name="total" value="<?= $total ?>">
                    <button type="submit" class="main-action-btn-pedido">Enviar Pedido</button>
                </div>

            </form>
        </div>

        <div class="pedido-info-panel">
            <div class="info-card personalizacion-card">
                <h3 class="card-title"><i class="fa-solid fa-palette"></i> Cómo Personalizar</h3>
                <ul class="card-list">
                    <li>Para prendas debe especificar el talle.</li>
                    <li>Te escribiremos por mail sobre la imagen subida.</li>
                    <li>Si la imagen no tiene buena calidad, te avisaremos.</li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('.btn-upload').forEach(btn => {
            btn.addEventListener('click', () => {
                const target = document.getElementById(btn.dataset.target);
                if (target) target.click();
            });
        });

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

        const rows = document.querySelectorAll(".pedido-tabla tbody tr").length;
        if (rows > 5) {
            document.querySelector(".pedido-tabla-wrapper").classList.add("scroll");
        }

    });
</script>

<?= view('layout/footer') ?>