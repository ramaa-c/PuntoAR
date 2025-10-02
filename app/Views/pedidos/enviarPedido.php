<?= view('layout/header', ['titulo' => 'Enviar Pedido - PuntoAR', 'estilos' => ['pedido.css']]) ?>
<?= view('layout/navbar') ?>

<div class="pedido-container">
    <h1>Confirmar Pedido</h1>

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

        <p class="pedido-total"><b>Total: $<?= number_format($total, 2, ',', '.') ?></b></p>

        <button type="submit" class="main-action-btn">Enviar Pedido</button>
    </form>
</div>

<?= view('layout/footer') ?>
