<?php
include './common/common.php';

//当前时间
$time = time();
$title = '日常任务';

if (empty($_COOKIE['username'])) {
	$title = '登录';
	display('home/signup.html' , compact('title'));
	exit();
}

if (empty($_POST['hidden'])) {
		display('home/balance.html' , compact('title' , 'time'));
} else {
		$rand = mt_rand(10,100);
		update($link , 'tt_user' , "coin=coin+$rand" , "username = '{$_COOKIE['username']}'");
		coin($link , $_COOKIE['username']);
		$_SESSION['daily'] = $time;
		display('home/balance.html' , compact('title' , 'time' , 'rand'));
}


