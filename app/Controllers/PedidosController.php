<?php

namespace App\Controllers;

use App\Models\pedidoModel;
use App\Models\pedidoDetalleModel;
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

    public function index()
    {
        $data['pedidos'] = $this->pedidoModel->findAll();
        return view('pedidos/index', $data);
    }

    public function crear(){
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para realizr un pedido.');
        }
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'id_usuario'       => $session->get('id_usuario'),
                'nombre_cliente'   => $session->get('nombre'),
                'email_cliente'    => $session->get('email'),
                'telefono_cliente' => $session->get('telefono') ?? null,
                'total'            => $this->request->getPost('total') ?? 0,
            ];

            $pedidoId = $this->pedidoModel->insert($data);

            $productos = $this->request->getPost('productos'); 
            $archivos  = $this->request->getFiles();

            if ($productos && is_array($productos)) {
                foreach ($productos as $i => $prod) {
                    $imagenPath = null;

                    if (isset($archivos['productos'][$i]['imagen']) && $archivos['productos'][$i]['imagen']->isValid()) {
                        $file = $archivos['productos'][$i]['imagen'];
                        $newName = $file->getRandomName();
                        $file->move(FCPATH . 'uploads/pedidos', $newName);
                        $imagenPath = 'uploads/pedidos/' . $newName;
                    }

                    $this->detalleModel->insert([
                        'id_pedido'       => $pedidoId,
                        'id_producto'     => $prod['id'],
                        'cantidad'        => $prod['cantidad'],
                        'especificaciones'=> $prod['especificaciones'] ?? null,
                        'precio_unitario' => $prod['precio'],
                        'detalleImagen'   => $imagenPath
                    ]);
                }
            }

            $this->enviarEmailConfirmacion( $pedidoId);

            return redirect()->to('/')->with('msg', 'Pedido enviado correctamente.');
        }

        return redirect()->to('/')->with('error', 'Acción inválida');
    }

    protected function enviarEmailConfirmacion($pedidoId)
    {
        $pedido   = $this->pedidoModel->find($pedidoId);
        $detalles = $this->detalleModel->where('id_pedido', $pedidoId)->findAll();

        $mensaje  = "<h2>Nuevo Pedido #{$pedido['id_pedido']}</h2>";
        $mensaje .= "<p><b>Cliente:</b> {$pedido['nombre_cliente']} ({$pedido['email_cliente']})</p>";
        $mensaje .= "<p><b>Total:</b> $ {$pedido['total']}</p>";
        $mensaje .= "<p><b>Estado:</b> {$pedido['estado']}</p>";
        $mensaje .= "<h3>Detalles:</h3>";
        $mensaje .= "<ul>";

        foreach ($detalles as $d) {
            $mensaje .= "<li>Producto ID {$d['id_producto']} - Cant: {$d['cantidad']} - $ {$d['precio_unitario']}";
            if (!empty($d['especificaciones'])) {
                $mensaje .= "<br><b>Especificaciones:</b> {$d['especificaciones']}";
            }
            if (!empty($d['detalleImagen'])) {
                $mensaje .= "<br><img src='" . base_url($d['detalleImagen']) . "' width='120'>";
            }
            $mensaje .= "</li><br>";
        }
        $mensaje .= "</ul>";

        $this->email->setTo('raramiro.240@gmail.com');
        $this->email->setFrom('no-reply@puntoar.com', 'Sistema PuntoAR');
        $this->email->setSubject("Nuevo pedido recibido #{$pedido['id_pedido']}");
        $this->email->setMailType('html');
        $this->email->setMessage($mensaje);
        $this->email->send();
    }

    public function enviarPedido(){
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para enviar un pedido.');
        }

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
