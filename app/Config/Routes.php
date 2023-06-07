<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'HomeController::index');
$routes->get('about', 'HomeController::about');
$routes->get('videos', 'HomeController::videos');
$routes->get('photos', 'HomeController::photos');
$routes->get('library', 'HomeController::library', ['filter' => 'auth']);
$routes->get('login', 'HomeController::getLoginForm', ['filter' => 'noauth']);
$routes->post('login', 'HomeController::login', ['filter' => 'noauth']);
$routes->get('logout', 'HomeController::logout');
$routes->post('registration', 'FormController::addUser', ['filter' => 'noauth']);
$routes->get('registration', 'HomeController::showAddUserForm', ['filter' => 'noauth']);
$routes->post('contact', 'Admin\InteractionController::addInteraction');
$routes->get('contact', 'Admin\InteractionController::showAddInteractionForm');
$routes->get('admin', 'HomeController::admin', ['filter' => 'adminauth']);


$routes->group('admin/users', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'UserController::index', ['filter' => 'adminauth']);
    $routes->get('search', 'UserController::search', ['filter' => 'adminauth']);
    $routes->post('add', 'UserController::addUser', ['filter' => 'adminauth']);
    $routes->get('add', 'UserController::showAddUserForm', ['filter' => 'adminauth']);
    $routes->post('edit/(:any)', 'UserController::edit/$1', ['filter' => 'adminauth']);
    $routes->get('edit/(:any)', 'UserController::showEditForm/$1', ['filter' => 'adminauth']);
    $routes->post('delete/(:any)', 'UserController::delete/$1', ['filter' => 'adminauth']);

});

$routes->group('admin/messages', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'InteractionController::index', ['filter' => 'adminauth']);
    $routes->get('search', 'InteractionController::search', ['filter' => 'adminauth']);

    $routes->post('edit/(:any)', 'InteractionController::edit/$1', ['filter' => 'adminauth']);
    $routes->get('edit/(:any)', 'InteractionController::showEditForm/$1', ['filter' => 'adminauth']);
    $routes->post('delete/(:any)', 'InteractionController::delete/$1', ['filter' => 'adminauth']);
});

$routes->group('admin/photos', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'MediaController::index', ['filter' => 'adminauth']);
    $routes->get('search', 'MediaController::search', ['filter' => 'adminauth']);
    $routes->post('add', 'MediaController::addMedia', ['filter' => 'adminauth']);
    $routes->get('add', 'MediaController::showAddMediaForm', ['filter' => 'adminauth']);
    $routes->post('edit/(:any)', 'MediaController::edit/$1', ['filter' => 'adminauth']);
    $routes->get('edit/(:any)', 'MediaController::showEditForm/$1', ['filter' => 'adminauth']);
    $routes->post('delete/(:any)', 'MediaController::delete/$1', ['filter' => 'adminauth']);
});





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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
