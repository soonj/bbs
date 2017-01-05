<?php

include './common/common.php';

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
$data['content'] = trim($_POST['content']);
$data['rid'] = $_POST['once'];
$table = DB_PREFIX.'post';


if (strlen($data['content'])<15) {
	$content = error('032');
	display('error.html' , compact('content'));
	exit();
}

//--------金币足够支付回复
$coin['coin'] = $_SESSION['coin_gold']*10000+$_SESSION['coin_silver']*100+$_SESSION['coin_bronze'];
if ($coin['coin'] > 5 ) {
//----------数据库插入
	$result_insert = insert($link , $table , $data);
	if(!$result_insert){
		header( "refresh:3;url=./t.php?post={$data['rid']}" ); 
		echo '发表回复失败，3s后返回主题. <br />如未响应, 点击<a href="./t.php?post='.$data['rid'].'">这里</a>';
		exit();
	}
//----------主题回复数更新
	update($link , $table , 'rcount=rcount+1' , 'pid = '.$data['rid']);

//----------回帖扣除金币			
	update($link , 'tt_user' , 'coin=coin-5' , "uid = {$data['authorid']}");

//----------扣除后金币查询
	coin($link , $_COOKIE['username']);

//-----------成功页面跳转
	header( "refresh:3;url=./t.php?post={$data['rid']}" ); 
	echo '发表回复成功，3s后返回主题. <br />如未响应, 点击<a href="./t.php?post='.$data['rid'].'">这里</a>';
} else {
//---------金币不能支付回复失败跳转
		$content = error('888');
		display('error.html' , compact('content'));
		exit();
}






//关闭数据库
mysqli_close($link);

