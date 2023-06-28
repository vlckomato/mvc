<?php

class Products
{
      private $db;

      public function __construct()
      {
           // $this->db = new Database;
      }

      public function getAllProducts()
      {
            $this->db->query("SELECT name FROM products");
            $data = $this->db->resultSet();
            

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