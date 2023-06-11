<?php
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