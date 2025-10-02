<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'ProductoController::index');
$routes->get('/pantalla_inicio', 'ProductoController::index');

$routes->get('/contacto', 'Home::contacto');
$routes->match(['get', 'post'], '/contactar', 'Home::enviarContacto');


$routes->match(['get', 'post'], '/login', 'Auth::login');
$routes->match(['get', 'post'], '/registro', 'Auth::crearUsuario');
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);
$routes->match(['get','post'], '/editarPerfil', 'Auth::editarUsuario', ['filter' => 'auth']);
$routes->get('/perfil', 'Auth::perfil', ['filter' => 'auth']);

$routes->get('/producto/(:num)', 'ProductoController::ver/$1');
$routes->get('productos', 'ProductoController::index');

$routes->match(['get','post'],'/pedidos/crear', 'PedidosController::crear', ['filter' => 'auth']);
$routes->get('/pedidos', 'PedidosController::index', ['filter' => 'auth']);
$routes->match(['get','post'],'/pedidos/enviar', 'PedidosController::enviarPedido'); 
