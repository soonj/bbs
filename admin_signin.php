<?php
//----------------------登录功能
include 'common/common.php';

if (!empty($_POST['submit'])) {
//----------传入数据
	$now_time = time();
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$check_img = strtoupper(trim($_POST['check_img']));
	$table = DB_PREFIX.'user';

// ----------判断用户名密码是否正确
	$check = select($link , $table , "username,password,usergrant,uid" , "username = '$username'");

	switch (true) {
//------------空用户名空密码
		case (empty($username) || empty($password)):
			$content = error('001');
			display('error.html' ,compact('content'));
			exit();
			break;
//------------密码错误
		case (!password_verify($password , $check[0]['password'])):
			$content = error('002');
			display('error.html' ,compact('content'));
			exit();
			break;
//---------------验证码不正确
		case (strtoupper($_SESSION['verify']) != $check_img):
			$content = error('006');
			display('error.html' ,compact('content'));
			exit();
			break;
//-------------判断是否是管理员
		case ($check[0]['usergrant'] != 7):
			$content = error('061');
			break;
//------------验证通过
		default:
//--------------会话控制		
			setcookie('admin' , $check[0]['username'] , time() + 7*24*3600 , '/');
			setcookie('usergrant' , $check[0]['usergrant'] , time() + 7*24*3600 , '/');
			setcookie('authorid' , $check[0]['uid'] , time() + 7*24*3600 , '/');
			
//-----------页面跳转
				header( 'refresh:3;url='.WEB_SITE.'/admin.php?q=1' ); 
				echo '登录成功，3s后跳转. <br />如未响应, 点击<a href="'.WEB_SITE.'/admin.php?q=1">这里</a>.';
			break;
	}
	
} else {
		$title = '管理员登录';
		display('admin/signin.html' , compact('title'));
		//关闭数据库
		mysqli_close($link);
}