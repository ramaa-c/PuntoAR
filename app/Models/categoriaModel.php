<?php namespace App\Models;

use CodeIgniter\Model;

class categoriaModel extends Model
{
    protected $table            = 'categorias';
    protected $primaryKey       = 'id_categoria'; // Usamos tu campo ID
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    // Campos permitidos para inserción/actualización
    protected $allowedFields = [
        'nombre', 
        'descripcion', 
        'tipo'
    ];

    // Reglas de validación para el formulario de creación/edición
    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[100]|is_unique[categorias.nombre,id_categoria,{id_categoria}]',
        'descripcion' => 'permit_empty',
        'tipo' => 'permit_empty|in_list[general,evento,combo]',
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre de la categoría es obligatorio.',
            'is_unique' => 'Ya existe una categoría con ese nombre.',
        ],
        'tipo' => [
            'in_list' => 'El tipo de categoría no es válido.',
        ],
    ];

    // Desactivar Timestamps ya que no están en tu tabla
    protected $useTimestamps = false;
}