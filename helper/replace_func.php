<?php

/**
 *使用正则将搜索结果匹配替换
 *
 *@param $key string   		关键字
 *@param $content string 	源文本
 *
 *
 */
function replace_func($key , $content){

	$pattern = "/$key/imsU";
	$replace = "<font color=red><b>$key</b></font>";
	$content = stristr($content , $key);
	if (strlen($content)>45) {
	    $sub = substr($content,0,45);
	    $content = $sub.'&nbsp;...';
	}
	$Result = preg_replace($pattern , $replace , $content);

	return $Result;
	
}
