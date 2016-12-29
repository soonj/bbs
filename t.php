<?php
//导入通用文件
include './common.php';

//导入Markdown文件
include './parsedown/Parsedown.php';
$Parsedown = new Parsedown();

//传入url数据
$postid = $_GET['post'];


//查询主题内容数据
$sql = "SELECT title,content,ctime,username,hicon,nodename,rcount,ccount FROM tt_post INNER JOIN tt_user ON tt_post.pid = $postid AND authorid = uid AND rid=0";
$result = mysqli_query($link , $sql);
$row_post = mysqli_fetch_assoc($result);


//主题浏览计数+1
$ccount["ccount"] = $row_post["ccount"]+1;
update($link , 'tt_post' , $ccount , "pid = $postid");


//查询主题对应回复数据
$sql = "SELECT content,ctime,username,hicon FROM tt_post INNER JOIN tt_user ON rid = $postid AND authorid = uid";
$result = mysqli_query($link , $sql);

//主题回复计数
$rcount = select($link , 'tt_post' , 'count(pid)' , "rid = $postid");

include './html/header.html';
include './html/t.html';

//关闭数据库
mysqli_close($link);