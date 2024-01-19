<?php

  require_once '../bootstrap.php';

  use Libs\App\CoffeeSession;

  $session=new CoffeeSession;
  
?>
<form action="../controller/add_task.php" method="post" id="add-form">
  <h1>新規タスク追加</h1>
  <input type="hidden" name="user_id" value="<?= $session->getSession('user_id') ?>">
  <div class="add-form-box">
    <p>タイトル</p>
    <input type="text" name="item_title">
  </div>
  
  <div class="add-form-box">
    <p>詳細</p>
    <textarea name="item_detail" id="" cols="24" rows="3"></textarea>
  </div>
  
  <div class="add-form-box">
    <p>開始日</p>
    <input type="date" name="item_start_date">
  </div>
  
  <div class="add-form-box">
    <p>終了日</p>
    <input type="date" name="item_end_date">
  </div>

  <div class="add-form-box">
    <input type="submit" value="送信">
  </div>
</form>
