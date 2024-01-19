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
    UPDATE 
      Items 
    SET 
      completed_task=false 
    WHERE 
      item_id=? 
    ;
  ';

  try{
    $dbf->beginTransaction();
    $dbf->execute_query($sql,[$id]);
    $dbf->commit();
    $session->setMessage("タスクを戻しました");
  }
  catch(Exception $e){
    $dbf->rollback();
    $session->setErrorMessage("不具合によりタスクを戻せません");
  }
  $request->redirect(DirectorySettings::COFFEE_PUBLIC.'main.php');
