<?php

  require_once '../bootstrap.php';

  use Config\DirectorySettings;
  use Libs\App\CoffeeSession;
  use Libs\Https\Request;

  $session=new CoffeeSession;
  $request=new Request;

  $session->destroySession();
  $request->redirect(DirectorySettings::COFFEE_PUBLIC."login.php");

