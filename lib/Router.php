<?php
namespace Library;
class Router{
    private $book = array();

    function addRouteOld(String $path, $target){
        $done = false;
        if(!isset($this->book[$path])){
            $this->book[$path] = $target;
            $done = true;
        }
        return $done;
    }

    function addRoute(String $regex, $target){
        // "noticia/:id/fecha/:anio/:mes/:dia"
        // "noticia/(?<id>\w+)/fecha/:anio/:mes/:dia"
        $regex="#" . $regex . "#";
        $done = false;
        if(!isset($this->book[$regex])){
            $this->book[$regex] = $target;
            $done = true;
        }
        return $done;
    }

    function addRouteComplex(String $route, $target){
        // "noticia/:id/fecha/:anio/:mes/:dia"
        // "noticia/(?<id>\w+)/fecha/:anio/:mes/:dia
        //preg_match_all("/:(?<var>\w+)/", $route, $changes);
        $route = preg_replace("/:(\w+)@numero/", $route, "\d+");
        $route = preg_replace("/:(\w+)@palabra/", $route, "\w+");
        $route = preg_replace("/:\w+/", "\w+", $route);
        $route="#" . $route . "#";
        $done = false;
        if(!isset($this->book[$route])){
            $this->book[$route] = $target;
            $done = true;
        }
        return $done;
    }

    function matchOld(String $path){
        $res = preg_split("~\w[^/][\/]/g~", $path, 0);
        //return $res;
        if(isset($this->book[$path])){
            return $this->book[$path];
        }else{
            return null;
        }
    }

    function match($path){
        foreach($this->book as $regex => $target){
            $r = preg_match_all($regex, $path);
            if($r>0){
                //return $poat;
                return $target;
            }
        }
        return null;
    }


}