<?php
namespace Library;

interface Controller{
    public function get($get, $post , &$session);
    public function post($get, $post , &$session);
}
