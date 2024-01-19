<?php

  namespace Libs\Https;

  class Request{

    private static Request $instance;

    public function __construct(){
      
    }

    public static function instance(){
      if(empty(self::$instance)){
        self::$instance=new Request;
      }
      return self::$instance;
    }

    public function get($name,$default=null){
      return isset($_GET[$name])?htmlspecialchars($_GET[$name], ENT_QUOTES, 'utf-8'):$default;
    }
    public function post($name,$default=null){
      return isset($_POST[$name])?htmlspecialchars($_POST[$name], ENT_QUOTES, 'utf-8'):$default;
    }

    public function redirect($url){
      header('location:'.$url);
    }

  }

