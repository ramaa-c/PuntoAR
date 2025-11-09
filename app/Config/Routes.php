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

$routes->group('admin', function($routes) {
    
    $routes->get('/', 'Admin::index'); 
    
    // Rutas de Productos
    $routes->get('productos', 'Admin::productos'); // URL: /admin/productos
    // Ruta para mostrar el formulario (GET /admin/productos/crear)
    $routes->get('productos/crear', 'Admin::crearProducto'); 
// Ruta para mostrar el formulario de edición (GET /admin/productos/editar/ID)
    $routes->get('productos/editar/(:num)', 'Admin::editar/$1'); 
    
    // Ruta para procesar el formulario de actualización (POST /admin/productos/actualizar/ID)
    $routes->post('productos/actualizar/(:num)', 'Admin::actualizar/$1');    

    // En app/Config/Routes.php (dentro del grupo 'admin')

$routes->post('productos/eliminar-imagen/(:num)', 'Admin::eliminarImagenGaleria/$1');
    // Ruta para procesar el formulario (POST /admin/productos/crear_guardar)
    $routes->post('productos/crear_guardar', 'Admin::crear_guardar');
    
    $routes->get('categorias', 'Admin::categorias');
    
    // Ruta para guardar la categoría (POST /admin/categorias/guardar)
    $routes->post('categorias/guardar', 'Admin::guardarCategoria');
    
    // Rutas de Carrusel
    // Rutas de Carrusel
    $routes->get('carrusel', 'Admin::carrusel'); // Muestra la lista y formulario
    $routes->post('carrusel/subir', 'Admin::subirCarrusel'); // Sube la nueva imagen
    $routes->post('carrusel/ordenar', 'Admin::ordenarCarrusel'); // Endpoint para el JS de ordenación
    $routes->get('carrusel/eliminar/(:num)', 'Admin::eliminarCarrusel/$1'); // Elimina una imagen    
    // Rutas de Órdenes
    $routes->get('ordenes', 'Admin::ordenes');
});    
