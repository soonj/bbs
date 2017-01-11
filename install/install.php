<?php
if(file_exists('../install.lock')){
		exit('网站已被安装，如果需要重新安装网站，请删除 /install.lock 文件');
	}
if (!empty($_POST['submit']) && $_POST['submit'] == 'success') {
	//加载数据库文件
		include '../config/database.php';

		$link=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

			if(mysqli_errno($link)){

				exit(mysqli_error($link));
			}

			mysqli_set_charset($link, DB_CHARSET);

			$admin_user = trim($_POST['admin_user']);

			$admin_pwd = password_hash(trim($_POST['admin_pwd']), PASSWORD_DEFAULT);

			$time=time();

			//处理IP
			if ($_SERVER['REMOTE_ADDR'] == '::1') {
				$ip = ip2long('127.0.0.1');
			} else {
				$ip = ip2long($_SERVER['REMOTE_ADDR']);				
			}


			$admin_mail = trim($_POST['admin_mail']);

			$sql = "insert into ".DB_PREFIX."user(uid,username,password,email,usergrant,rtime,ip) values(1,'{$admin_user}','{$admin_pwd}','{$admin_mail}',7,$time,$ip)";

			echo $sql;

			$result=mysqli_query($link, $sql);

			if($result && mysqli_affected_rows($link))
			{

				file_put_contents('../install.lock','');
				echo '安装成功';
				header('location:../index.php');
				exit();

			}else{

				echo mysqli_error($link);

				echo '添加管理员失败';

				exit();

			}

			mysqli_close($link);
}elseif (!empty($_POST['submit']) && $_POST['submit'] == 'database') {
						$str = file_get_contents('../config/database.php');
						//遍历表单内容
						
						foreach($_POST as $key=>$val){
							$pattern="#define\('$key','.*?'\);#";
							$replace="define('$key','$val');";
						//替换关键字写入数据
							$str=preg_replace($pattern, $replace, $str);
						}
						file_put_contents('../config/database.php',$str);

						//加载数据库文件
						include '../config/database.php';
						
						//新建数据库
						$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
						//创建数据库
						mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `".DB_NAME."`");
						if(mysqli_connect_errno($link)){
							exit('数据库不存在<a href='.$_SERVER['HTTP_REFERER'].'>返回</a>');
						}
						mysqli_close($link);
						//展开数据库文件	
						$sql = file_get_contents('ticktock.sql');
						//链接数据库并选择
						$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
						if(mysqli_errno($link)){
							exit(mysqli_error($link));
						}
						mysqli_set_charset($link, DB_CHARSET);
						
						$sql=explode(';',$sql);
						//执行sql语句
						foreach($sql as $value){
							if(!empty($value))
							{
								$prefix = str_replace('tt_', DB_PREFIX, $value);
								$result = mysqli_query($link, $prefix);
								if($result){
										$db_result = 1;
										
								}else{
										$db_result = 0;
										header( 'location:./install.php?step=4' );
										exit('数据库插入错误');
								}
							}
						}

						if ($db_result == 1) {
							header( 'location:./install.php?step=4&&success=1' );
						}
						echo $db_result ;
						mysqli_close($link);
}	
?>
<html>
	<head>
	<title>安装向导</title>
	<meta charset="utf-8"/>
	</head>
	<body>
		<?php  if (empty($_GET['step'])):
				header('location:./install.php?step=1');?>

		<?php else:?>
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
						<td><?php $os_result = PHP_OS == true ? 'ok' : 'failed'; 
								  echo $os_result.PHP_OS;?></td>
					</tr>
					<tr>
						<td>PHP版本</td>
						<td>5.5.x</td>
						<td>5.5.x</td>
						<td><?php  $php_v = version_compare(PHP_VERSION,'5.3.0','ge') == true ? 'ok' : 'failed';
								  echo $php_v.PHP_VERSION; ?></td>
					</tr>
				</table>
				<div>
					<?php if($os_result=='ok' && $php_v=='ok'):?>
					<button type="submit" name="submit" value="第二步">
						<a href="http://localhost/document/bbs/install/install.php?step=2">
							下一步
						</a>
					</button>
					<?php else:?>
					<button type="disabled">
							系统错误请检查
					</button>
					<?php endif;?>
				</div>
				<?php break;?>

			<?php case '2':?>

			<?php 
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
			?>
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
						<td><?php $dir_result_caches = iswriteable('../caches')==1 ? 'ok' : 'no';
									echo $dir_result_caches; ?></td>
					</tr>

					<tr>
						<td>./views</td>
						<td>可写</td>
						<td><?php $dir_result_views = iswriteable('../views')==1 ? 'ok' : 'no' ;
									echo  $dir_result_views;?></td>
					</tr>

					<tr>
						<td>./upload</td>
						<td>可写</td>
						<td><?php $dir_result_upload = iswriteable('../upload')==1 ? 'ok' : 'no' ;
									echo  $dir_result_upload;?></td>
					</tr>

					<tr>
						<td>./config/config.php</td>
						<td>可写</td>
						<td><?php $dir_result_config = iswriteable('../config/config.php')==1 ? 'ok' : 'no';
								echo  $dir_result_config; ?></td>
					</tr>

					<tr>
						<td>./config/database.php</td>
						<td>可写</td>
						<td><?php $dir_result_db = iswriteable('../config/database.php')==1 ? 'ok' : 'no';
								echo  $dir_result_db; ?></td>
					</tr>
					
				</table>
				<div>
					<button type="submit" name="submit" value="第一步">
						<a href="http://localhost/document/bbs/install/install.php?step=1">
							上一步
						</a>
					</button>
					<?php $dir_result = $dir_result_caches.$dir_result_views.$dir_result_upload.$dir_result_config.$dir_result_db;
					if($dir_result == 'okokokokok'):?>
					<button type="submit" name="submit" value="第三步">
						<a href="http://localhost/document/bbs/install/install.php?step=3">
							下一步
						</a>
					</button>
					<?php else:?>
					<button type="disabled">
							文件错误请检查
					</button>
					<?php endif;?>

				</div>
				<?php break;?>

			<?php case '3':?>
			<form action="./install.php?step=4" method="post">
				<table>
					<caption>第三步：创建数据库</caption>
					<tr>
						<th>填写数据库信息</th>
						<th></th>
						<th></th>

					</tr>
					<tr>
						<td>数据库服务器：</td>
						<td><input type="text" name="DB_HOST" value="localhost"/></td>
						<td>数据库服务器地址, 一般为 localhost</td>
					</tr>
					<tr>
						<td>数据库名:</td>
						<td><input type="text" name="DB_NAME" value="ticktock"/></td>
						<td></td>
					</tr>
					<tr>
						<td>数据库用户名:</td>
						<td><input type="text" name="DB_USER" value="root"/></td>
						<td></td>
					</tr>
					<tr>
						<td>数据库密码:</td>
						<td><input type="text" name="DB_PASS" value=""/></td>
						<td></td>
					</tr>
					<tr>
						<td>数据表前缀:</td>
						<td><input type="text" name="DB_PREFIX" value="tt_"/></td>
						<td>同一数据库运行多个论坛时，请修改前缀</td>
					</tr>
				</table>
				<div>
					<button type="submit" name="submit" value="第二步">
						<a href="http://localhost/document/bbs/install/install.php?step=2">
							上一步
						</a>
					</button>
					<button type="submit" name="submit" value="database">
							下一步
					</button>
				</div>
			</form>
				<?php break;?>

			<?php case '4':?>

				<?php if (empty($_GET['success']) || $_GET['success']!=1):
					echo '数据库导入失败';
					exit();
					endif;?>

			<form action="./install.php?step=5" method="post">
				<h1>数据库导入成功</h1>
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
					</tr>
					<tr>
						<td>管理员密码:</td>
						<td><input type="text" name="admin_pwd" value=""/></td>
						<td>管理员密码不能为空</td>
					</tr>
					<tr>
						<td>管理员 Email:</td>
						<td><input type="text" name="admin_mail" value=""/></td>
					</tr>
				</table>
				<div>
					<button type="submit" name="submit" value="success">
							完成
					</button>
				</div>
			</form>
				

					
				<?php break;?>

			<?php endswitch;?>
<?php endif;?>
	</body>
</html>