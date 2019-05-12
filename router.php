<?php


$routes = [
        "/" => "../homepage.php",
        "/create" => "../create.php",
        "/store"  =>  "../store.php",
        "/edit"."?id={$_GET['id']}"  =>  "../edit.php",
        "/update"."?id={$_GET['id']}"  =>  "../update.php",
        "/delete"."?id={$_GET['id']}"   =>  "../delete.php"
];


$route = $_SERVER['REQUEST_URI'];
//if(file_exists('../homepage.php')){
//    echo "Есть такой";
//}
if(!array_key_exists($route,$routes)){
    echo(404);
}else{
    include $routes[$route];exit;
}




