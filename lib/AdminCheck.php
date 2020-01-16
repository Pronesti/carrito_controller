<?php
namespace Library;

class AdminCheck implements \Library\Controller{
    private $pagina;
    public function __construct($pagina)
    {
        $this->pagina = $pagina;
    }
    public function get($get,$post,&$session){
        if($session['username'] == 'Admin'){
            return $this->pagina->get($get,$post,$session);
        }else{
            header("Location: index.php");
        }
    }
    public function post($get,$post,&$session){
        if($session['username'] == 'Admin'){
            return $this->pagina->post($get,$post,$session);
        }else{
            header("Location: index.php");
        }
    }
    
}