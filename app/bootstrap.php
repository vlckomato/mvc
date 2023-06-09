<?php
ini_set('display_errors', 1);

require_once 'config/config.php';
//require_once 'lib/Router.php';
//require_once 'lib/Controller.php';

spl_autoload_register(function ($class_name) {
    require_once 'lib/' . $class_name . '.php';
});


$router = new Router();

$router->get('/', 'home@index');
$router->get('/product', 'product@products');
$router->get('/product/[:id]', 'product@product');


$router->init();


?>