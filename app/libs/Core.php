<?php

class Core 
{
    protected $currentController = "Home";
    protected $currentMethod = "index";
    protected $parameters = [];

    public function __construct()
    {
        $url = $this->getURL();
        
        if(file_exists("../app/controller/" . ucwords($url[0]) . ".php")) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        include_once "../app/controller/" . $this->currentController . ".php";
        $this->currentController = new $this->currentController;

        if(isset($url[1])) {
            if(method_exists($this->currentController , $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];
        call_user_func_array([$this->currentController , $this->currentMethod] , $this->parameters);
    }

    public function getURL() {
        if(isset($_GET["url"])) {
            $url = trim($_GET["url"] , "/");
            $url = filter_var($url , FILTER_SANITIZE_URL);
            $url = explode("/" , $url);
            return $url;
        }
    }
}