<?php

namespace Libs\Session;

class Session{

  public function __construct(){
    if(session_status() == PHP_SESSION_NONE){
      session_start();
    }
  }

  /**
   * set value to $_SESSION['key']. 
   *
   * @param string $key
   * @param mixed $value
   * @return void
   */
  public function setSession($key,$value){
    $_SESSION[$key]=htmlspecialchars($value,ENT_QUOTES,'utf-8');
  }
/**
 * get value from $SESSION[$key].
 *
 * @param string $key
 * @return mixed
 */
  public function getSession($key){
    return isset($_SESSION[$key])?$_SESSION[$key]:null;
  }

  public function removeSession($key){
    if(isset($_SESSION[$key])){
      unset($_SESSION[$key]);
    }
  }

  public function clearSession(){
    session_unset();
  }

  public function destroySession(){
    $this->clearSession();
    session_destroy();
  }

}