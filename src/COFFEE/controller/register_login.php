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
  
  $name=$request->post("user_name");
  $id=$request->post("user_email");
  $pass=$request->post("user_password");

  //入力値チェック
  if($name==='' || $id==='' || $pass===''){
    $session->setErrorMessage('未入力項目が存在します');
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");
    exit;
  }

  //IDチェック
  if(preg_match('/^[A-Za-z0-9]+$/', $id) !== 1){
    $session->setErrorMessage('半角英数字で入力してください');
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");
    exit;
  }

  //重複チェック
  $inValidSql='
    SELECT 
      user_email 
    FROM 
      Users 
    WHERE 
      user_email=? 
    ;
  ';
  
  $stmt=$dbf->fetch_all_query($inValidSql,[$id]);

  if(count($stmt)!==0){
    $session->setErrorMessage('このログインIDは登録されています');
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");
    exit;
  }

  //新規登録

  $insertSql='
    INSERT INTO 
      Users(
        user_name,user_email,user_password
      ) 
    VALUES(?,?,?);
  ';

  $password=password_hash($pass,PASSWORD_DEFAULT);

  try{
    $dbf->beginTransaction();
    $dbf->execute_query($insertSql,[$name,$id,$password]);
    $dbf->commit();
    $session->setSession('login',true);
    $session->setSession('user_name',$name);
    $session->setSession('user_id',$dbf->lastID());
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."main.php");
  }
  catch(Exception $e){
    $dbf->rollback();
    $session->setErrorMessage('何らかの不具合が発生しました。再登録お願いします');
    $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");
    exit;
  }



