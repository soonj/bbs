<?php

include './common/common.php';

//--------------用户登录判断
if (empty($_COOKIE['username'])) {
	$content = error('011');
	display('error.html' , compact('content'));
	exit();
}
//表单传值验证
if (!empty($_POST['title'])) {

//------------接受表单传值
		$ctime = time();
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		$check_img = trim($_POST['check_img']);
		$table = DB_PREFIX.'post';
//-------------处理IP
		$cip = $_SERVER['REMOTE_ADDR'];
		if ($cip == '::1') {
			$cip = '127.0.0.1';
		}
		$cip = ip2long($cip);

		$check_title = select($link , $table , "title,ctime" , "title = '$title'");
		switch (true) {
//-------------主题字数验证
			case (strlen($_POST['title']) < 6):
				$content = error('021');
				display('error.html' , compact('content'));
				exit();
				break;
//-------------防风怒
			case (!empty($check_title) && ($ctime - $check_title[0]['ctime']) < 20):
				$content = error('022');
				display('error.html' , compact('content'));
				exit();
				break;
			case (strtoupper($_SESSION['verify']) != $check_img):
				$content = error('006');
				display('error.html' ,compact('content'));
				exit();
				break;
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
			insert($link , $table , $data);
			$insert_id = mysqli_insert_id($link);
//----------创建主题失败
			if (!$insert_id) {
				$content = error('022');
				display('error.html' , compact('content'));
				exit();
			}
//----------发表主题扣除金币			
			update($link , 'tt_user' , 'coin=coin-10' , "uid = {$data['authorid']}");
//-----------现有金币覆盖
			coin($link , $_COOKIE['username']);
//-----------成功页面跳转
			header( 'refresh:3;url='.WEB_SITE.'/t.php?post='.$insert_id); 
			echo '发表主题成功，3s后进入主题. <br />如未响应, 点击<a href="'.WEB_SITE.'/index.php">这里</a>';
		} else {
//---------金币不能支付
			$content = error('888');
			display('error.html' , compact('content'));
			exit();
		}

} else {
		$title = '发表主题';
		display('home/new.html' , compact('title'));
	//----------关闭数据库
		mysqli_close($link);
}