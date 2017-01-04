<?php

include 'common/common.php';



//----------查询主题title
$sql = "SELECT username as author_name,pid,hicon,title,rcount,nodename,ctime,coin from tt_user INNER JOIN tt_post ON uid = authorid WHERE tt_post.rid = 0 ";

$result = mysqli_query($link,$sql);

//----------遍历输出

while($row = mysqli_fetch_assoc($result))
{
	$data[]=$row;
}



display('home/index.html' , compact('data'));


//----------关闭数据库
mysqli_close($link);
