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

// ----------数据库拉取数据
	$check = select($link , $table , "username,password,usergrant,uid" , "username = '$username'");

	switch (true) {
//------------空用户名空密码
		case (empty($username) || empty($password)):
			$content = error('001');
			display('error.html' ,compact('content'));
			exit();
			break;
//---------------验证码不正确
		case (strtoupper($_SESSION['verify']) != $check_img):
			$content = error('006');
			display('error.html' ,compact('content'));
			exit();
			break;
//---------------锁定用户
		case (!empty($_SESSION[$username])):
			if (time() - $_SESSION[$username] < 3600) {
				$content = error('007');
				display('error.html' ,compact('content'));
				exit();
			}else{
				update($link , DB_PREFIX.'user' , 'usergrant = 0' , "username = '$username'");
				unset($_SESSION[$username]);
				$content = error('002');
				display('error.html' ,compact('content'));
				exit();
			}
			break;

//------------密码错误
		case (!password_verify($password , $check[0]['password'])):
			update($link , DB_PREFIX.'user' , 'usergrant=usergrant+1' , "username = '$username'");
			if ($check[0]['usergrant'] == 4) {
				$_SESSION[$username] = time();
			}
			$content = error('002');
			display('error.html' ,compact('content'));
			exit();
			break;

//---------------Ban用户
		case ($check[0]['usergrant'] == 999):
			$content = error('061');
			display('error.html' ,compact('content'));
			exit();
			break;

		
//------------验证通过
		default:
//--------------会话控制		
			update($link , DB_PREFIX.'user' , 'usergrant = 0' , "username = '$username'");
			setcookie('username' , $check[0]['username'] , time() + 7*24*3600 , '/');
			setcookie('usergrant' , $check[0]['usergrant'] , time() + 7*24*3600 , '/');
			setcookie('authorid' , $check[0]['uid'] , time() + 7*24*3600 , '/');
			$_COOKIE['username'] = $check[0]['username'];

			if (!empty($_COOKIE['username'])) {
//----------用户所持金币查询
				coin($link , $_COOKIE['username']);
//-----------页面跳转
				header( 'refresh:3;url='.WEB_SITE.'/index.php' ); 
				echo '登录成功，3s后跳转主页. <br />如未响应, 点击<a href="'.WEB_SITE.'/index.php">这里</a>.';
			}else{
				$content = error();
				display('error.html' ,compact('content'));
				exit();
			}
			break;
	}
	
} else {
		$title = '登录';
		display('home/signin.html' , compact('title'));
		//关闭数据库
		mysqli_close($link);
}