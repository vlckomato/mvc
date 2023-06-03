<?php 
require_once 'Core.php';

$core = new Core();

$core::get('/', 'page@test');
$core::get('/a/{id}', 'controller@method2');
$core::get('/b', 'page@test');

$core->init();

?>