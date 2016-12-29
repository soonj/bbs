<?php
  session_start();
  setcookie('username','',time()-1,'/');
  unset($_SESSION['coin_gold']);
  unset($_SESSION['coin_silver']);
  unset($_SESSION['coin_bronze']);


  session_destroy();

  header( "refresh:3;url=./index.php" ); 
  echo '退出成功，3s后跳转主页. <br />如未响应, 点击<a href="./index.php">这里</a>.';
?> 
