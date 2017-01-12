<?php

include 'common/common.php';
//网站关闭
if (WEB_ISCLOSE==true) {
	$content = error('063');
	display('error.html' ,compact('content'));
	exit();
}
//--------GET传值验证 分页赋值
if (!empty($_GET['nowPage'])) {
	$nowPage = $_GET['nowPage'];
	$offset = ($nowPage-1)*10;
} elseif(!empty($_POST['jump'])) {
	$nowPage = $_POST['jump'];
	$offset = ($nowPage-1)*10;
} else{
	$nowPage = 0;
	$offset = 0;
}
//----------分页查询主题信息
if (!empty($_GET['tab']) && empty($_GET['tab'])) {
	$sql = "SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from tt_user INNER JOIN tt_post ON uid = authorid WHERE {DB_PREFIX}post.rid = 0 AND {DB_PREFIX}post.display = 1 AND {DB_PREFIX}post.tabname = '{$_GET['tab']}' ORDER BY ctime DESC,retime DESC limit $offset,10";
}elseif (!empty($_GET['go']) && !empty($_GET['tab'])) {
	$sql = "SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from tt_user INNER JOIN tt_post ON uid = authorid WHERE {DB_PREFIX}post.rid = 0 AND {DB_PREFIX}post.display = 1 AND {DB_PREFIX}post.tabname = '{$_GET['tab']}' AND {DB_PREFIX}post.nodename = '{$_GET['go']}'tt_ORDER BY ctime DESC,retime DESC limit $offset,10";
}
$sql = "SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from tt_user INNER JOIN tt_post ON uid = authorid WHERE {DB_PREFIX}post.rid = 0 AND {DB_PREFIX}post.display = 1 ORDER BY ctime DESC,retime DESC limit $offset,10";
$result = mysqli_query($link,$sql);
//----------主题页数查询赋值
$count = select($link , 'tt_post' , 'count(pid)' , 'rid = 0 and display = 1');
$pageCount = $count[0]['count(pid)'] / 10;

//----------遍历输出到数组
if ($result) {
	while($row = mysqli_fetch_assoc($result))
	{
		$data[]=$row;
	}
}

//--------查询父节点信息
$tab = select($link , DB_PREFIX.'tab' , '*' , 'parentid >= 0');

//模版引擎传值
$title = 'TICK-TOCK'; 
$count = select($link , 'tt_post' , 'count(pid)' , 'rid = 0');
$totalPage = ceil($pageCount);
$baseUrl = WEB_SITE.'/index.php';
$search = [];

display('home/index.html' , compact('data' , 'title' , 'totalPage' , 'baseUrl' , 'search' , 'nowPage'));

//----------关闭数据库
mysqli_close($link);

