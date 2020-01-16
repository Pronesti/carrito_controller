<?php

namespace Carrito\Paginas;


class verCarrito implements \Library\Controller
{
    public function get($get,$post,&$session)
    {
        
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
