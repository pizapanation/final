<?php

  require_once '../bootstrap.php';

  use Libs\App\CoffeeSession;
  use Libs\DB\DBFunctions;
  use Libs\Https\Request;

  $session=new CoffeeSession;
  $dbf=new DBFunctions;
  $request=new Request;

  $item_id=$request->get('id');
  $user_id=$session->getSession('user_id');

  $sql='
    SELECT 
      * 
    FROM 
      Items 
    WHERE 
      item_id=? 
    AND 
      user_id=? 
    ;
  ';

  $stmt=$dbf->fetch_query($sql,[$item_id,$user_id]);
  
?>
<form action="../controller/update_task.php" method="post" id="add-form">
  <h1>タスク編集</h1>
  <input type="hidden" name="item_id" value="<?= $stmt['item_id']; ?>">
  <div class="add-form-box">
    <p>タイトル</p>
    <input type="text" name="item_title" value="<?= $stmt['item_title']; ?>">
  </div>
  
  <div class="add-form-box">
    <p>詳細</p>
    <textarea name="item_detail" id="" cols="24" rows="3"> <?= $stmt['item_detail']; ?></textarea>
  </div>
  
  <div class="add-form-box">
    <p>開始日</p>
    <input type="date" name="item_start_date" value="<?= $stmt['item_start_date']; ?>">
  </div>
  
  <div class="add-form-box">
    <p>終了日</p>
    <input type="date" name="item_end_date" value="<?= $stmt['item_end_date']; ?>">
  </div>

  <div class="add-form-box">
    <input type="submit" value="送信">
  </div>
</form>
