<?php
namespace App\Controllers;

use App\Models\productoModel;

class ProductoController extends BaseController
{
    public function index()
    {
        $productoModel = new productoModel();

        $data['personalizables'] = $productoModel
            ->whereIn('tipo', ['personalizable'])
            ->where('activo', 1)
            ->findAll();

        $data['tazas_magicas'] = $productoModel
            ->where('id_categoria', 6)
            ->where('activo', 1)
            ->findAll();

        $data['tazas_normales'] = $productoModel
            ->where('id_categoria', 1)
            ->where('activo', 1)
            ->findAll();

        return view('principal/pantalla_inicio', $data);
    }

    public function ver($id = null)
    {
        $productoModel = new productoModel();

        if (!$id) {
            return redirect()->to('/')->with('error', 'Producto no válido');
        }

        $producto = $productoModel->find($id);

        if ($producto) {
            return view('productos/producto', ['producto' => $producto]);
        }

        return redirect()->to('/')->with('error', 'Producto no encontrado');
    }
}
