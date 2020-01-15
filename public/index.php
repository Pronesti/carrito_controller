<?php
include_once("../vendor/autoload.php");
session_start();

$which = $_GET['page'];
$router = new Library\Router();
$router->addRouteOld("carrito", new Library\CheckLogin(new Carrito\Paginas\verCarrito()));
$router->addRouteOld("listado", new Library\CheckLogin(new Carrito\Paginas\verListadoProductos()));
$router->addRouteOld("register", new Carrito\Paginas\verRegistro());
$router->addRouteOld("login", new Carrito\Paginas\verLogin());

if(isset($which)) {
    $page = $router->matchOld($which);
} else {
    $page = $router->matchOld("listado");
}
if(is_null($page)){
    $page = $router->matchOld("listado");
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    echo $page->get($_GET, $_POST, $_SESSION);
}else{
   echo $page->post($_GET, $_POST, $_SESSION);
}
