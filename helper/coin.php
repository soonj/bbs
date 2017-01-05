<?php
/*
*金币查询函数
*@param $link object
*@param $username string
*@param return boolean
*/
function coin($link , $username) 
{	
	$hey_money= select($link , DB_PREFIX.'user' , 'coin' , "username = '$username'");
	//----------金/银/铜转换  存到SESSION
	$coin = $hey_money[0]['coin'];
	$coin_gold = floor($coin/10000);
	$coin_silver = floor($coin/100)-$coin_gold*100;
	$coin_bronze = $coin-$coin_gold*10000-$coin_silver*100;
	$_SESSION['coin_gold'] = $coin_gold;
	$_SESSION['coin_silver'] = $coin_silver;
	$_SESSION['coin_bronze'] = $coin_bronze;
}