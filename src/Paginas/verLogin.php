<?php

namespace Carrito\Paginas;

class verLogin implements \Library\Controller
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

        $user->addVariable("title", "Login");
        $user->addVariable("url", "login");
        $user->addVariable("extra", "<a href='index.php?page=register' class='btn btn-warning float-right w-25'>Register</a>");
        $te->addVariable("contenido", $user->render());
        return $te->render();
    }
    public function post($get, $post, &$session)
    {
        if (!isset($post['logout'])) {
            if (key_exists($post['username'], $session['usuarios']) && $session['usuarios'][$post['username']] == $post['password']) {
                $session['username'] = $post['username'];
                $session['isLogged'] = true;
                header("Location: index.php");
            } else {
                header("Location: index.php?page=login");
            }
        } else {
            $_SESSION['isLogged'] = false;
            $_SESSION['username'] = null;
            $_SESSION['carrito'] = array();
            header("Location: index.php?page=login");
        }
    }
}
