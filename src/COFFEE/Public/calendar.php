<?php

  require_once '../bootstrap.php';

  use Libs\App\CoffeeSession;
  use Libs\Https\Request;
  use Libs\DB\DBFunctions;

  $session=new CoffeeSession;
  $request=new Request;
  $dbf=new DBFunctions;

  //カレンダー作成
  $month=$request->get('month',trim(date('m'),"0"));
  $year=$request->get('year',date('Y'));
  $preventYear=($month-1===0)?$year-1:$year;
  $preventMonth=($month-1===0)?12:$month-1;
  $nextYear=($month+1===13)?$year+1:$year;
  $nextMonth=($month+1===13)?1:$month+1;
  $daysOfWeeks = array('日','月', '火', '水', '木', '金', '土');
  $firstDayOfMonth=mktime(0,0,0,$month,1,$year);
  $weekCycle=date('w',$firstDayOfMonth);
  $daysInMonth=date('t',$firstDayOfMonth);
  $currentDay=1;


  //データベース
  $sql='
    SELECT 
      DAY(item_start_date) AS day 
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
    ;
  ';
  $stmt=$dbf->fetch_all_query($sql,[$session->getSession('user_id'),$year,$month]);
  $events=[];
  foreach($stmt as $row){
    $events[$row['day']]=$row;
  }

?>
<?php if(empty($stmt)):?>
  <p>予定がありません</p>
<?php endif; ?>
<div class="user-task"><?= $session->getSession('user_name'); ?>さんの予定</div>
<p><?= $session->getMessage(); ?></p>
<p><?= $session->getErrorMessage(); ?></p>

<div class="display-month">
  <p id="prevent-month" class="month-btn" year="<?= $preventYear; ?>" month="<?= $preventMonth; ?>">前の月</p>
  <p id="current-state" current-year="<?= $year; ?>" current-month="<?= $month; ?>"><?= $year; ?>年<?= $month; ?>月</p>
  <p id="next-month" class="month-btn" year="<?= $nextYear; ?>" month="<?= $nextMonth; ?>">次の月</p>
</div>
<table id="calendar">
  <tr>
    <?php foreach($daysOfWeeks as $daysOfWeek): ?>
      <th><?= $daysOfWeek; ?></th>
    <?Php endforeach; ?>
  </tr>
  <tr>
    <?php if($weekCycle>0):?>
      <td colspan="<?= $weekCycle; ?>">&nbsp;</td>
    <?php endif; ?>
    <?php while($currentDay<=$daysInMonth): ?>
      <?php if($weekCycle==7): $weekCycle=0;?>
        </tr><tr>
      <?php endif; ?>      
      <td class="<?= isset($events[$currentDay])?'event-day':''; ?>"><?= $currentDay; ?></td>
      <?php
        $currentDay++;
        $weekCycle++;
      ?>
    <?php endwhile; ?>
    <?php if($weekCycle!==7): ?>
      <td colspan="<?= (7-$weekCycle); ?>">&nbsp;</td>
    <?php endif; ?>
  </tr>
</table>
<hr>
<div id="task-box" class="hidden">
  <ul>

  </ul>
</div>

