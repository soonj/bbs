<?php

include './common.php';
//当前页
$page = empty($_GET['page']) ? 1 : $_GET['page'];

//总条数
$count = idCount($link , 'tt_post' , 'pid');

//每页显示数
$num = 10;

//总页数
$pageTotal = ceil($count/$num);

//偏移量
$offset = ($page-1)*$num;

//上一页
$prev = $page-1;
//下一页
$next = $page+1;

if ($prev < 1) {
	$prev = 1;
}
if ($next > $pageTotal ) {
	$next = $pageTotal;
}


//----------查询主题title 并分页
$sql = "SELECT username as author_name,pid,hicon,title,rcount,nodename,ctime,coin from tt_user INNER JOIN tt_post ON uid = authorid WHERE tt_post.rid = 0 LIMIT $offset , $num";

$result = mysqli_query($link,$sql);



//----------遍历输出

while($row = mysqli_fetch_assoc($result))
{
	$data[]=$row;
}


include './html/header.html';
include './html/index.html';


//----------关闭数据库
mysqli_close($link);
