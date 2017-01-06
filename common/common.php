<?php
	header('content-type:text/html; charset=utf-8;');
	
	
	include './config/config.php';//全局配置
	include './config/database.php';//数据库配置
	include './helper/mysql_func.php';//加载数据库函数
	include './helper/paginate.php';//加载分页函数
	include './helper/tpl_func.php';//加载模版引擎函数
	include './helper/error.php';//加载错误处理函数
	include './helper/coin.php';//加载金币查询函数
	include './parsedown/Parsedown.php';//导入Markdown文件
	include './helper/code.php';//加载验证码函数


	session_start();
	$link = connect(DB_HOST , DB_USER , DB_PASS , DB_CHARSET , DB_NAME);
	