<?php

namespace core;

class Controller
{
    protected $view;

    public function __construct(){
        $this->view = new View();
    }

    final public function view($view_name, $params = []){
        foreach($params as $key=>$value){
            $this->view->assign($key, $value);
        }
        $this->view->display($view_name);
    }

    public function __destruct()
   {
      exit();
   }
}