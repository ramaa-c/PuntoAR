<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoDetalleModel extends Model
{
    protected $table            = 'pedidodetalle';
    protected $primaryKey       = 'id_detalle';
    protected $allowedFields    = [
        'id_pedido',
        'id_producto',
        'cantidad',
        'especificaciones',
        'precio_unitario',
        'detalleImagen',
        'nombre_producto',
        'imagen_personalizada'
    ];
    protected $useTimestamps    = false;
}
