<?php

namespace App\Controllers;

use App\Models\productoModel;
use App\Models\categoriaModel;
use App\Models\ProductoImagenModel;

class ProductoController extends BaseController
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();


        $productos = $productoModel->getProductosFiltrados();

        $totalProductos = $productoModel->countAllResults();

        $categorias = $categoriaModel
            ->select('nombre, id_categoria')
            ->orderBy('nombre', 'asc')
            ->findAll();

        $data = [
            'title'      => 'Catálogo de Productos',
            'productos'  => $productos,
            'categorias' => $categorias,
            'totalProductos'  => $totalProductos,
        ];

        return view('productos/catalogo', $data);
    }

    public function filtrar()
    {
        $productoModel = new productoModel();

        $categorias = $this->request->getPost('categorias');
        $tipo = $this->request->getPost('tipo');
        $q = $this->request->getPost('q');
        $orden = $this->request->getPost('orden');

        $builder = $productoModel
            ->select('productos.*, categorias.nombre AS nombre_categoria')
            ->join('categorias', 'categorias.id_categoria = productos.id_categoria', 'left')
            ->where('productos.activo', 1);

        if (!empty($categorias)) {
            if (is_string($categorias)) {
                $categoriasArr = array_filter(array_map('intval', explode(',', $categorias)));
            } elseif (is_array($categorias)) {
                $categoriasArr = array_map('intval', $categorias);
            } else {
                $categoriasArr = [];
            }

            if (!empty($categoriasArr)) {
                $builder->whereIn('productos.id_categoria', $categoriasArr);
            }
        }

        if (!empty($tipo)) {
            $builder->where('productos.tipo', $tipo);
        }

        if (!empty($q)) {
            $builder->groupStart()
                ->like('productos.nombre', $q)
                ->orLike('productos.descripcion', $q)
                ->groupEnd();
        }

        switch ($orden) {
            case 'nombre-asc':
                $builder->orderBy('productos.nombre', 'ASC');
                break;
            case 'nombre-desc':
                $builder->orderBy('productos.nombre', 'DESC');
                break;
            case 'precio-asc':
                $builder->orderBy('productos.precio', 'ASC');
                break;
            case 'precio-desc':
                $builder->orderBy('productos.precio', 'DESC');
                break;
            case 'fecha-asc':
                $builder->orderBy('productos.id_producto', 'ASC');
                break;
            case 'fecha-desc':
                $builder->orderBy('productos.id_producto', 'DESC');
                break;
            default:
                $builder->orderBy('productos.id_producto', 'DESC');
                break;
        }

        $productos = $builder->findAll();

        foreach ($productos as &$p) {
            if (!empty($p['imagen'])) {
                $p['imagen'] = base_url('public/' . $p['imagen']);
            } else {
                $p['imagen'] = base_url('public/images/placeholder.png');
            }
        }

        $total = count($productos);

        $this->response->setHeader('X-Total-Count', (string) $total);
        return $this->response->setJSON($productos);
    }



    public function ver(?int $id = null)
    {
        $productoModel = new ProductoModel();
        $productoImagenModel = new ProductoImagenModel();

        if (empty($id)) {
            return redirect()->to('/')->with('error', 'Producto no válido');
        }

        $producto = $productoModel->find($id);

        if ($producto) {

            $imagenesGaleria = $productoImagenModel
                ->where('id_producto', $id)
                ->orderBy('orden', 'asc')
                ->findAll();

            return view('productos/producto', [
                'producto' => $producto,
                'imagenesGaleria' => $imagenesGaleria
            ]);
        }

        return redirect()->to('/')->with('error', 'Producto no encontrado');
    }
}
