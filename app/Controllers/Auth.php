<?php

namespace App\Controllers;

use App\Models\usuarioModel;
use CodeIgniter\Session\Session;

class Auth extends BaseController{

    public function index(){

        return redirect()->to('/login');

    }

    public function perfil(){
        $session = session();
        $usuarioModel = new usuarioModel();

        $usuario = $usuarioModel->obtenerUsuarioPorId($session->get('id_usuario'));

        return view('auth/perfil', ['usuario' => $usuario]);
    }


    public function login(){
        $usuarioModel = new usuarioModel();
        $session = session();
        
        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

            $usuario = $usuarioModel->verificarCredenciales($postData['email'], $postData['clave']);

            if (!$usuario) {
                return view('auth/login', [
                    'errors' => ['email' => 'Email o contraseña incorrectos.'],
                    'datos'  => $postData
                ]);
            }

            $session->set([
                'email'     => $usuario['email'],
                'id_usuario'=> $usuario['id_usuario'],
                'logged_in' => true
            ]);

            return redirect()->to('/')->with('success', 'Sesión iniciada correctamente');
        }

        return view('auth/login');
    }

    public function crearUsuario(){
        $usuarioModel = new usuarioModel();
        $session = session();

        if (strtolower($this->request->getMethod()) === 'POST') {
            $postData = $this->request->getPost();

            $usuarioModel->setValidationRules($usuarioModel->registroRules);

            if (!$usuarioModel->validate($postData)) {
                return redirect()->back()->withInput()->with('errors', $usuarioModel->errors());
            }
            unset($postData['confirmClave']);
            $idInsertado = $usuarioModel->insertUsuario($postData);

            if (!$idInsertado) {
                return redirect()->back()->withInput()->with('errors', $usuarioModel->errors());
            }         

            $usuario = $usuarioModel->obtenerUsuarioPorId($idInsertado);

            $session->set([
                'email'     => $usuario['email'],
                'id_usuario'=> $usuario['id_usuario'],
                'logged_in' => true
            ]);

            return redirect()->to('/')->with('success', 'Usuario creado con éxito.');     

        }

        return view('auth/registro');
    }

    public function editarUsuario(){
        $usuarioModel = new UsuarioModel();
        $session = session();

        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        }

        $idUsuario = $session->get('id_usuario');

        if ($this->request->getMethod() === 'POST') {
            $postData = $this->request->getPost();

            $validation = \Config\Services::validation();

            $usuarioActual = $usuarioModel->find($idUsuario);

            $emailActual = strtolower(trim($usuarioActual['email']));
            $emailNuevo = strtolower(trim($postData['email']));

            $emailRule = 'required|valid_email';
            if ($emailNuevo !== $emailActual) {
                $emailRule .= '|is_unique[usuarios.email]';
            }

            $validation->setRules([
                'nombre'   => 'required|regex_match[/^[A-Za-zÀ-ÿ\s\.,\'-]+$/]',
                'email'    => $emailRule,
                'telefono' => 'permit_empty|regex_match[/^[0-9]{7,15}$/]'
            ]);

            if (!$validation->run($postData)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $validation->getErrors());
            }

            if (!$usuarioModel->update($idUsuario, [
                'nombre'   => $postData['nombre'],
                'email'    => $postData['email'],
                'telefono' => $postData['telefono'] ?? null
            ])) {
                return redirect()->back()->withInput()->with('errors', $usuarioModel->errors());
            }

            $session->set([
                'nombre'   => $postData['nombre'],
                'email'    => $postData['email'],
                'telefono' => $postData['telefono'] ?? null
            ]);

            return redirect()->to('/perfil')->with('success', 'Datos actualizados correctamente.');
        }

        $usuario = $usuarioModel->find($idUsuario);
        return view('auth/editarPerfil', ['usuario' => $usuario]);
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
