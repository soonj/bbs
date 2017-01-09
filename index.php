<?php

include 'common/common.php';

//--------GET传值验证 分页赋值
if (!empty($_GET['nowPage'])) {
	$nowPage = $_GET['nowPage'];
	$offset = ($nowPage-1)*10;
} else {
	$nowPage = 0;
	$offset = 0;
}
//----------分页查询主题信息
$sql = "SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from tt_user INNER JOIN tt_post ON uid = authorid WHERE tt_post.rid = 0 ORDER BY ctime DESC,retime DESC limit $offset,10";
$result = mysqli_query($link,$sql);
//----------主题页数查询赋值
$count = select($link , 'tt_post' , 'count(pid)' , 'rid = 0');
$pageCount = $count[0]['count(pid)'] / 10;

//----------遍历输出到数组
while($row = mysqli_fetch_assoc($result))
{
	$data[]=$row;
}
//模版引擎传值
$title = 'TICK-TOCK'; 
$count = select($link , 'tt_post' , 'count(pid)' , 'rid = 0');
$totalPage = ceil($pageCount);
$baseUrl = WEB_SITE.'/index.php';
$search = [];

display('home/index.html' , compact('data' , 'title' , 'totalPage' , 'baseUrl' , 'search' , 'nowPage'));

//----------关闭数据库
mysqli_close($link);
