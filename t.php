<?php
//导入通用文件
include './common/common.php';

//GET(post)传值验证
if (empty($_GET['post'])) {
	$content = error('044');
	display('error.html' ,compact('content'));
	exit();
}

//GET(nowPage)传值验证 分页赋值
if (!empty($_GET['nowPage'])) {
	$nowPage = $_GET['nowPage'];
	$offset = ($nowPage-1)*10;
} else {
	$nowPage = 0;
	$offset = 0;
}

$postid = $_GET['post'];
$time = time();

//查询主题内容数据
$sql = "SELECT title,content,ctime,username,hicon,nodename,rcount,ccount FROM tt_post INNER JOIN tt_user ON tt_post.pid = $postid AND authorid = uid AND rid=0";
$result = mysqli_query($link , $sql);
$row_post = mysqli_fetch_assoc($result);


//主题浏览计数+1
$ccount["ccount"] = $row_post["ccount"]+1;
update($link , 'tt_post' , $ccount , "pid = $postid");


//查询主题对应回复数据
$sql = "SELECT content,ctime,username,hicon FROM tt_post INNER JOIN tt_user ON rid = $postid AND authorid = uid ORDER BY ctime LIMIT $offset,10";
$result = mysqli_query($link , $sql);
while($row = mysqli_fetch_assoc($result)){
        	$data[] = $row;
}

//主题回复计数
$rcount = select($link , 'tt_post' , 'count(pid)' , "rid = $postid");
$pageCount = $rcount[0]['count(pid)'] / 10;

$title = $row_post['title'];
$totalPage = ceil($pageCount); 
$baseUrl = WEB_SITE.'/t.php';
$search = [];
$search['post'] = $postid;
display('home/t.html' , compact('title' , 'data' , 'row_post' , 'postid' , 'time' , 'rcount' , 'nowPage', 'totalPage' , 'baseUrl' , 'search'));

//关闭数据库
mysqli_close($link);