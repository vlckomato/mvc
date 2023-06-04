<?php 
require_once 'Core.php';

$core = new Core();

$core::get('/', 'page@test');
$core::get('/a/[:id]/b/[:name]', 'page@test');
$core::get('/b', 'test@test');

$test = $core->staticValue();
//var_dump($test);


$core->init();



?>