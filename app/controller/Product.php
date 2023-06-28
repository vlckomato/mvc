<?php

echo 'test';

class Product extends Controller
{
    private $db;
    public function __construct()
    {
        $this->db = $this->model("products");
    }
    public function products()
    {
        $data = $this->db->getAllProducts();
        $this->view("products", $data);
    }

    public function product($id)
    {
        if (!$data = $this->db->getProduct($id)) {
            die('Product with ID: ' .$id. ' not exist');
        } else {
            $this->view("product", $data);
        };
    }
}