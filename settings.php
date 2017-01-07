<?php
include 'common/common.php';
if (!empty($_POST['submitbtn'])) {

//获取表单数据
	$oPage = $_GET['o'];

//拉取数据库
	$check = select($link , 'tt_user' , "username,password,usergrant,uid" , "username = '{$_COOKIE['username']}'");
	
	switch ($oPage) {
//修改密码
		case '1':
			$NewPassword = trim($_POST['NewPassword']);
			$reNewPassword = trim($_POST['reNewPassword']);
			if (!password_verify($password , $check[0]['password']) && $NewPassword == $reNewPassword) {
				$content = error('002');
				display('error.html' ,compact('content'));
				exit();
			} elseif ($NewPassword !== $reNewPassword) {
				$content = error('005');
				display('error.html' ,compact('content'));
				exit();
			} else {
				$data['password'] = password_hash($NewPassword, PASSWORD_DEFAULT);
			}
			break;
//修改头像
		case '2':
			$hicon = upload('newHicon' , [
											'image/jpeg',
											'image/png',
											'image/gif',
											'image/wbmp',
											'image/bmp',
											'image/jpg',
											] , [
											'jpeg',
											'png',
											'gif',
											'jpg',
											'bmp',
											] , pow(1024,2)*2 , './upload/imgs' , 1);

	//修改成功
			if ($hicon[0] == 1) {
				$data['hicon'] = $hicon[1];
			} else {
	//修改失败，错误号
				$content = $hicon[1];
				display('error.html' ,compact('content'));
				exit();
			}

			break;
//修改签名
		case '3':
			$gragh = trim($_POST['gragh']);
			$data['gragh'] = $gragh;
			break;
//修改信息
		case '4':
			$info = trim($_POST['info']);
			$data['info'] = $info;
			break;
	}
//修改数据库
	$result = update($link , 'tt_user' , $data , "username = '{$_COOKIE['username']}'");
//页面跳转
	if ($result) {
		header( 'refresh:3;url='.WEB_SITE.'/index.php' ); 
		echo '用户信息设置成功，3s后返回首页. <br />如未响应, 点击<a href="./index.php">这里</a>';
	}else{
		$content = error('051');
		display('error.html' ,compact('content'));
		exit();
	}
	
}else{
//页面显示
	$result = select($link , 'tt_user' , 'hicon' , "username = '{$_COOKIE['username']}'");
	$title = '个人设置';
	display('home/settings.html' , compact('title' , 'result'));
}
