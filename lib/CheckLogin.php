<?php
namespace Library;

class CheckLogin implements \Library\Controller{
    private $pagina;
    public function __construct($pagina)
    {
        $this->pagina = $pagina;
    }
    public function get($get,$post,&$session){
        if($session['isLogged']){
            return $this->pagina->get($get,$post,$session);
        }else{
            header("Location: index.php?page=login");
        }
    }
    public function post($get,$post,&$session){
        if($session['isLogged']){
            return $this->pagina->post($get,$post,$session);
        }else{
            header("Location: index.php?page=login");
        }
    }
    
}