<?php
include './common.php';
if (!empty($_POST['newHicon']) || !empty($_POST['gragh']) || !empty($_POST['info'])) {

//获取表单数据
	$password = trim($_POST['password']);
	$NewPassword = trim($_POST['NewPassword']);
	$newHicon = trim($_POST['newHicon']);
	$gragh = trim($_POST['gragh']);
	$info = trim($_POST['info']);
//拉取数据库
	$check = select($link , 'tt_user' , "username,password,usergrant,uid" , "username = '{$_COOKIE['username']}'");
	
	switch (true) {
//没有修改密码
		case (empty($NewPassword)):	
			$data['newHicon'] = $newHicon;
			$data['gragh'] = $gragh;
			$data['info'] = $info;
			break;
//执行修改密码
		case (!password_verify($password , $check[0]['password'])):
			exit('原始密码不正确，请<a href="./settings.php">返回</a>重新输入');
			break;
		case ($NewPassword != $reNewPassword):
			exit('两次密码不同，请<a href="./settings.php">返回</a>重新输入');
			break;
//密码修改传值		
		default:
			$data['password'] = password_hash($NewPassword, PASSWORD_DEFAULT);
			$data['hicon'] = $newHicon;
			$data['gragh'] = $gragh;
			$data['info'] = $info;
			break;
	}
//修改数据库
	$result = update($link , 'tt_user' , $data , "username = '{$_COOKIE['username']}'");
//页面跳转
	header( 'refresh:3;url='.DOMAIN_RESOURCE.'/index.php' ); 
	echo '用户信息设置成功，3s后返回首页. <br />如未响应, 点击<a href="./index.php">这里</a>';

}else{
//页面显示
	$result = select($link , 'tt_user' , 'hicon' , "username = '{$_COOKIE['username']}'");


	include './html/header.html';
	include './html/settings.html';
}
