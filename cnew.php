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
//var_dump($_POST);


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




$insert_id = insert($link , $table , $data);

if (!$insert_id) {
	exit('创建主题失败，<a href="./new.php">返回</a>');
}

//关闭数据库
mysqli_close($link);
