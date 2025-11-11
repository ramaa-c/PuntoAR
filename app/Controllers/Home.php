<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CarruselProductoModel;
use App\Models\ProductoModel;

class Home extends BaseController
{
    public function index()
    {
        $carruselProdModel = new CarruselProductoModel();
        $productoModel = new ProductoModel();

        $configuraciones = $carruselProdModel->orderBy('orden', 'asc')->findAll();

        $data['carruseles'] = [];

        foreach ($configuraciones as $conf) {

            $consulta = $productoModel->builder()
                ->select('productos.*, categorias.nombre AS nombre_categoria')
                ->join('categorias', 'categorias.id_categoria = productos.id_categoria')
                ->where('productos.activo', 1);

            if ((int)$conf['id_categoria'] > 0) {
                $consulta->where('productos.id_categoria', $conf['id_categoria']);
            }

            if (!empty($conf['tipo'])) {
                $consulta->where('productos.tipo', $conf['tipo']);
            }

            $productos = $consulta
                ->limit((int)$conf['limite'])
                ->get()
                ->getResultArray();

            $data['carruseles'][] = [
                'titulo' => $conf['titulo'],
                'productos' => $productos,
                'id_wrapper' => 'carrusel_' . $conf['id'],
            ];
        }
        return view('principal/pantalla_inicio', $data);
    }
    public function contacto(): string
    {
        return view('principal/contacto');
    }
    public function enviarContacto()
    {

        helper(['form', 'url']);
        $request = service('request');

        if ($request->getMethod() === 'POST') {
            $validation = \Config\Services::validation();

            $validation->setRules([
                'nombre'   => 'required|regex_match[/^[A-Za-zÀ-ÿ\s\.,\'-]+$/]',
                'email'    => 'required|valid_email',
                'telefono' => 'permit_empty|regex_match[/^[0-9]{7,15}$/]',
                'mensaje'  => 'required|min_length[10]',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            $email = \Config\Services::email();
            $email->setTo('raramiro.240@gmail.com');
            $email->setFrom($request->getPost('email'), $request->getPost('nombre'));
            $email->setSubject('Contacto desde PuntoAR');
            $email->setMessage(
                "Nombre: " . $request->getPost('nombre') . "\n" .
                    "Email: " . $request->getPost('email') . "\n" .
                    "Teléfono: " . $request->getPost('telefono') . "\n\n" .
                    "Mensaje:\n" . $request->getPost('mensaje')
            );

            if ($email->send()) {
                return redirect()->back()->with('success', '¡Mensaje enviado correctamente!');
            } else {
                return redirect()->back()->withInput()->with('errors', ['email' => 'No se pudo enviar el mensaje. Intenta más tarde.']);
            }
        }

        return view('principal/contacto');
    }
}
