<?php

include './common.php';

//取得回复用户信息
$cip = $_SERVER['REMOTE_ADDR'];
if ($cip == '::1') {
	$cip = '127.0.0.1';
}
$cip = ip2long($cip);
$data['cip'] = $cip;
$data['ctime'] = time();



//取得表单传值
$data['authorid'] = $_COOKIE['authorid'];
$data['content'] = $_POST['content'];
$data['rid'] = $_POST['once'];
$update['rcount'] = $_POST['rcount'];
$table = DB_PREFIX.'post';









//查询当前金币数目
$coin['coin'] = $_SESSION['coin_gold']*10000+$_SESSION['coin_silver']*100+$_SESSION['coin_bronze'];


//--------金币足够支付回复
if ($coin['coin'] > 5 ) {
//----------数据库插入
	$result_insert = insert($link , $table , $data);

//----------主题回复数更新
	$result_update = update($link , $table , $update , 'pid = '.$data['rid']);

//----------回帖扣除金币			
	update($link , 'tt_user' , $coin , "uid = {$data['authorid']}");

//----------扣除后金币查询
	$hey_money = select($link , DB_PREFIX.'user' , 'coin' , "username = '{$_COOKIE['username']}'");

//----------金/银/铜转换
	$coin = $hey_money[0]['coin'];
	$coin_gold = floor($coin/10000);
	$coin_silver = floor($coin/100)-$coin_gold*100;
	$coin_bronze = $coin-$coin_gold*10000-$coin_silver*100;
	$_SESSION['coin_gold'] = $coin_gold;
	$_SESSION['coin_silver'] = $coin_silver;
	$_SESSION['coin_bronze'] = $coin_bronze;

//-----------成功页面跳转
	header( "refresh:3;url=./t.php?post={$data['rid']}" ); 
	echo '发表回复成功，3s后返回主题. <br />如未响应, 点击<a href="./t.php?post='.$data['rid'].'">这里</a>';
}else{
//---------金币不能支付回复失败跳转
	header( "refresh:3;url=./t.php?post={$data['rid']}" ); 
	echo '发表回复失败，您没有足够的金币来支付此次回复=。=<br />3s后返回主题. 如未响应, 点击<a href="./t.php?post='.$data['rid'].'">这里</a>';
}






//关闭数据库
mysqli_close($link);

