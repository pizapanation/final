<?php

  require_once '../bootstrap.php';

  use Config\DirectorySettings;
  use Libs\DB\DBFunctions;
  use Libs\Https\Request;
  use Libs\App\CoffeeSession;
  use Exception;

  $dbf=new DBFunctions;
  $request=new Request;
  $session=new CoffeeSession;
  
  $id=$request->post("user_email");
  $pass=$request->post("user_password");

  //入力値チェック
  if($id==='' || $pass===''){
    $session->setErrorMessage('未入力項目が存在します');
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");
    exit;
  }

  //ログイン

  $selectSql='
    SELECT 
      * 
    FROM 
      Users 
    WHERE 
      user_email=?
    ;
  ';

  $stmt=$dbf->fetch_query($selectSql,[$id]);

  if(password_verify($pass,trim($stmt['user_password'],"'"))){
    $session->setSession('login',true);
    $session->setSession('user_name',$stmt['user_name']);
    $session->setSession('user_id',$stmt['user_id']);
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."main.php");
    exit;
  }
  else{
    $session->setErrorMessage('IDかパスワードが違います');
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");
    exit;
  }




