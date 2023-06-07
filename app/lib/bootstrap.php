<?php 
ini_set('display_errors', 1);

require_once 'error.php';
require_once 'Core.php';

$router = new Router();

$router->get('/', 'page@inllldex');
$router->get('/a/[:id]/b/[:name]', 'page@test');
$router->get('/b/[:id]', 'test@tet');


$router->init();



?>