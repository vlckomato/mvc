<?php 
ini_set('display_errors', 1);

require_once 'Router.php';

$router = new Router();

$router->get('/', 'home@index');
$router->get('/product/[:id]', 'product@product');


$router->init();


?>