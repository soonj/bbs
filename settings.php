<?php

include './common.php';

//获取表单数据
if (!empty($_POST['newHicon']) || !empty($_POST['gragh']) || !empty($_POST['info'])) {
//拉取数据库
	$check = select($link , 'tt_user' , "username,password,usergrant,uid" , "username = '{$_COOKIE['username']}'");
//没有修改密码
	if (empty($_POST['NewPassword'])) {
		$data['newHicon'] = $_POST['newHicon'];
		$data['gragh'] = $_POST['gragh'];
		$data['info'] = $_POST['info'];
//执行修改密码
	} elseif (!password_verify($_POST['password'] , $check[0]['password'])) {
		header( 'refresh:3;url='.DOMAIN_RESOURCE.'/html/error.html' ); 
	} elseif ($_POST['NewPassword'] != $_POST['reNewPassword']) {
		header( 'refresh:3;url='.DOMAIN_RESOURCE.'/html/error.html' ); 
	}else {
//传值
		$data['password'] = password_hash($_POST['NewPassword'], PASSWORD_DEFAULT);
		$data['hicon'] = $_POST['newHicon'];
		$data['gragh'] = $_POST['gragh'];
		$data['info'] = $_POST['info'];
	}

//修改数据库
	$result = update($link , 'tt_user' , $data , "username = '{$_COOKIE['username']}'");


//页面跳转
	header( 'refresh:3;url='.DOMAIN_RESOURCE.'/index.php' ); 
	echo '用户信息设置成功，3s后返回首页. <br />如未响应, 点击<a href="./index.php">这里</a>';



}else{
	$result = select($link , 'tt_user' , 'hicon' , "username = '{$_COOKIE['username']}'");


	include './html/header.html';
	include './html/settings.html';
}
