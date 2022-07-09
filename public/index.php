<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';
require '../database/config.php';


$router = new Router($_GET['url'] ?? '');

$router->get('/', 'App\Controllers\PostController@index');

$router->get('/books', 'App\Controllers\BookController@index');
$router->get('/books/:id', 'App\Controllers\BookController@show');

$router->get('/contact', 'App\Controllers\ContactController@show');
$router->post('/contact', 'App\Controllers\ContactController@send');

$router->get('/authors', 'App\Controllers\AuthorController@index');
$router->get('/authors/:id', 'App\Controllers\AuthorController@show');

$router->post('/login', 'App\Controllers\Admin\UserController@loginPost');
$router->get('/admin/login', 'App\Controllers\Admin\UserController@login');
$router->get('/admin/dashboard', 'App\Controllers\Admin\UserController@dashboard');
$router->get('/logout', 'App\Controllers\Admin\UserController@logout');

$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/createPost', 'App\Controllers\Admin\PostController@createPost');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@deletePost');
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit');
$router->post('/admin/posts/update/:id', 'App\Controllers\Admin\PostController@updatePost');


try {
  $router->run();
} catch (NotFoundException $error) {
    return $error->error404();
}


