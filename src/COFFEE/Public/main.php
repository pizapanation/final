<?php
require_once '../bootstrap.php';

use Libs\Session\Session;

$session = new Session();

if (!$session->getSession('login')) {
  header('location:./login.php');
  exit;
}
$weekdays = array("日", "月", "火", "水", "木", "金", "土");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>メインページ</title>
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/main.css">
  <script defer src="https://kit.fontawesome.com/1943c39f7d.js" crossorigin="anonymous"></script>
  <script defer src="./script/script.js"></script>
</head>

<body>
  <header>
    <span><?= date('Y年m月d日').'('.$weekdays[date('w')].')'; ?></span>
    <i class="fa-solid fa-gear" id="menu"></i>
  </header>
  <main>

    <div id="list"></div>
    <div id="achieved"></div>
    <div id="calendar"></div>
    <div id="addTasks"></div>
    <div id="updateTasks"></div>
    <div id="hamburger" class="hidden">
      <a href="../controller/logout.php" id="logout">ログアウト</a>
    </div>
   
  </main>
  <!-- 画面表示操作 -->
  <div class="operations">

    <div>
      <button id="list-btn">
        <i class="fa-solid fa-list icon"></i>
      </button>
      <span>List</span>
    </div>
    <div>
      <button id="achieved-btn">
        <i class="fa-regular fa-circle-check"></i>
      </button>
      <span>Achieved</span>
    </div>
    <div>
      <button id="calendar-btn">
        <i class="fa-solid fa-calendar-days"></i>
      </button>
      <span>Calendar</span>
    </div>
    <div>
      <button id="addTasks-btn">
        <i class="fa-solid fa-circle-plus"></i>
      </button>
      <span>Add</span>
    </div>
  </div>

</body>

</html>