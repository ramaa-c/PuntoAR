<?php

namespace App\Models;

use CodeIgniter\Model;

class productoModel extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id_producto';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'id_categoria',
        'imagen',
        'tipo',
        'activo'
    ];

    protected $validationRules = [
        'nombre'      => 'required|min_length[3]|max_length[150]',
        'descripcion' => 'permit_empty|string',
        'precio'      => 'required|decimal',
        'stock'       => 'required|is_natural',
        'id_categoria'=> 'permit_empty|integer',
        'imagen'      => 'permit_empty|valid_url_strict',
        'tipo'        => 'in_list[estandar,personalizable_simple,personalizable_complejo]',
        'activo'      => 'in_list[0,1]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required'    => 'El nombre es obligatorio.',
            'min_length'  => 'El nombre debe tener al menos 3 caracteres.',
            'max_length'  => 'El nombre no puede superar los 150 caracteres.'
        ],
        'precio' => [
            'required' => 'El precio es obligatorio.',
            'decimal'  => 'El precio debe ser un número decimal válido.'
        ],
        'stock' => [
            'required'    => 'El stock es obligatorio.',
            'is_natural'  => 'El stock debe ser un número natural (0 o mayor).'
        ],
        'imagen' => [
            'valid_url_strict' => 'La URL de la imagen no es válida.'
        ],
        'tipo' => [
            'in_list' => 'El tipo debe ser estandar, personalizable_simple o personalizable_complejo.'
        ],
        'activo' => [
            'in_list' => 'El estado activo solo puede ser 0 o 1.'
        ]
    ];
}
