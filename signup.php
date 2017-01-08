<?php
//----------------------注册功能
include './common/common.php';
if (!empty($_POST['username']) || !empty($_POST['password']) || !empty($_POST['repassword']) || !empty($_POST['email'])) {
//----------传入数据
	$time = time();
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$repassword = trim($_POST['repassword']);
	$email = trim($_POST['email']);
	$check_img = strtoupper(trim($_POST['check_img']));
	$table = DB_PREFIX.'user';

	//-----------处理IP
	$ip = $_SERVER['REMOTE_ADDR'];
	if ($ip == '::1') {
		$ip = '127.0.0.1';
	}
	$ip = ip2long($ip);
//用户名是否合法
	if (strlen($username)<6 || strlen($username)>18) {
		$content = error('001');
		display('error.html' ,compact('content'));
		exit();
	}

// ----------判断用户名是否已经存在
	$check_username = select($link , $table , "username" , "username = '$username'");
	if (!empty($check_username)) {
		$content = error('003');
		display('error.html' ,compact('content'));
		exit();
	}


//------------判断密码输入正确
	switch (true) {
//不合法密码
		case (empty($password) || strlen($password)<6):
			$content = error('004');
			display('error.html' ,compact('content'));
			exit();
			break;
//重复密码不一样
		case ($password != $repassword):
			$content = error('005');
			display('error.html' ,compact('content'));
			exit();
			break;
//验证码不正确
		case (strtoupper($_SESSION['verify']) != $check_img):
			$content = error('006');
			display('error.html' ,compact('content'));
			exit();
			break;
	}

//-------------传入data

	$data['username'] = $username;
	$data['password'] = password_hash($password, PASSWORD_DEFAULT);
	$data['email'] = $email;
	$data['ip'] = $ip;
	$data['rtime'] = $time;
	$data['ltime'] = $time;
	$data['coin'] = COIN_REG;//----------新用户奖励50铜
	$data['usergrant'] = '0';//----------新用户权限0



//----------执行插入
	$insert = insert($link , $table , $data);
//----------插入失败
	if (!$insert) {
		$content = error('010');
		display('error.html' ,compact('content'));
		exit();
	}

	//获取用户id
	$insert_id = mysqli_insert_id($link);

	//----------会话控制
	setcookie('username' , $data['username'] , time() + 7*24*3600 , '/');
	setcookie('usergrant' , $data['usergrant'] , time() + 7*24*3600 , '/');
	setcookie('authorid' , $insert_id , time() + 7*24*3600 , '/');
	$_COOKIE['username'] = $data['username'];

//----------调用coin函数 查询金币存到SESSION
	coin($link , $_COOKIE['username']);

//-------页面跳转
	header( 'refresh:3;url='.WEB_SITE.'/index.php' ); 
	echo '注册成功，3s后跳转主页. <br />如未响应, 点击<a href="./index.php">这里</a>.';
}else{

$title = '登录';
display('home/signup.html' , compact('title'));
//关闭数据库
mysqli_close($link);
}