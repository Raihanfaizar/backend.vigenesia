<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', static function ($routes) {
  $routes->resource('categories', [
    'controller' => API\CategoriesController::class,
    'filter' => \App\Filters\AuthenticationFilter::class,
  ]);
  $routes->resource('posts', [
    'controller' => API\PostsController::class,
    'filter' => \App\Filters\AuthenticationFilter::class,
  ]);
  $routes->resource('roles', [
    'controller' => API\RolesController::class,
    'filter' => \App\Filters\AuthenticationFilter::class,
  ]);
  $routes->resource('users', [
    'controller' => API\UsersController::class,
    'filter' => \App\Filters\AuthenticationFilter::class,
  ]);
  $routes->post('login', [
    \App\Controllers\API\UsersController::class,
    'login'
  ]);
  $routes->post('register', [
    \App\Controllers\API\UsersController::class,
    'create'
  ]);
});