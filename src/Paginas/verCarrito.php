<?php

namespace Carrito\Paginas;


class verCarrito implements \Library\Controller
{
    public function get($get,$post,&$session)
    {
        include_once("productos.php");
        if (!isset($session['carrito'])) {
            $session['carrito'] = array();
        }
        $total = 0;
        $listaCarrito = "";
        foreach ($session['carrito'] as $posicion => $itemKey) {
            foreach ($productos as $key => $item) {
                if ($key == $itemKey) {
                    $prodCarrito = new \Library\TemplateEngine("../src/templates/elementoCarrito.template");
                    $prodCarrito->addVariable("name", $item['name']);
                    $prodCarrito->addVariable("key", $key);
                    $prodCarrito->addVariable("posicion", $posicion);
                    $prodCarrito->addVariable("price", $item['price']);
                    $prodCarrito->addVariable("url", $item['url']);
                    $listaCarrito .= $prodCarrito->render();
                    $total += $item['price'];
                }
            }
        }
        $te = new \Library\TemplateEngine("../src/templates/index.template");
        $nav = new \Library\TemplateEngine("../src/templates/navbar.template");
        $nav->addVariable("username", $_SESSION['username']);
        $te->addVariable("navbar", $nav->render());
        $carrito = new \Library\TemplateEngine("../src/templates/carrito.template");
        $carrito->addVariable("listaCarrito", $listaCarrito);
        $carrito->addVariable("total", $total);
        $te->addVariable("contenido",$carrito->render());
        if (count($session['carrito']) > 0) {
            return $te->render();
        } else {
            return $te->render();
        }
    }
    public function post($get,$post,&$session){

        if(isset($post['deleteAll'])){
            $session['carrito'] = array();
            header("Location: index.php?page=carrito");
        }else{
            unset($session['carrito'][$post['item']]);
            header("Location: index.php?page=carrito");
        }
    }
}
