<?php
	session_start();
	define ('WEB_SITE' , str_replace('\\' , '/' , __DIR__).'/');
	define ('DOMAIN_RESOURCE' , "http://localhost/PHP1606/BBS");
	
	include WEB_SITE.'config/config.php';
	include WEB_SITE.'func/mysql_func.php';
	
	$link = connect(DB_HOST , DB_USER , DB_PASS , DB_CHARSET , DB_NAME);