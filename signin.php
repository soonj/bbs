<?php
//----------------------登录功能
include './common.php';

//----------传入数据
$time = time();
$username = trim($_POST['username']);
$password = md5(trim($_POST['password']));
$table = DB_PREFIX.'user';


// ----------判断用户名密码是否正确
$check = select($link , $table , "username,usergrant,uid" , "username = '$username' and password = '$password'");

if (empty($username) || empty($password)) {
	exit('用户名或密码不能为空，请<a href="./html/signin.html">返回</a>重新输入');
} elseif (empty($check)) {
	exit('用户名或密码不正确，请<a href="./html/signin.html">返回</a>重新输入');
} else {
//--------------会话控制		
		setcookie('username' , $check[0]['username'] , time() + 7*24*3600 , '/');
		setcookie('usergrant' , $check[0]['usergrant'] , time() + 7*24*3600 , '/');
		setcookie('authorid' , $check[0]['uid'] , time() + 7*24*3600 , '/');
		$_COOKIE['username'] = $check[0]['username'];

//----------用户所持金币查询
		if (!empty($_COOKIE['username'])) {
			$hey_money= select($link , DB_PREFIX.'user' , 'coin' , "username = '{$_COOKIE['username']}'");

//----------金/银/铜转换
			$coin = $hey_money[0]['coin'];
			$coin_gold = floor($coin/10000);
			$coin_silver = floor($coin/100)-$coin_gold*100;
			$coin_bronze = $coin-$coin_gold*10000-$coin_silver*100;
			$_SESSION['coin_gold'] = $coin_gold;
			$_SESSION['coin_silver'] = $coin_silver;
			$_SESSION['coin_bronze'] = $coin_bronze;

//-----------页面跳转
			header( 'refresh:3;url='.DOMAIN_RESOURCE.'/index.php' ); 
			echo '登录成功，3s后跳转主页. <br />如未响应, 点击<a href="./index.php">这里</a>.';
			}
		}




//关闭数据库
mysqli_close($link);