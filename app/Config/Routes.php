<?php

use CodeIgniter\Router\RouteCollection;
use App\Filters\AuthFilter;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('', ['filter' => AuthFilter::class], function ($routes) {

    $routes->add('Clientes', 'ClienteController::inserir');
    $routes->get('Clientes/listagem', 'ClienteController::index');
    $routes->add('Clientes/editar/(:num)', 'ClienteController::editar/$1');
    $routes->get('Clientes/excluir/(:num)', 'ClienteController::excluir/$1');

});

// usuários
$routes->add('Usuario/inserir', 'UsuarioController::inserir');
$routes->add('Usuario/login', 'UsuarioController::index');
