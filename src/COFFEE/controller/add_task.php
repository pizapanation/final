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

  $user_id=$request->post('user_id');
  $item_title=$request->post('item_title');
  $item_detail=$request->post('item_detail');
  $item_start_date=$request->post('item_start_date');
  $item_end_date=$request->post('item_end_date');

  $sql='
    INSERT INTO 
      Items(
        user_id,item_title,item_detail,item_start_date,item_end_date
      )
      VALUES(?,?,?,?,?)
    ;
  ';

  try{
    $dbf->beginTransaction();
    $dbf->execute_query($sql,[$user_id,$item_title,$item_detail,$item_start_date,$item_end_date]);
    $dbf->commit();
    $session->setMessage("タスクを登録しました");
  }
  catch(Exception $e){
    $dbf->rollback();
    $session->setErrorMessage("不具合によりタスクを登録できません");
  }
  $request->redirect(DirectorySettings::COFFEE_PUBLIC.'main.php');
