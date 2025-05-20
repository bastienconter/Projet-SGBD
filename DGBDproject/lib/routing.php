<?php

class Routing
{

    private $pathToAPI = '';


    private $is404 = true;
    public $pathTo404 = '';


    //CONSTRUCTOR
    public function __construct($pathToAPI)
    {
        $this->pathToAPI = $pathToAPI;
    }

    //Create the route
    private function route($route, $pathToInclude)
    {
        $request = $_SERVER['REQUEST_URI'];
        if ($route == $request)
        {
            require $this->pathToAPI . $pathToInclude;
            $this->is404 = false;
        }
    }

    //404
    public function closeRouting()
    {
        if ($this->is404)
        {
            require $this->pathTo404 . '404.php';
        }
    }

    //GET
    public function get($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->route($route, $path_to_include);
        }
    }

    //POST
    public function post($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->route($route, $path_to_include);
        }
    }
    //PUT
    public function put($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $this->route($route, $path_to_include);
        }
    }

    //PATCH
    public function patch($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $this->route($route, $path_to_include);
        }
    }

    //DELETE
    public function delete($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->route($route, $path_to_include);
        }
    }

    //ANY
    public function any($route, $path_to_include)
    {
        $this->route($route, $path_to_include);
    }


}
?>
