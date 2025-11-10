<?php

namespace App\Models;

use CodeIgniter\Model;

class categoriaModel extends Model
{
    protected $table            = 'categorias';
    protected $primaryKey       = 'id_categoria';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nombre',
        'descripcion'
    ];

    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[100]',
        'descripcion' => 'permit_empty|string|max_length[255]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre de la categoría es obligatorio.',
            'is_unique' => 'Ya existe una categoría con ese nombre.',
        ]
    ];

    protected $useTimestamps = false;
}
