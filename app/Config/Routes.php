<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('bienvenida', 'Bienvenida::index');
$routes->get('perfil', 'Perfil::index');
$routes->get('producto', 'Producto::index');
$routes->get('servicio', 'Servicio::index');
$routes->get('instituto', 'Instituto::index');

$routes->get('edad', 'Edad::index');
$routes->get('titulo', 'Titulo::index');

$routes->get('salida', 'Salida::ejercicios');

$routes->get('mensaje', 'MensajeController::index');

$routes->get('estudiantes', 'ListaController::index');

$routes->get('saludo', 'SaludoController::index');

$routes->get('curso/(:num)', 'CursoController::detalle/$1');

// Cuando el usuario visita /productos mediante GET,
// CodeIgniter ejecuta ProductoController::index.
$routes->get('productos', 'ProductoController::index');

// (:num) es un "espacio reservado" para un número dentro de la URL.
// Ejemplo: /producto/2
// $1 significa "entrega al controlador el primer valor capturado".
$routes->get('producto/(:num)', 'ProductoController::detalle/$1');

// Esta ruta atiende /buscar?nombre=mouse mediante GET.
// El texto después de ? no se escribe en la regla;
// el controlador lo leerá con getGet('nombre').
$routes->get('buscar', 'ProductoController::buscar');

// Esta ruta muestra el formulario para registrar un producto.
// Sigue siendo GET porque solo estamos pidiendo mostrar una pantalla.
$routes->get('producto/nuevo', 'ProductoController::formulario');

// Esta ruta recibe los datos enviados por el formulario.
// Usamos POST porque el usuario está enviando información al servidor.
$routes->post('producto/guardar', 'ProductoController::guardar');
