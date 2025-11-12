<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/pantalla_inicio', 'ProductoController::index');

$routes->get('/contacto', 'Home::contacto');
$routes->match(['get', 'post'], '/contactar', 'Home::enviarContacto');


$routes->match(['get', 'post'], '/login', 'Auth::login');
$routes->match(['get', 'post'], '/registro', 'Auth::crearUsuario');
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/editarPerfil', 'Auth::editarUsuario', ['filter' => 'auth']);
$routes->get('/perfil', 'Auth::perfil', ['filter' => 'auth']);

$routes->get('/producto/(:num)', 'ProductoController::ver/$1');
$routes->get('/productos', 'ProductoController::index');
$routes->post('/productos/filtrar', 'ProductoController::filtrar');


$routes->match(['get', 'post'], '/pedidos/crear', 'PedidosController::crear', ['filter' => 'auth']);
$routes->get('/pedidos', 'PedidosController::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/pedidos/enviar', 'PedidosController::enviarPedido');

$routes->group('admin', function ($routes) {

    $routes->get('/', 'Admin::index');

    $routes->get('productos', 'Admin::productos');
    $routes->get('productos/crear', 'Admin::crearProducto');
    $routes->get('productos/editar/(:num)', 'Admin::editar/$1');
    $routes->post('productos/actualizar/(:num)', 'Admin::actualizar/$1');
    $routes->post('productos/eliminar-imagen/(:num)', 'Admin::eliminarImagenGaleria/$1');
    $routes->post('productos/eliminar/(:num)', 'Admin::eliminarProducto/$1');
    $routes->delete('productos/eliminar/(:num)', 'Admin::eliminarProducto/$1');
    $routes->post('productos/crear_guardar', 'Admin::crear_guardar');

    $routes->get('categorias', 'Admin::categorias');
    $routes->post('categorias/guardar', 'Admin::guardarCategoria');
    $routes->post('categorias/editar/(:num)', 'Admin::editarCategoria/$1');
    $routes->post('categorias/eliminar/(:num)', 'Admin::eliminarCategoria/$1');
    $routes->delete('categorias/eliminar/(:num)', 'Admin::eliminarCategoria/$1');

    $routes->get('carrusel/productos', 'Admin::carruselesProductos');
    $routes->post('carrusel/guardar_productos', 'Admin::guardarCarruselProducto');
    $routes->post('carrusel/eliminar_productos/(:num)', 'Admin::eliminarCarruselProductos/$1');
    $routes->delete('carrusel/eliminar_productos/(:num)', 'Admin::eliminarCarruselProductos/$1');

    $routes->get('carrusel', 'Admin::carrusel');
    $routes->post('carrusel/subir', 'Admin::subirCarrusel');
    $routes->post('carrusel/eliminar_banner/(:num)', 'Admin::eliminarCarrusel/$1');
    $routes->delete('carrusel/eliminar_banner/(:num)', 'Admin::eliminarCarrusel/$1');

    $routes->get('ordenes', 'Admin::ordenes');
});
