<?php

use Medoo\Medoo;

$pdo = new PDO('mysql:dbname=products;host=localhost', 'root', 'root');
 
$database = new Medoo([
	// Initialized and connected PDO object.
	'pdo' => $pdo,
 
	// [optional] Medoo will have a different handle method according to different database types.
	'type' => 'mysql'
]);

var_dump($database);

class Products
{
      private $data;

      public function __construct()
      {
            $this->data = [
                  ["id" => "1", "name" => "Product1"],
                  ["id" => "2", "name" => "Product2"],
                  ["id" => "3", "name" => "Product3"],
                  ["id" => "4", "name" => "Product4"],
            ];
      }

      public function getAllProducts()
      {
            return $this->data;
      }

      public function getProduct($id)
      {
            foreach ($this->data as $key => $product) {
                  if ($product["id"] === $id) {
                        return $this->data[$key];
                  } 
            }
      }
}