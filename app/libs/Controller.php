<?php

class Controller
{
    public function view($view , $params = []) {
        if(file_exists(URL_APP . "/view/" . $view . ".php")) {
            require_once URL_APP . "/view/" . $view . ".php";
        } else {
            echo "The view doesn't exist";
        }
    }

    public function model($model) {
        require_once URL_APP . "/model/" . $model . ".php";
        return new $model;
    }
}