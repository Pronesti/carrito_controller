<?php
include_once("../vendor/autoload.php");
session_start();

$which = $_GET['page'];
$router = new Library\Router();
$router->addRoute("carrito", new Library\CheckLogin(new Carrito\Paginas\verCarrito()));
$router->addRoute("listado", new Library\CheckLogin(new Carrito\Paginas\verListadoProductos()));
$router->addRoute("admin", new Library\AdminCheck(new Carrito\Paginas\verListadoProductos()));
$router->addRoute("register", new Carrito\Paginas\verRegistro());
$router->addRoute("login", new Carrito\Paginas\verLogin());

if(isset($which)) {
    $page = $router->match($which);
} else {
    $page = $router->match("listado");
}
if(is_null($page)){
    $page = $router->match("listado");
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo $page->get($_GET, $_POST, $_SESSION);
}else{
   echo $page->post($_GET, $_POST, $_SESSION);
}
