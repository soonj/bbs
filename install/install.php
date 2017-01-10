<?php
if(file_exists('../install.lock')){
		exit('网站已经被安装过了，如果需要重新安装网站，请删除 /install.lock 文件');
	}
$submit = $_POST['submit'];
switch ($submit) {
	case '第一步':
		break;

	case '第二步':
			function iswriteable($file){
				if(is_dir($file)){
					$dir=$file;
					if($fp = fopen("$dir/test.txt", 'w')) {
						fclose($fp);
						unlink("$dir/test.txt");
						$writeable = 1;
					}else{
						$writeable = 0;
					}
				}else{
					if($fp = fopen($file, 'a+')) {
						fclose($fp);
						$writeable = 1;
					}else {
						$writeable = 0;
					}
				}
				return $writeable;
			}
		break;

	case '第三步':
		//--------------------------------------------------------------------
			if(!empty($_POST['dbsubmitname'])){
	
				$str=file_get_contents('../config/database.php');
				
				foreach($_POST as $key=>$val){
					
					$pattern="/define\('$key','.*?'\);/";
					$replace="define('$key','$val');";
				
					$str=preg_replace($pattern, $replace, $str);

				}
				
				file_put_contents('../config/database.php',$str);

				//执行数据库导入
				include '../config/database.php';
				
				//新建数据库
				$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
				if(mysqli_get_server_info($link) > '4.1') {
					mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET ".DB_CHARSET);
				} else {
					mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `".DB_NAME."`");
				}
				if(mysqli_connect_errno($link)){
					exit('数据库不存在');
				}
				mysqli_close($link);
					
				$sql=file_get_contents('apple_bbs.sql');
				$conn=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				if(mysqli_errno($conn)){

					exit(mysqli_error($conn));
				}
				mysqli_set_charset($conn, DB_CHARSET);
				
				$arr=explode(';phpxy;',$sql);

				foreach($arr as $val){
					if(!empty($val))
					{
						$Nval = str_replace('bbs_', DB_PREFIX, $val);
						$result = mysqli_query($conn, $Nval);

						if($result){
								$sql = '<font color="green">数据库导入成功</font>';
						}else{
								$sql = '<font color="red">数据库导入失败</font>';
						}
					}
				}
				
				mysqli_close($conn);
				
			}





		//----------------------------------------------------------------
		break;

	case '第四步':
		# code...
		break;
	
	default:
		
		break;
}






?>
<html>
	<head>
	<title>安装向导</title>
	<meta charset="utf-8"/>
	</head>
	<body>
		<?php switch ($_GET['step']) :
			case '1':?>
				<table>
					<caption>第一步：环境检查</caption>
					<tr>
						<th>项目</th>
						<th>所需配置</th>
						<th>最佳配置</th>
						<th>当前配置</th>
					</tr>
					<tr>
						<td>操作系统</td>
						<td>不限制</td>
						<td>Linux</td>
						<td><?php echo PHP_OS == true? 'ok'.PHP_OS : 'failed' ?></td>
					</tr>
					<tr>
						<td>PHP版本</td>
						<td>5.5.x</td>
						<td>5.5.x</td>
						<td><?php echo PHP_VERSION > '5.5.0'? 'ok'.PHP_VERSION : 'failed' ?></td>
					</tr>
				</table>
				<div>
					<button type="submit" name="submit" value="第二步">
						<a href="http://localhost/document/bbs/install/install.php?step=2">
							下一步
						</a>
					</button>
				</div>
				<?break;?>

			<?php case '2':?>
				<table>
					<caption>第二步：文件权限检查</caption>
					<tr>
						<th>目录</th>
						<th>所需状态</th>
						<th>当前状态</th>
					</tr>
					<tr>
						<td>./caches</td>
						<td>可写</td>
						<td><?php echo  iswriteable('../caches')==1 ? '可写' : '不可写' ?></td>
					</tr>

					<tr>
						<td>./views</td>
						<td>可写</td>
						<td><?php echo  iswriteable('../views')==1 ? '可写' : '不可写' ?></td>
					</tr>

					<tr>
						<td>./upload</td>
						<td>可写</td>
						<td><?php echo  iswriteable('../upload')==1 ? '可写' : '不可写' ?></td>
					</tr>

					<tr>
						<td>./cofig/config.php</td>
						<td>可写</td>
						<td><?php echo  iswriteable('../cofig/config.php')==1 ? '可写' : '不可写' ?></td>
					</tr>

					<tr>
						<td>./cofig/database.php</td>
						<td>可写</td>
						<td><?php echo  iswriteable('../cofig/database.php')==1 ? '可写' : '不可写' ?></td>
					</tr>
					
				</table>
				<div>
					<button type="submit" name="submit" value="第一步">
						<a href="http://localhost/document/bbs/install/install.php?step=1">
							上一步
						</a>
					</button>
					<button type="submit" name="submit" value="第三步">
						<a href="http://localhost/document/bbs/install/install.php?step=3">
							下一步
						</a>
					</button>
				</div>
				<?php break;?>

			<?php case '3':?>
				<table>
					<caption>第三步：创建数据库</caption>
					<tr>
						<th>填写数据库信息</th>
						<th></th>
						<th></th>

					</tr>
					<tr>
						<td>数据库服务器：</td>
						<td><input type="text" name="hostname" value="localhost"/></td>
						<td>数据库服务器地址, 一般为 localhost</td>
					</tr>
					<tr>
						<td>数据库名:</td>
						<td><input type="text" name="db_name" value="tick_tock"/></td>
						<td></td>
					</tr>
					<tr>
						<td>数据库用户名:</td>
						<td><input type="text" name="db_username" value="root"/></td>
						<td></td>
					</tr>
					<tr>
						<td>数据库密码:</td>
						<td><input type="text" name="db_pwd" value=""/></td>
						<td></td>
					</tr>
					<tr>
						<td>数据表前缀:</td>
						<td><input type="text" name="db_prefix" value="tt_"/></td>
						<td>同一数据库运行多个论坛时，请修改前缀</td>
					</tr>
				</table>
				<div>
					<button type="submit" name="submit" value="第二步">
						<a href="http://localhost/document/bbs/install/install.php?step=2">
							上一步
						</a>
					</button>
					<button type="submit" name="submit" value="第四步">
						<a href="http://localhost/document/bbs/install/install.php?step=4">
							下一步
						</a>
					</button>
				</div>
				<?php break;?>

			<?php case '4':?>
				<table>
					<caption>第四步：安装</caption>
					<tr>
						<th>填写管理员信息</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<td>管理员账号：</td>
						<td><input type="text" name="admin_user" value=""/></td>
						<td><?php echo PHP_OS true? 'ok'.PHP_OS : 'failed' ?></td>
					</tr>
					<tr>
						<td>管理员密码:</td>
						<td><input type="text" name="admin_pwd" value=""/></td>
						<td>管理员密码不能为空</td>
					</tr>
					<tr>
						<td>管理员 Email:</td>
						<td><input type="text" name="admin_mail" value=""/></td>
						<td><?php echo PHP_VERSION > '5.5.0'? 'ok'.PHP_VERSION : 'failed' ?></td>
					</tr>
				</table>
				<div>
					<button>
						<a href="http://localhost/document/bbs/install/install.php">
							完成
						</a>
					</button>
				</div>
				<?php break;?>

		<?php endswitch;?>

	</body>
</html>