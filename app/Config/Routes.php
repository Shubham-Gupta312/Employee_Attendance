<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('admin', static function ($routes) {
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::register');
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::login');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('admin', ['filter' => 'IsAdminLogin'], static function ($routes){
    $routes->get('dashboard', 'Home::index');
    $routes->get('add_employee', 'Home::add_employee');
});