<?php

namespace Carrito\Paginas;

class verRegistro implements \Library\Controller
{
    public function __construct()
    {
    }
    public function get($get, $post, &$session)
    {
        $te = new \Library\TemplateEngine("../src/templates/index.template");
        $nav = new \Library\TemplateEngine("../src/templates/navbar.template");
        $nav->addVariable("username", $_SESSION['username']);
        $te->addVariable("navbar", $nav->render());
        $user = new \Library\TemplateEngine("../src/templates/user.template");
        $user->addVariable("title", "Register");
        $user->addVariable("url", "register");
        $te->addVariable("contenido", $user->render());
        return $te->render();
    }
    public function post($get, $post, &$session){
        if(key_exists($post['username'], $session['usuarios'])){
            header("Location: index.php?page=register");
        }else{
            $session['usuarios'][$post['username']] = $post['password'];
            $session['username'] = $post['username'];
            $session['isLogged'] = true;
            header("Location: index.php");
        } 
    }
}