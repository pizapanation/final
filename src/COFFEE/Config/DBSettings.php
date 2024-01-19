<?php

  namespace Config;

  class DBSettings{

  // //ローカルホストDB接続
  public const SERVER='127.0.0.1';//ローカルホスト
  public const DBNAME='COFFEE-final';
  public const USER='root';//ローカルホスト
  public const PASS='';
  public const CONNECT='mysql:host='.self::SERVER.';dbname='.self::DBNAME.';charset=utf8';

  //本接続
  // public const SERVER='mysql213.phy.lolipop.lan';
  // public const DBNAME='LAA1518082-final';
  // public const USER='LAA1518082';
  // public const PASS='Pass0916';
  // public const CONNECT='mysql:host='.self::SERVER.';dbname='.self::DBNAME.';charset=utf8';
  
  }

