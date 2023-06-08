<?php
class Products {

    private $data;

    public function __construct(){
        $this->data = array (
            array("id" => "1", "name"=>"Product1"),
            array("id" => "2", "name"=>"Product2"),
            array("id" => "3", "name"=>"Product3"),
            array("id" => "4", "name"=>"Product4")
          );

    }

    public function getAllProducts() {
        
          return $this->data;
    }

     public function getProduct($id) {
        
   foreach($this->data as $key => $product)
   {
      if ( $product['id'] === $id )
         return $this->data[$key];
   }
}
}