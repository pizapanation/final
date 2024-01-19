<?php 
  require_once '../bootstrap.php';

  use Libs\App\CoffeeSession;

  $session=new CoffeeSession();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/login.css">
  <script defer src="./script/login.js"></script>
</head>

<body>
  <main>
    <h1></h1>
    <p class="error-message"><?= $session->getErrorMessage(); ?></p>
    <div class="container">

      <div class="buttons">
        <span id="login-btn"></span>
        <span id="register-btn"></span>
      </div>
      <form action="" method="post">
        <div id="form">

          <div id="name-box" class="form-box">
            <p>登録名</p>
            <input type="text" name="user_name">
          </div>

          <div class="form-box">
            <p id="id_str"></p>
            <input type="text" name="user_email">
          </div>

          <div class="form-box">
            <p>パスワード</p>
            <input type="password" name="user_password">
          </div>

          <div class="form-box">
            <input type="submit" value="">
          </div>

        </div>
      </form>

    </div>
  </main>
</body>

</html>