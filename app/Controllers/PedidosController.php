<?php

namespace App\Controllers;

use App\Models\pedidoModel;
use App\Models\pedidoDetalleModel;
use App\Models\productoModel;
use CodeIgniter\Controller;

class PedidosController extends Controller
{
    protected $pedidoModel;
    protected $detalleModel;
    protected $email;

    public function __construct()
    {
        $this->pedidoModel  = new pedidoModel();
        $this->detalleModel = new pedidoDetalleModel();
        $this->email        = \Config\Services::email();
    }

    public function crear()
    {
        $session = session();

        if ($this->request->getMethod() !== 'POST') {
            return redirect()->to('/')->with('error', 'Acción inválida');
        }

        // DATOS DEL CLIENTE
        if ($session->get('logged_in')) {
            $nombre    = $session->get('nombre');
            $email     = $session->get('email');
            $telefono  = $session->get('telefono');
            $idUsuario = $session->get('id_usuario');
        } else {
            $nombre    = trim($this->request->getPost('nombre_cliente'));
            $email     = trim($this->request->getPost('email_cliente'));
            $telefono  = trim($this->request->getPost('telefono_cliente'));
            $idUsuario = null;
        }

        if (empty($nombre) || empty($email)) {
            return redirect()->back()->with('error', 'Debe completar su nombre y correo electrónico.');
        }

        // CREAR PEDIDO
        $pedidoData = [
            'id_usuario'       => $idUsuario,
            'nombre_cliente'   => $nombre,
            'email_cliente'    => $email,
            'telefono_cliente' => $telefono ?: null,
            'total'            => $this->request->getPost('total') ?? 0,
        ];

        $pedidoId = $this->pedidoModel->insert($pedidoData);

        // PRODUCTOS DEL FORM
        $productos = $this->request->getPost('productos');
        $files     = $this->request->getFiles();

        if (!$productos || !is_array($productos)) {
            return redirect()->back()->with('error', 'No se enviaron productos válidos.');
        }

        $productoModel = new productoModel();


        // ===================================================
        // INSERTAR DETALLES DEL PEDIDO
        // ===================================================
        foreach ($productos as $i => $prod) {

            $productoBD = null;
            $nombreProducto = $prod['nombre'] ?? null;
            $imagenPrincipal = null;

            // OBTENER INFO DESDE BD SI NO VINO
            if (empty($nombreProducto) && !empty($prod['id'])) {

                $productoBD = $productoModel->find((int)$prod['id']);

                if ($productoBD) {
                    $nombreProducto = $productoBD['nombre'];

                    if (empty($prod['imagen_original']) && !empty($productoBD['imagen'])) {
                        $prod['imagen_original'] = $productoBD['imagen'];
                    }
                }
            }

            // SUBIR ARCHIVO PERSONALIZADO
            $subidaPorUsuario = 0;

            if (
                isset($files['productos'][$i]['imagen']) &&
                $files['productos'][$i]['imagen']->isValid() &&
                !$files['productos'][$i]['imagen']->hasMoved()
            ) {
                $file = $files['productos'][$i]['imagen'];
                $newName = $file->getRandomName();

                $file->move(FCPATH . 'public/uploads/pedidos', $newName);

                $imagenPrincipal = 'uploads/pedidos/' . $newName;
                $subidaPorUsuario = 1; // <-- IMPORTANTE
            } else {
                // SI NO SUBIÓ IMAGEN PERSONALIZADA, USAR LA ORIGINAL O BD
                if (!empty($prod['imagen_original'])) {

                    $img = $prod['imagen_original'];
                    $img = str_replace(base_url(), '', $img);
                    $imagenPrincipal = ltrim($img, '/');
                } elseif (!empty($productoBD['imagen'])) {

                    $imagenPrincipal = ltrim($productoBD['imagen'], '/');
                }
            }

            // GUARDAR DETALLE
            $this->detalleModel->insert([
                'id_pedido'           => $pedidoId,
                'id_producto'         => $prod['id'],
                'nombre_producto'     => $nombreProducto,
                'cantidad'            => $prod['cantidad'],
                'especificaciones'    => $prod['especificaciones'] ?? null,
                'precio_unitario'     => $prod['precio'],
                'detalleImagen'       => $imagenPrincipal,
                'imagen_personalizada' => $subidaPorUsuario,   // <-- NUEVO CAMPO
            ]);
        }

        // ENVIAR EMAIL
        $this->enviarEmailConfirmacion($pedidoId);

        return redirect()->to('/')->with('msg', 'Pedido enviado correctamente.');
    }


    // ===================================================
    // EMAIL
    // ===================================================
    protected function enviarEmailConfirmacion($pedidoId)
    {
        $pedido   = $this->pedidoModel->find($pedidoId);
        $detalles = $this->detalleModel->where('id_pedido', $pedidoId)->findAll();

        $mensaje  = "<h2>Nuevo Pedido #{$pedido['id_pedido']}</h2>";
        $mensaje .= "<p><b>Cliente:</b> " . esc($pedido['nombre_cliente']) . " (" . esc($pedido['email_cliente']) . ")</p>";
        $mensaje .= "<p><b>Total:</b> $ {$pedido['total']}</p>";
        $mensaje .= "<h3>Detalles:</h3><ul>";

        foreach ($detalles as $d) {

            $nombreProd = !empty($d['nombre_producto'])
                ? esc($d['nombre_producto'])
                : ('Producto #' . esc($d['id_producto']));

            $mensaje .= "<li>
                <b>Producto:</b> {$nombreProd}<br>
                <b>Cantidad:</b> {$d['cantidad']}<br>
                <b>Precio:</b> $ {$d['precio_unitario']}<br>";

            // SOLO MOSTRAR IMAGEN PERSONALIZADA REAL
            if (!empty($d['detalleImagen']) && !empty($d['imagen_personalizada'])) {

                $filename = basename($d['detalleImagen']);

                $mensaje .= "<b>Imagen adjunta:</b> {$filename}<br>";

                // Adjuntar la imagen real
                $adjunto = FCPATH . 'public/' . ltrim($d['detalleImagen'], '/');

                if (is_file($adjunto)) {
                    $this->email->attach($adjunto);
                }
            }

            $mensaje .= "</li><br>";
        }

        $mensaje .= "</ul>";

        $this->email->setTo('puntoar.contact@gmail.com');
        $this->email->setFrom('no-reply@puntoar.com', 'Sistema PuntoAR');
        $this->email->setSubject("Nuevo pedido recibido #{$pedido['id_pedido']}");
        $this->email->setMailType('html');
        $this->email->setMessage($mensaje);
        $this->email->send();
    }

    public function enviarPedido()
    {
        $productos = $this->request->getPost('productos');

        if (!$productos || !is_array($productos)) {
            return redirect()->to('/')->with('error', 'No se encontraron productos para el pedido.');
        }

        $total = 0;
        foreach ($productos as &$p) {
            $total += $p['precio'] * $p['cantidad'];
        }

        return view('pedidos/enviarPedido', [
            'productos' => $productos,
            'total'     => $total
        ]);
    }
}
