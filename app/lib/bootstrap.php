<?php 
ini_set('display_errors', 1);

require_once 'Core.php';

$router = new Router();

$router->get('/', 'page@index');
$router->get('/a/[:id]/b/[:name]', 'page@test');
$router->get('/b/[:id]', 'test@test');


$router->init();



?>