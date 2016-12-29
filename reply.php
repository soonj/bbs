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



//数据库插入
$result_insert = insert($link , $table , $data);

//主题回复数+1
$result_update = update($link , $table , $update['rcount'] , 'pid = '.$data['rid']);


//回帖扣除金币
$coin['coin'] = $_SESSION['coin_gold']*10000+$_SESSION['coin_silver']*100+$_SESSION['coin_bronze']-5;
update($link , 'tt_user' , $coin , "uid = {$data['rid']}");

//页面跳转
header( "refresh:3;url=./t.php?post={$data['rid']}" ); 
echo '登录成功，3s后返回主题. <br />如未响应, 点击<a href="./t.php?post='.$data['rid'].'>这里</a>';




//关闭数据库
mysqli_close($link);