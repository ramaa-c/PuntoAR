<?php

namespace App\Models;

use CodeIgniter\Model;

class pedidoModel extends Model
{
    protected $table            = 'pedidos';
    protected $primaryKey       = 'id_pedido';
    protected $allowedFields    = [
        'id_usuario',
        'fecha',
        'estado',
        'requiere_contacto',
        'nombre_cliente',
        'email_cliente',
        'telefono_cliente',
        'total'
    ];
    protected $useTimestamps    = false;
}
