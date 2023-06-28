<?php
class Home extends Controller
{
    private $db;
    public function __construct()
    {
    }
    public function index()
    {
        $this->view("home");
    }
}