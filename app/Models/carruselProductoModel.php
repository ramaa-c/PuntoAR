<?php

namespace App\Models;

use CodeIgniter\Model;

class CarruselProductoModel extends Model
{
    protected $table = 'carrusel_productos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo', 'id_categoria', 'tipo', 'orden', 'limite'];
    protected $returnType = 'array';
    protected $useTimestamps = false;
}
