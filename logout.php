<?php
  session_start();
  setcookie('username','',time()-1,'/');
  setcookie('admin','',time()-1,'/');
  unset($_SESSION['coin_gold']);
  unset($_SESSION['coin_silver']);
  unset($_SESSION['coin_bronze']);


  session_destroy();

  if ($_COOKIE['usergrant']==7) {
  	header( "refresh:3;url=./admin.php" ); 
  	echo '退出成功，3s后跳转. <br />如未响应, 点击<a href="./admin.php">这里</a>.';
  }else{
  header( "refresh:3;url=./index.php" ); 
  echo '退出成功，3s后跳转. <br />如未响应, 点击<a href="./index.php">这里</a>.';
}
?> 
