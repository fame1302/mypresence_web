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
$routes->setDefaultController('Home');
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
$routes->get('/', 'Home::index');
$routes->get('/test_var', 'TestVarController::index');
$routes->get('/login', 'UserController::index');
$routes->post('/login', 'UserController::login');

$routes->get('/admin', 'AdminController::index');
$routes->get('/admin/jabatan', 'AdminController::jabatan');
$routes->get('/admin/tambah_jabatan', 'AdminController::tambah_jabatan');
$routes->post('/admin/tambah_jabatan', 'AdminController::save_jabatan');
$routes->delete('/admin/jabatan/(:num)', 'AdminController::delete_jabatan/$1');
$routes->get('/admin/edit_jabatan/(:num)', 'AdminController::edit_jabatan/$1');
$routes->post('/admin/edit_jabatan/', 'AdminController::update_jabatan');

$routes->get('/admin/karyawan', 'AdminController::karyawan');
$routes->get('/admin/tambah_karyawan', 'AdminController::tambah_karyawan');
$routes->post('/admin/tambah_karyawan', 'AdminController::save_user');
$routes->delete('/admin/karyawan/(:num)', 'AdminController::delete_user/$1');
$routes->get('/admin/edit_karyawan/(:any)', 'AdminController::edit_user/$1');
$routes->post('/admin/edit_karyawan', 'AdminController::update_user');

$routes->get('/admin/profil_jadwal', 'AdminController::profil_jadwal');
$routes->delete('/admin/profil_jadwal/(:num)', 'AdminController::delete_profil_jadwal/$1');
$routes->get('/admin/tambah_profil_jadwal', 'AdminController::add_profil_jadwal');
$routes->post('/admin/tambah_profil_jadwal', 'AdminController::save_profil_jadwal');
$routes->get('/admin/edit_profil_jadwal/(:num)', 'AdminController::edit_profil_jadwal/$1');
$routes->post('/admin/edit_profil_jadwal', 'AdminController::update_profil_jadwal');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
