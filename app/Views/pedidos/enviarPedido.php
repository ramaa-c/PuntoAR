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
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $i => $p): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($p['imagen'])): ?>
                                        <img src="<?= esc($p['imagen']) ?>" alt="<?= esc($p['nombre']) ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    <?php else: ?>
                                        <span>[Sin Imagen]</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($p['nombre']) ?></td>
                                <td><?= esc($p['cantidad']) ?></td>
                                <td>$<?= number_format($p['precio'], 2, ',', '.') ?></td>
                                <td>$<?= number_format($p['precio'] * $p['cantidad'], 2, ',', '.') ?></td>
                                <td>
                                    <textarea name="productos[<?= $i ?>][especificaciones]" rows="2"></textarea>
                                </td>
                                <td>
                                    <input type="file" name="productos[<?= $i ?>][imagen]" accept="image/*">
                                </td>
                                <input type="hidden" name="productos[<?= $i ?>][id]" value="<?= $p['id'] ?>">
                                <input type="hidden" name="productos[<?= $i ?>][cantidad]" value="<?= $p['cantidad'] ?>">
                                <input type="hidden" name="productos[<?= $i ?>][precio]" value="<?= $p['precio'] ?>">
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
                <h3 class="card-title"><i class="fa-solid fa-palette"></i>  Cómo Personalizar</h3>
                <ul class="card-list">
                    <li>Elegí el talle.</li>
                    <li>Por mail te escribimos sobre la imagen elegida. Si tenés alguna especificación, escribila.</li>
                    <li>El valor incluye el estampado. (Puede haber un pequeño recargo para imágenes grandes/plenas sobre color).</li>
                    <li>Si la imagen no está en buena calidad, te avisaremos.</li>
                </ul>
            </div>

            <div class="info-card calidad-card">
                <h3 class="card-title"><i class="fa-solid fa-shirt"></i>    Calidad de la Prenda</h3>
                <ul class="card-list">
                    <li>Todas nuestras prendas son 100% algodón.</li>
                    <li>Remeras: jersey 24/1 con tapa costura.</li>
                    <li>Buzos: frisa de algodón.</li>
                    <li>Estampado en DTG (impresión directa a la prenda).</li>
                </ul>
            </div>

            <div class="info-card envio-card">
                <h3 class="card-title"><i class="fa-solid fa-truck-fast"></i>   Información de Envío</h3>
                <p>Envios a domicilio o retiro por local.</p>
                <p>Tiempo de Producción: 5 a 7 días hábiles.</p>
            </div>
            
        </div>

    </div>
</div>

<?= view('layout/footer') ?>