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
        'id_categoria' => 'permit_empty|integer',
        'imagen'      => 'permit_empty|string',
        'tipo'        => 'in_list[estandar,personalizable]',
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

    public function getProductosConCategoria()
    {
        return $this->select('productos.*, categorias.nombre AS nombre_categoria')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria')
            ->findAll();
    }

    public function getProductosFiltrados($categoriaId = null, $tipo = null, $texto = null)
    {
        $builder = $this->select('productos.*, categorias.nombre AS nombre_categoria')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
            ->where('productos.activo', 1); // solo productos activos

        // Filtro por categoría
        if (!empty($categoriaId)) {
            $builder->where('productos.id_categoria', $categoriaId);
        }

        // Filtro por tipo (estandar / personalizable)
        if (!empty($tipo)) {
            $builder->where('productos.tipo', $tipo);
        }

        // Filtro por texto (nombre o descripción)
        if (!empty($texto)) {
            $builder->groupStart()
                ->like('productos.nombre', $texto)
                ->orLike('productos.descripcion', $texto)
                ->groupEnd();
        }

        return $builder->findAll();
    }
}
