<?php

  require_once '../bootstrap.php';

  use Config\DirectorySettings;
  use Libs\App\CoffeeSession;
  use Libs\DB\DBFunctions;
  use Libs\Https\Request;
  use Exception;

  $session=new CoffeeSession;
  $dbf=new DBFunctions;
  $request=new Request;

  $id=$request->get('id');
  $sql='
    DELETE FROM  
      Items 
    WHERE 
      item_id=? 
    ;
  ';

  try{
    $dbf->beginTransaction();
    $dbf->execute_query($sql,[$id]);
    $dbf->commit();
    $session->setMessage("タスクを削除しました");
  }
  catch(Exception $e){
    $dbf->rollback();
    $session->setErrorMessage("不具合によりタスクを削除できません");
  }
  $request->redirect(DirectorySettings::COFFEE_PUBLIC.'main.php');
