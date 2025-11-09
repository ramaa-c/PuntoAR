<?php namespace App\Models;

use CodeIgniter\Model;

class ProductoImagenModel extends Model
{
    protected $table = 'producto_imagenes';
    protected $primaryKey = 'id';
    protected $returnType = 'array'; 
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_producto', 'ruta_imagen', 'orden'];
    
    protected $useTimestamps = false;
}