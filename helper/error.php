<?php
/*
*错误页面函数
*@param $error string
*@param return string
*/



//////////////////////////////
//	登录错误
//	00?
//		-1	空用户名或空密码
//		-2	用户名或密码不正确
//		-3  用户名已存在
//		-4  输入的密码不合法
//		-5  两次密码不同
//		-6  验证码不正确
//		-7  密码错误次数过多，请一小时后再来
//
//
//	注册错误
//	01?
//		-0  注册失败
//		-1	未登录
//			
//	发表主题错误
//	02?
//		-1	发表失败
//		-2  风怒
//
//	回复错误
//	03?
//		-1  回复失败
//		-2  字数限制
//
//	文件错误
//	04?
//		-4  文件未找到
//
//	修改信息错误
//	05?
//		-1  修改数据库失败
//		-2	请勾选需要更改的条目
//
//
//	权限错误
//	06?
//		-1	请使用正确的管理员账号
//		-2  您的账号已被锁定，注意行为规范
//		-3  网站已关闭
//	支付错误
//	888
//	
//////////////////////////////
function error($error=null) 
{
	switch ($error) {
		case '001':
			$content = 'error#001~用户名或密码不可用';
			break;
		case '002':
			$content = 'error#002~用户名或密码不正确';	
			break;
		case '003':
			$content = 'error#003~用户名已存在';
			break;
		case '004':
			$content = 'error#004~输入的密码不合法';
			break;
		case '005':
			$content = 'error#005~两次密码不同';
			break;
		case '006':
			$content = 'error#006~验证码不正确';
			break;
		case '007':
			$content = 'error#007~密码错误次数过多，请一小时后再来';
			break;
		case '010':
			$content = 'error#010~注册失败';
			break;
		case '011':
			$content = 'error#011~未登录';
			break;
		case '021':
			$content = 'error#021~发表主题失败';
			break;
		case '022':
			$content = '#_# 服务器抽风了，请重试';
			break;
		case '031':
			$content = 'error#031~发表回复失败';
			break;
		case '032':
			$content = 'error#032~需要字数补丁';
			break;
		case '044':
			$content = 'error#044~文件未找到';
			break;
		case '051':
			$content = 'error#051~修改数据失败';
			break;
		case '052':
			$content = 'error#051~请勾选需要更改的条目';
			break;
		case '061':
			$content = 'error#061~请使用正确的管理员账号';
			break;
		case '062':
			$content = 'error#062~您的账号已被锁定，注意行为规范';
			break;
		case '063':
			$content = 'error#063~网站已关闭';
			break;
		case '888':
			$content = 'error#888~金币不足了，再攒攒吧';
			break;
	}
	return $content;
}