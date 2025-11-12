<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table      = 'banners_carrusel';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'ruta_imagen',
        'titulo',
        'enlace',
        'orden'
    ];

    public function getMaxOrden(): int
    {
        $result = $this->selectMax('orden')->first();
        return (int) ($result['orden'] ?? 0);
    }

    public function createBanner(array $data)
    {
        $data['orden'] = $this->getMaxOrden() + 1;
        return $this->insert($data);
    }
}
