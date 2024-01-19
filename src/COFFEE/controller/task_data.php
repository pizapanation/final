<?php

  require_once '../bootstrap.php';

  use Libs\App\CoffeeSession;
  use Libs\Https\Request;
  use Libs\DB\DBFunctions;

  $session=new CoffeeSession;
  $request=new Request;
  $dbf=new DBFunctions;
  $year=$request->get('year');
  $month=$request->get('month');
  $day=$request->get('day');

  //データベース
  $sql='
    SELECT 
      * 
    FROM 
      Items 
    WHERE 
      user_id=? 
    AND 
      completed_task=false 
    AND 
      YEAR(item_start_date)=? 
    AND 
      MONTH(item_start_date)=? 
    AND 
      DAY(item_start_date)=? 
    ;
  ';
  $stmt=$dbf->fetch_all_query($sql,[$session->getSession('user_id'),$year,$month,$day]);

  header('Content-Type: application/json');
  echo json_encode($stmt);