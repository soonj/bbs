<?php

include './common.php';


//--------------用户登录判断
if (empty($_COOKIE['username'])) {
	echo '尚未登录，不能发表主题，请<a href="./html/signin.html">登录</a>';
	exit();
}


//------------接受表单传值
$ctime = time();
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$authoid = $_POST['once'];
$table = DB_PREFIX.'post';


//-------------处理IP
$cip = $_SERVER['REMOTE_ADDR'];
if ($cip == '::1') {
	$cip = '127.0.0.1';
}
$cip = ip2long($cip);


$check_title = select($link , $table , "title,ctime" , "title = '$title'");
if (empty($title)) {
	exit('标题不能为空，请<a href="./new.php">重新发表</a>/<a href="./index.php">返回主页</a>');
}elseif(!empty($check_title) && ($ctime - $check_title[0]['ctime']) < 10){
	exit('服务器风怒了，请10s后<a href="./new.php">重新发表</a>/<a href="./index.php">返回主页</a>');
}

//----------------数据插入
$data['authorid'] = $_COOKIE['authorid'];
$data['title'] = $title;
$data['content'] = $content;
$data['ctime'] = $ctime;
$data['cip'] = $cip;
$data['nodename'] = $_POST['node_name'];
$data['rid'] = 0;


//查询当前金币数目
$coin['coin'] = $_SESSION['coin_gold']*10000+$_SESSION['coin_silver']*100+$_SESSION['coin_bronze'];


//--------金币足够支付发表主题
if ($coin['coin'] > 10 ) {
//----------数据库插入
	$insert_id = insert($link , $table , $data);
	if (!$insert_id) {
		exit('创建主题失败，请<a href="./new.php">返回</a>');
	} else {
//----------发表主题扣除金币			
		$coin['coin'] = $coin['coin'] - 10;
		update($link , 'tt_user' , $coin , "uid = {$data['authorid']}");

//----------扣除后金币查询
		$hey_money = select($link , DB_PREFIX.'user' , 'coin' , "username = '{$_COOKIE['username']}'");

//----------金/银/铜转换
		$coin = $hey_money[0]['coin'];
		$coin_gold = floor($coin/10000);
		$coin_silver = floor($coin/100)-$coin_gold*100;
		$coin_bronze = $coin-$coin_gold*10000-$coin_silver*100;
//-----------SESSION重置
		$_SESSION['coin_gold'] = $coin_gold;
		$_SESSION['coin_silver'] = $coin_silver;
		$_SESSION['coin_bronze'] = $coin_bronze;
//-----------成功页面跳转
		header( 'refresh:3;url='.DOMAIN_RESOURCE.'/index.php' ); 
		echo '发表主题成功，3s后返回首页. <br />如未响应, 点击<a href="./index.php">这里</a>';
		}
} else {
//---------金币不能支付回复失败跳转
		header( 'refresh:3;url='.DOMAIN_RESOURCE.'/index.php' ); 
		echo '发表主题失败，3s后返回首页. <br />如未响应, 点击<a href="./index.php">这里</a>';
}

//关闭数据库
mysqli_close($link);
