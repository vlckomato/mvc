<?php 
require_once 'Core.php';

$core = new Core();

$core::get('/', 'page@test');
$core::get('/a/[:id]/b/[:name]', 'controller@method2');
$core::get('/b', 'test@test');



$core->init();

$test = $core->staticValue();
var_dump($test);

?>