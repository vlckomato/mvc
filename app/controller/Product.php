<?php

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
        $data = $this->db->getProduct($id);
        $this->view("product", $data);
    }
}