<?php

require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Post', 'action' => 'index']);
$router->add('posts/create', ['controller' => 'Post', 'action' => 'create']);
$router->add('posts/store', ['controller' => 'Post', 'action' => 'store']);
$router->add('posts/show', ['controller' => 'Post', 'action' => 'show']);
$router->add('posts/edit', ['controller' => 'Post', 'action' => 'edit']);
$router->add('posts/delete', ['controller' => 'Post', 'action' => 'delete']);
$router->add('{controller}/{action}');
    
$router->dispatch($_SERVER['QUERY_STRING']);