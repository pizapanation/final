<?php
  require_once __DIR__.'/Config/DirectorySettings.php';
  require_once __DIR__.'/Libs/Core/AutoLoader.php';

  use Libs\Core\AutoLoader;
  use Config\DirectorySettings;

  $auto_loader=new AutoLoader(DirectorySettings::APPLICATION_ROOT_DIR);
  $auto_loader->run();



