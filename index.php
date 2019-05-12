<?php

class Router
{
    private $routes;
    private $request;

    public function __construct($routes)
    {
        $this->routes = $routes;
        $this->request = $_SERVER['REQUEST_URI'];
    }
    public function check(){
        if(!array_key_exists($this->request,$this->routes)){
            echo(404);
        }else{
            include $this->routes[$this->request];exit;
        }
    }
}

$routes = new Router([
    "/" => "../homepage.php",
    "/create" => "../create.php",
    "/store"  =>  "../store.php",
    "/edit"."?id={$_GET['id']}"  =>  "../edit.php",
    "/update"."?id={$_GET['id']}"  =>  "../update.php",
    "/delete"."?id={$_GET['id']}"   =>  "../delete.php"
]);
$routes->check();









