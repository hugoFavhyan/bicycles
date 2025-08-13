<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::register');
$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->post('/forgot-password', 'AuthController::forgotPassword');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/dashboard', 'ParkingController::dashboard', ['filter' => 'auth']);
$routes->get('/bicycles/create', 'BicycleController::create', ['filter' => 'auth']);
$routes->post('/bicycles/create', 'BicycleController::create', ['filter' => 'auth']);
$routes->get('/orders/create/(:num)', 'OrderController::create/$1', ['filter' => 'auth']);

$routes->get('/parking/start', 'ParkingController::start', ['filter' => 'auth']);
$routes->post('/parking/store', 'ParkingController::store', ['filter' => 'auth']);
$routes->get('/parking/stop/(:num)', 'ParkingController::stop/$1', ['filter' => 'auth']);
// Route for handling payment responses from Wompi (supports GET and POST)
$routes->match(['get', 'post'], '/payment/response', 'PaymentController::response');
