<?php

  namespace Libs\Core;

  class AutoLoader{

    private string $system_root_dir;
    private array $application_root_dir;

    public function __construct(string $root_dir){

      $this->system_root_dir = $root_dir;
      $this->application_root_dir=array($this->system_root_dir);

    }

    public function run(){

      spl_autoload_register(array($this,"loadClass"));

    }

    public function loadClass($class){

      $php_file=$this->create_php_file_path($class);
      require_once($php_file);
      return;

    }

    private function create_php_file_path($class){

      foreach($this->application_root_dir as $dir){
        $pieces=array($dir);
        $class_with_name_space=ltrim($class,"\\");
        $pieces=array_merge($pieces,explode('\\',$class_with_name_space));
        $result=implode(DIRECTORY_SEPARATOR,$pieces).".php";
        if(is_readable($result)){
          return $result;
        }
        return null;
      }

    }

  }

