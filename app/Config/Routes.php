<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/EJ4', 'ControladorInicio::index');
$routes->get('/Admin', 'AdminControlador::index');

// Rutas para Login
$routes->get('/login', 'ControladorInicio::login');
/* $routes->get('/AdminIngreso', 'ControladorInicio::AdminIngreso');
$routes->get('/UserIngreso', 'ControladorInicio::UserIngreso'); */

///Bancos
$routes->get('/adminAltaBanco', 'Banco::index');
$routes->get('/adminBajaBanco', 'BancoBaja::index');
$routes->get('/adminListadoBancos', 'Banco::indexConsulta');
$routes->get('/adminModificarBanco', 'Banco::indexModifica');
$routes->post('/adminListadoBancos', 'Banco::mostrarConsulta');
///Cuentas
$routes->get('/adminAltaCuenta', 'CuentaControlador::indexAlta');
$routes->get('/adminBajaCuenta', 'CuentaControlador::indexBaja');
$routes->get('/adminListadoCuentas', 'CuentaControlador::indexConsulta');
$routes->get('/adminModificarCuenta', 'CuentaControlador::indexModificar');
$routes->post('/adminListadoCuentas', 'CuentaControlador::mostrarConsulta');
$routes->post('/adminModificarCuenta', 'CuentaControlador::modificarCuenta');

///Clientes
$routes->get('/adminAltaCliente', 'ControladorCliente::indexAlta');
$routes->get('/adminBajaCliente', 'ControladorCliente::indexBaja');
$routes->get('/adminListadoClientes', 'ControladorCliente::indexConsulta');
$routes->get('/adminModificarCliente', 'ControladorCliente::indexModifica');
$routes->post('/adminListadoClientes', 'ControladorCliente::consultaUsuario');
$routes->post('/adminListadoClientes', 'ControladorCliente::consultaBanco');

/*
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
