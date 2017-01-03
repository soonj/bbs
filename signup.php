<?php

include './common.php';

//----------传入数据
$time = time();
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$repassword = trim($_POST['repassword']);
$email = trim($_POST['email']);
$table = DB_PREFIX.'user';

//-----------处理IP
$ip = $_SERVER['REMOTE_ADDR'];
if ($ip == '::1') {
	$ip = '127.0.0.1';
}
$ip = ip2long($ip);

// ----------判断用户名是否存在
$check_username = select($link , $table , "username" , "username = '$username'");



if (empty($username)) {
	exit('用户名不能为空，请<a href="./html/signup.html">返回</a>重新输入');
}elseif (!empty($check_username)) {
	exit('用户名已存在，请<a href="./html/signup.html">返回</a>重新输入/或者去<a href="./html/signin.html">登录</a>');
}


//------------判断密码输入正确
if (empty($password)) {
	exit('密码不能为空，请<a href="./html/signup.html">返回</a>重新输入');
}elseif(strlen($password)<6){
	exit('密码最低6位数，请<a href="./html/signup.html">返回</a>重新输入');
}elseif ($password != $repassword) {
	exit('两次密码不一样，请<a href="./html/signup.html">返回</a>重新输入'
	);
}
//-------------传入data
$check_img = $_POST['check_img'];
$data['username'] = $username;
$data['password'] = password_hash($password, PASSWORD_DEFAULT);
$data['email'] = $email;
$data['ip'] = $ip;
$data['rtime'] = $time;
$data['ltime'] = $time;
//----------新用户默认头像
$data['hicon'] = './imgs/photo.png';
//----------新用户奖励50铜
$data['coin'] = '50';
//----------新用户权限0
$data['usergrant'] = '0';



//----------执行插入
//----------新用户奖励50铜
$insert_id = insert($link , $table , $data);

if (!$insert_id) {
	exit('注册失败，<a href="./html/signup.html">返回</a>重新注册');
}
$check = select($link , $table , "uid" , "username = '$username' and password = '$password'");
//----------会话控制
setcookie('username' , $data['username'] , time() + 7*24*3600 , '/');
setcookie('usergrant' , $data['usergrant'] , time() + 7*24*3600 , '/');
setcookie('authorid' , $check[0]['uid'] , time() + 7*24*3600 , '/');
$_COOKIE['username'] = $data['username'];



$hey_money= select($link , DB_PREFIX.'user' , 'coin' , "username = '{$_COOKIE['username']}'");
//----------金/银/铜转换  存到SESSION
$coin = $hey_money[0]['coin'];
$coin_gold = floor($coin/10000);
$coin_silver = floor($coin/100)-$coin_gold*100;
$coin_bronze = $coin-$coin_gold*10000-$coin_silver*100;
$_SESSION['coin_gold'] = $coin_gold;
$_SESSION['coin_silver'] = $coin_silver;
$_SESSION['coin_bronze'] = $coin_bronze;



//-------页面跳转
header( "refresh:3;url=./index.php" ); 

echo '注册成功，3s后跳转主页. <br />如未响应, 点击<a href="./index.php">这里</a>.';

//关闭数据库
mysqli_close($link);