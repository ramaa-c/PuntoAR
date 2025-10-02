<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('principal/pantalla_inicio');
    }
    public function contacto(): string
    {
        return view('principal/contacto');
    }
    public function enviarContacto(){

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
