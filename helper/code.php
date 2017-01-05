<?php
/*
生成验证码函数
$number:你要生成几位的验证码
$type: 0:纯数字  1代表纯字母  2代表数字和字母混合
$width:验证码图像的宽度
$height:验证码图像的高度
*/
//code(4, 2, 80, 20);
function code($number = 4, $type = 2, $width = 70, $height = 25)
{
	//生成画布
	$image = imagecreatetruecolor($width, $height);
	imagefill($image, 0, 0, lightColor($image));
	//生成验证码字符串
	switch ($type) {
		case 0:
			$code = randNumber($number);
			break;
		case 1:
			$code = randChar($number);
			break;
		case 2:
			$code = randNumberAndChar($number);
			break;
	}
	//将验证码字符串画到画布中
	$cellWidth = floor($width / $number);
	for ($i = 0; $i < $number; $i++) {
		$x = mt_rand($i * $cellWidth, ($i + 1) * $cellWidth - 10);
		$y = mt_rand(0, $height - 15);
		imagechar($image, 5, $x, $y, $code[$i], darkColor($image));
	}
	//在画布中添加干扰元素
	for ($i = 0; $i < 10; $i++) {
		imagesetpixel($image, mt_rand(0, $width), mt_rand(0, $height), darkColor($image));
	}
	for ($i = 0; $i < 1; $i++) {
		imagearc($image, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, 360), mt_rand(0, 360), lightColor($image));
	}
	//输出显示到浏览器
	header('content-type:image/png');
	imagepng($image);
	imagedestroy($image);
	
	return $code;
}

//随机的产生一个浅色
function lightColor($image)
{
	return imagecolorallocate($image, mt_rand(130, 255), mt_rand(130, 255), mt_rand(130, 255));
}

//随机的产生一个深色
function darkColor($image)
{
	return imagecolorallocate($image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
}

function randNumber($num = 4)
{
	$array = range(0, 9);
	$str = join('', $array);
	return substr(str_shuffle($str), 0, $num);
}

//纯字母的验证码字符串
function randChar($num = 4)
{
	$array1 = range('a', 'z');
	$str = join('', $array1);
	$str .= strtoupper($str);
	return substr(str_shuffle($str), 0, $num);
}

//字母和数字混合
function randNumberAndChar($num = 4)
{
	$arr1 = range(0, 9);
	$arr2 = range('a', 'z');
	$arr3 = range('A', 'Z');
	$arr = array_merge($arr1, $arr2, $arr3);
	shuffle($arr);
	return join('', array_slice($arr, 0, $num));
}




















