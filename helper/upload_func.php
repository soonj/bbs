<?php
/*
$key:上传文件的键
$mimeArray:允许的mime类型
$suffixArray:允许的后缀类型
$maxSize:允许的size
$path:保存的路径
$isRand:是否启用随机名字
函数的返回值：
	如果成功：
		[1, 路径];
	如果失败
		[0, 错误信息];
*/
function upload($key, $mimeArray, $suffixArray, $maxSize, $path, $isRand)
{
	//var_dump($key);
	//var_dump($_FILES);
	$error = $_FILES[$key]['error'];
	if ($error) {
		switch ($error) {
			case 1:
				$msg = '文件大小超过ini设置';
				break;
			case 2:
				$msg = '文件大小超过html设置';
				break;
			case 3:
				$msg = '文件部分上传';
				break;
			case 4:
				$msg = '没有文件';
				break;
			case 6:
				$msg = '找不到临时文件';
				break;
			case 7:
				$msg = '文件写入失败';
				break;
		}
		return [0, $msg];
	}
	
	//判断文件大小
	$size = $_FILES[$key]['size'];
	if ($size > $maxSize) {
		return [0, '文件大小超出设置范围'];
	}
	
	//判断文件类型是否正确  qq.png
	$name = $_FILES[$key]['name'];
	$arr = explode('.', $name);
	$suffix = array_pop($arr);
	$mime = $_FILES[$key]['type'];
	if (!in_array($suffix, $suffixArray)) {
		return [0, '后缀名不符合要求'];
	}
	if (!in_array($mime, $mimeArray)) {
		return [0, 'mime类型不符合要求'];
	}
	
	//得到要保存的位置
	$path = rtrim($path, '/').'/';
	if ($isRand){
		$name = uniqid().'.'.$suffix;
	}
	$filePath = $path.$name;
	
	
	//判断是否是上传文件
	$file = $_FILES[$key]['tmp_name'];
	if (is_uploaded_file($file)) {
		if (move_uploaded_file($file, $filePath)) {
			return [1, $filePath];
		} else {
			return [0, '文件上传失败'];
		}
	} else {
		return [0, '不是上传文件'];
	}
}


function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}


















