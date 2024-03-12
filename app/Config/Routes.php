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

$routes->group('', ['filter' => 'IsUserLogin'], static function ($routes){
    $routes->get('/', 'Home::index');
    $routes->get('signout', 'UserController::signout');
    $routes->post('getEmpDetails', 'UserController::getEmpDetails');
    $routes->post('mark_attendance', 'UserController::mark_attendance');
    $routes->get('getSessionEmail', 'UserController::getSessionEmail');
    $routes->get('fetchEmployeeDetails', 'UserController::fetchEmployeeDetails');
});

// User Reset Password 
$routes->get('reset_pswrd', 'AuthController::ResetPass');
$routes->post('reset_pswrd', 'AuthController::ResetPass');
$routes->get('error_msg', 'AuthController::error_msg');
// login
$routes->get('login', 'UserController::UserLogin');
$routes->post('login', 'UserController::UserLogin');

$routes->get('emp_reset_email', 'UserController::userResetEmail');
$routes->post('resetEmail', 'UserController::userResetEmail');

$routes->get('emp_reset_password', 'UserController::userResetPass');
$routes->post('emp_reset_password', 'UserController::userResetPass');



$routes->group('admin', ['filter' => 'IsAdminLogin'], static function ($routes){
    $routes->get('dashboard', 'Home::dashboard');
    $routes->post('add_employee', 'Home::add_employee');
    $routes->get('fetch_employee', 'Home::fetch_employee');
    $routes->post('setStatus', 'Home::setStatus');
    $routes->get('reports', 'Home::reports');
    $routes->get('fetchreports', 'Home::fetchReports');
    $routes->post('reset_password', 'Home::resetPasswordMail');
    $routes->post('NdlExcel', 'Home::DownloadExcelNameWise');
    $routes->post('ExcelReport', 'Home::ExcelReport');
});