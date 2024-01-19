<?php

  require_once '../bootstrap.php';

  use Libs\App\CoffeeSession;
  use Libs\DB\DBFunctions;

  $session=new CoffeeSession;
  $dbf=new DBFunctions;

  $sql='
    SELECT 
      * 
    FROM 
      Items 
    WHERE 
      user_id=? 
    AND 
      completed_task=true 
    ;
  ';

  $stmt=$dbf->fetch_all_query($sql,[$session->getSession('user_id')]);
  if(empty($stmt)):
?>
<p>達成タスクがありません</p>
<?php endif; ?>
<div class="user-task"><?= $session->getSession('user_name'); ?>さんの達成タスク</div>
<p><?= $session->getMessage(); ?></p>
<p><?= $session->getErrorMessage(); ?></p>
<ul>
    <?php foreach($stmt as $row): ?>
      <li><strong><?= $row['item_title']; ?></strong></li>
      <dl>
        <dt>詳細</dt>
        <dd><?= $row['item_detail']; ?></dd>
        <dt>開始日</dt>
        <dd><?= $row['item_start_date']; ?></dd>
        <dt>終了日</dt>
        <dd><?= $row['item_end_date']; ?></dd>
        <dt>操作</dt>
        <dd>
          <button type="submit" onclick="location.href='../controller/uncompleted_task.php?id=<?= $row['item_id']; ?>'">未達成</button>
          <button type="submit" onclick="location.href='../controller/delete_task.php?id=<?= $row['item_id']; ?>'">削除</button>
        </dd>
      </dl>
    <?php endforeach; ?>
</ul>

