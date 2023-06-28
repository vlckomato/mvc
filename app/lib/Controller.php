<?php

class Controller
{
    public function model($model)
    {
        if (file_exists("../app/model/" . $model . ".php")) {
            require_once "../app/model/" . $model . ".php";
            return new $model();
        } else {
            die("Model not exist");
        }
    }

    public function view($view, $data = [])
    {
        if (file_exists("../app/view/" . $view . ".php")) {
            require_once "../app/view/" . $view . ".php";
        } else {
            die("View not exist");
        }
    }
}