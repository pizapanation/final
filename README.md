
# final

## 制作情報

 - 学籍番号<br>
 2201368
 - クラス<br>
 F
 - 氏名<br>
 瀧下正太郎
 - システム名<br>
  COFFEE
 - URL<br>
  [COFFEE](https://aso2201368.zombie.jp/COFFEE/Public/login.php)

## 概要

タスク管理ができるシステムです。  
spファーストで作成しました。  
いくつかの機能をLibsにまとめ、拡張性を意識して作成しました。

## 使用方法

1. データベースについて

 - 作成したデータベースに「createTable.sql」を1から順にインポートしてください

2. コードについて

 - src/COFFEE/ConfigにあるDBSettingのstatic定数を適切に設定してください


## 構造


COFFEE.
|   bootstrap.php
|   main.txt
|   README.md
|
+---.vscode
|       settings.json
|
+---Config
|       DBSettings.php
|       DirectorySettings.php
|
+---controller
|       add_task.php
|       check_login.php
|       completed_task.php
|       delete_task.php
|       logout.php
|       register_login.php
|       task_data.php
|       uncompleted_task.php
|       update_task.php
|
+---Libs
|   +---App
|   |       CoffeeSession.php
|   |
|   +---Core
|   |       AutoLoader.php
|   |
|   +---DB
|   |   |   DBFunctions.php
|   |   |
|   |   \---Interface
|   |           DbFunctions_interface.php
|   |
|   +---Https
|   |       Request.php
|   |
|   \---Session
|           Session.php
|
+---Public
|   |   achieved.php
|   |   addTasks.php
|   |   calendar.php
|   |   list.php
|   |   login.php
|   |   main.php
|   |   updateTasks.php
|   |
|   +---css
|   |       common.css
|   |       login.css
|   |       main.css
|   |
|   \---script
|           login.js
|           script.js
|
\---sql
        coffee.pu
        createTable1.sql
        createTable2.sql

