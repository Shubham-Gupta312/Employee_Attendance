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

// User Reset Password 
$routes->get('reset_pswrd', 'AuthController::ResetPass');

$routes->group('admin', ['filter' => 'IsAdminLogin'], static function ($routes){
    $routes->get('dashboard', 'Home::index');
    $routes->post('add_employee', 'Home::add_employee');
    $routes->get('fetch_employee', 'Home::fetch_employee');
    $routes->post('setStatus', 'Home::setStatus');
    $routes->get('reports', 'Home::reports');
    $routes->post('reset_password', 'Home::resetPassword');
});