<?php
	header('content-type:text/html; charset=utf-8;');
	
	
	include './config/config.php';//全局配置
	include './config/database.php';//数据库配置
	include './helper/mysql_func.php';//加载数据库函数
	//include './helper/paginate.php';//加载分页函数
	include './helper/tpl_func.php';//加载模版引擎函数


	session_start();
	$link = connect(DB_HOST , DB_USER , DB_PASS , DB_CHARSET , DB_NAME);
	