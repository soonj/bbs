<?php


include './common/common.php';
//传值判断
if (!empty($_GET['q'])) {
	$username = $_GET['q'];
	$title = $username.'的详细信息';
	$result = select($link , 'tt_user' , 'username,email,hicon,gragh,info' , "username = '$username'");

	display('home/member.html' , compact('result' , 'title'));
} else {
	$title = '详细信息';
	$result = '';
	display('home/member.html' , compact('result' , 'title'));
}
