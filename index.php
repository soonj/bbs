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

//--------查询节点信息

$tab = select($link , DB_PREFIX.'tab' , '*' , "id > 0");

//----------分页查询主题信息
if (!empty($_GET['tab']) && empty($_GET['go'])) {
	$tabname = $_GET['tab'];
	$tab_result = select($link , DB_PREFIX.'tab' , '*' , "tabname = '$tabname'");
	$sql = 'SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from '.DB_PREFIX.'user INNER JOIN tt_post ON uid = authorid INNER JOIN '.DB_PREFIX.'tab ON nodename = tabname WHERE '.DB_PREFIX.'post.rid = 0 AND '.DB_PREFIX.'post.display = 1 AND parentid = '.$tab_result[0]['id'].' ORDER BY ctime DESC,retime DESC limit '.$offset.',10';
}elseif (!empty($_GET['go']) && !empty($_GET['tab'])) {
	$tabname = $_GET['tab'];
	$tab_result = select($link , DB_PREFIX.'tab' , '*' , "tabname = '$tabname'");
	$goname = $_GET['go'];
	$sql = 'SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from '.DB_PREFIX.'user INNER JOIN tt_post ON uid = authorid INNER JOIN '.DB_PREFIX.'tab ON nodename = tabname WHERE '.DB_PREFIX.'post.rid = 0 AND '.DB_PREFIX.'post.display = 1 AND '.DB_PREFIX.'post.nodename = "'.$goname.'" ORDER BY ctime DESC,retime DESC limit '.$offset.',10';
}elseif (empty($_GET['go']) && empty($_GET['tab'])) {
	$sql = 'SELECT username as author_name,pid,hicon,title,rcount,lastuser,nodename,ctime,coin,retime from '.DB_PREFIX.'user INNER JOIN '.DB_PREFIX.'post ON uid = authorid WHERE '.DB_PREFIX.'post.rid = 0 AND '.DB_PREFIX.'post.display = 1 ORDER BY ctime DESC,retime DESC limit '.$offset.',10';
}
$result = mysqli_query($link,$sql);
//----------主题页数查询赋值
$count = mysqli_num_rows($result);
$pageCount = $count[0]['count(pid)'] / 10;

//----------遍历输出到数组
if ($result) {
	while($row = mysqli_fetch_assoc($result))
	{
		$data[]=$row;
	}
}



//模版引擎传值
$title = 'TICK-TOCK'; 
$count = select($link , 'tt_post' , 'count(pid)' , 'rid = 0');
$totalPage = ceil($pageCount);
$baseUrl = WEB_SITE.'/index.php';
$search = [];
if (!empty($_GET['go'])) {
	$search['go']= $_GET['go'];	
}if (!empty($_GET['tab'])) {
	$search['tab']= $_GET['tab'];	
}


display('home/index.html' , compact('data' , 'title' , 'totalPage' , 'baseUrl' , 'search' , 'nowPage' , 'tab' , 'tab_result'));

//----------关闭数据库
mysqli_close($link);

