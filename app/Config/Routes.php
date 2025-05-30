<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::mainDashboard');
$routes->get('/menu', 'Menu::index');
$routes->get('/menu/addToCart/(:num)', 'Menu::addToCart/$1');
$routes->get('/menu/clearCart', 'Menu::clearCart');
$routes->get('menu/cart', 'Menu::cart');
$routes->get('menu/viewing_cart', 'Menu::viewing_cart');
$routes->get('menu/increaseQuantity/(:num)', 'Menu::increaseQuantity/$1');
$routes->get('menu/decreaseQuantity/(:num)', 'Menu::decreaseQuantity/$1');
$routes->get('menu/removeItem/(:num)', 'Menu::removeItem/$1');
$routes->match(['get', 'post'], 'menu/completeOrder', 'Menu::completeOrder');
$routes->post('menu/uploadReceipt', 'Menu::uploadReceipt');

// Authentication routes
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::doLogin');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/register', 'Auth::save');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/auth/dashboard', 'Auth::dashboard');

// Email verification routes
$routes->get('/auth/verify/(:any)', 'Auth::verify/$1');
$routes->post('/auth/resend-verification', 'Auth::resendVerification');

// Password reset routes
$routes->get('/auth/forgot', 'Auth::forgot');
$routes->post('/auth/forgot', 'Auth::sendReset');
$routes->get('/auth/reset/(:any)', 'Auth::reset/$1');
$routes->post('/auth/reset/(:any)', 'Auth::updatePassword');

// Convenience routes
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/main_dashboard', 'Home::mainDashboard');

// User profile routes
$routes->get('user/getProfile', 'UserController::getProfile');
$routes->get('user/profile', 'UserController::getProfile');
$routes->post('user/update-profile', 'UserController::updateProfile');
$routes->post('user/updateProfile', 'UserController::updateProfile');
$routes->get('user/orders', 'UserController::orders');

// Admin routes (with admin filter)
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::dashboard');
    
    // User management routes
    $routes->get('users', 'Admin::users');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
    $routes->get('archived-users', 'Admin::archivedUsers');
    $routes->get('users/restore/(:num)', 'Admin::restoreUser/$1');
    
    // Product management routes
    $routes->get('products', 'Admin::products');
    $routes->get('products/create', 'Admin::createProduct');
    $routes->post('products/create', 'Admin::storeProduct');
    $routes->post('addProduct', 'Admin::storeProduct');
    $routes->get('editProduct/(:num)', 'Admin::editProduct/$1');
    $routes->post('updateProduct/(:num)', 'Admin::updateProduct/$1');
    $routes->get('image/(:num)', 'Admin::displayImage/$1');
    
    // Order validation routes
    $routes->get('orders', 'Admin::orders');
    $routes->get('orders/pending', 'Admin::pendingOrders');
    $routes->post('orders/validate/(:num)', 'Admin::validateOrder/$1');
    $routes->get('orders/view/(:num)', 'Admin::viewOrder/$1');
    $routes->post('orders/reject/(:num)', 'Admin::rejectOrder/$1');
});

// Add public route for product images
$routes->get('admin/image/(:num)', 'Admin::displayImage/$1', ['filter' => 'cors']);

// Add route for GCash receipt images
$routes->get('uploads/(:segment)', 'Admin::displayReceipt/$1');

// Add public route for product images
$routes->get('products/image/(:num)', 'Products::displayImage/$1', ['filter' => 'cors']);

// Cart routes
$routes->post('cart/add', 'Cart::addToCart');
$routes->get('cart', 'Cart::viewCart');