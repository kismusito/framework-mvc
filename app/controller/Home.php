<?php

class Home extends Controller
{
    public function __construct()
    {
        $this->home = $this->model("users");
    }

    public function index() {
        $users = $this->home->connect();
        $this->view("pages/login" , compact("users"));
    }
}