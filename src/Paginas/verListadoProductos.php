<?php

namespace Carrito\Paginas;

class verListadoProductos implements \Library\Controller
{
    public function get($get,$post,&$session)
    {
        include_once("productos.php");
        $te = new \Library\TemplateEngine("../src/templates/index.template");
        $nav = new \Library\TemplateEngine("../src/templates/navbar.template");
        $nav->addVariable("username", $_SESSION['username']);
        $te->addVariable("navbar", $nav->render());

        if(isset($session['username'])){
            $te->addVariable("username", $session['username']);
        }
        $lista = "";
        foreach ($productos as $key => $item) {
            $prod = new \Library\TemplateEngine("../src/templates/producto.template");
            $prod->addVariable("url", $item['url']);
            $prod->addVariable("name", $item['name']);
            $prod->addVariable("price", $item['price']);
            $prod->addVariable("quantity", $item['quantity']);
            $prod->addVariable("key", $key);
            $lista .= $prod->render();
        }
        $te->addVariable("contenido", $lista);
        return $te->render();
    }
    public function post($get,$post,&$session)
    {
        for($i=0;$i<$post['cantidad'];$i++){
            $session['carrito'][] = $post['item'];
        }
        header("Location: index.php?page=listado");
    }
}
