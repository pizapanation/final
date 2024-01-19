<?php

  namespace Libs\App;

  use Libs\Session\Session;

  class CoffeeSession extends Session{

    public function __construct(){
      parent::__construct();
    }

    public function getMessage(){
      $result=is_null(parent::getSession('message'))?'':parent::getSession('message');
      parent::removeSession('message');
      return $result;
    }

    public function setMessage($value){
      parent::setSession('message',$value);
    }

    public function getErrorMessage(){
      $result=is_null(parent::getSession('error_message'))?'':parent::getSession('error_message');
      parent::removeSession('error_message');
      return $result;
    }

    public function setErrorMessage($value){
      parent::setSession('error_message',$value);
    }

  }

