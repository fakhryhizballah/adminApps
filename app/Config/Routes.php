<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Admin');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'AuthFilter']);
$routes->get('/admdriver', 'Admin::admdriver', ['filter' => 'AuthFilter']);
$routes->get('/ptcv', 'Admin::ptcv', ['filter' => 'AuthFilter']);
$routes->get('/admuser', 'Admin::admuser', ['filter' => 'AuthFilter']);
$routes->get('/admstasiun', 'Admin::admstasiun', ['filter' => 'AuthFilter']);
$routes->get('/admlokasi', 'Admin::admlokasi', ['filter' => 'AuthFilter']);
$routes->get('/admflush', 'Admin::admflush', ['filter' => 'AuthFilter']);
$routes->get('/admvoucher', 'Admin::admvoucher', ['filter' => 'AuthFilter']);
$routes->get('/crtmitra', 'Admin::crtmitra', ['filter' => 'AuthFilter']);
$routes->get('/crtdriver', 'Admin::crtdriver', ['filter' => 'AuthFilter']);
$routes->get('/crtstasiun', 'Admin::crtstasiun', ['filter' => 'AuthFilter']);
$routes->get('/crtlokasi', 'Admin::crtlokasi', ['filter' => 'AuthFilter']);
$routes->get('/crtvoucher', 'Admin::crtvocher', ['filter' => 'AuthFilter']);
$routes->get('/admsetmesin', 'Admin::admsetmesin', ['filter' => 'AuthFilter']);
$routes->get('/admlevel', 'Admin::admlevel', ['filter' => 'AuthFilter']);
// $routes->get('/', 'Auth::index');
// $routes->get('/admin', 'Admin::index');
// $routes->get('/admdriver', 'Admin::admdriver');
// $routes->get('/ptcv', 'Admin::ptcv');
// $routes->get('/admuser', 'Admin::admuser');
// $routes->get('/admstasiun', 'Admin::admstasiun');
// $routes->get('/admvoucher', 'Admin::admvoucher');
// $routes->get('/crtmitra', 'Admin::crtmitra');
// $routes->get('/crtdriver', 'Admin::crtdriver');
// $routes->get('/crtstasiun', 'Admin::crtstasiun');
// $routes->get('/crtvoucher', 'Admin::crtvocher');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
