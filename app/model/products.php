<?php

use Medoo\Medoo;

class Products
{
      private $db;

      public function __construct()
      {
            $pdo = new PDO('mysql:dbname=products;host=localhost', 'root', 'root');
 
      $this->db = new Medoo([
	// Initialized and connected PDO object.
	'pdo' => $pdo,
 
	// [optional] Medoo will have a different handle method according to different database types.
	'type' => 'mysql'
]);
      }

      public function getAllProducts()
      {
            $sth = $this->db->pdo->prepare('SELECT name FROM product');
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_BOTH);
            var_dump($result);
            

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