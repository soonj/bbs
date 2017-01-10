<?php

include './common/common.php';

//管理员登录判断

//表单未传值
	if (!empty($_GET['q']) && empty($_POST)) {
		$model = $_GET['q'];

		switch ($model) {
			//板块查询
			case '1':
				$table = DB_PREFIX.'tab';
				$title = '板块管理';
				$result = select($link , $table , '*' , 'id > 0');
				break;
			//友链查询
			case '2':
				$table = DB_PREFIX.'friend';
				$title = '站点信息';
				$result = select($link , $table , '*' , 'id > 0');
				break;
			//用户查询
			case '3':
				$table = DB_PREFIX.'user';
				$title = '用户管理';
				$result = select($link , $table , '*' , 'uid > 0');
				break;
			//帖子查询
			case '4':
				$table = DB_PREFIX.'post';
				$title = '帖子管理';
				$result = select($link , $table , '*' , 'pid > 0 and rid=0 and display=1');
				break;
		}

		display('admin/admin.html' , compact('result' , 'title'));
	} elseif(!empty($_GET['q']) && !empty($_POST['submit'])) {
		$model = $_GET['q'];
		$submit = $_POST['submit'];
		switch ($model) {
			case '1':
			$table = DB_PREFIX.'tab';
				switch ($submit) {
					case '添加板块':
						$data['tabname'] = $_POST['add_tabname'];
						$data['info'] = $_POST['add_info'];
						$data['scythe'] = $_POST['add_scythe'];
						$result = insert($link , $table , $data);
						echo ($result == true ? '成功':'失败'); 
						break;

					case '批量删除板块':
						$id = $_POST['id'];
						$data['display'] = 0 ; 
						if (is_array($id)) {
							$id = implode($id , ',');
							$where = "id in ($id)";
						} else {
							$where = "id = $id";
						}
						$result = update($link , $table , $data , $where);
						echo ($result == true ? '成功':'失败'); 
						break;

					case '提交修改':
						$id = $_POST['id'];
						//截取前四个数组元素
						$data = array_slice($_POST, 0 , 3);
						$idName = 'id';
						$result = update_array($link , $table , $data ,$id , $idName);
						echo ($result == true ? '成功':'失败'); 
						break;

				}
				break;

			case '2':
			$table = DB_PREFIX.'friend';
				switch ($submit) {
					case '添加友链':
						$data['link'] = $_POST['add_link'];
						$data['info'] = $_POST['add_info'];
						$data['level'] = $_POST['add_level'];
						$result = insert($link , $table , $data);
						echo ($result == true ? '成功':'失败'); 
						break;

					case '删除友链':
						$id = $_POST['id'];
						$data['display'] = 0 ; 
						if (is_array($id)) {
							$id = implode($id , ',');
							$where = "id in ($id)";
						} else {
							$where = "id = $id";
						}
						$result = update($link , $table , $data , $where);
						echo ($result == true ? '成功':'失败'); 
						break;

					case '确认修改':
						$id = $_POST['id'];
					//截取前三个数组元素
						$data = array_slice($_POST, 0 , 3);
						$idName = 'id';
						$result = update_array($link , $table , $data ,$id);
						echo ($result == true ? '成功':'失败'); 
						break;
				}
				break;

			case '3':
			$table = DB_PREFIX.'user';
				switch ($submit) {
					case '删除用户':
						$id = $_POST['uid'];
						$data['usergrant'] = 1 ; 
						if (is_array($id)) {
							$id = implode($id , ',');
							$where = "uid in ($id)";
						} else {
							$where = "uid = $id";
						}
						$result = update($link , $table , $data , $where);
						echo ($result == true ? '成功':'失败'); 
						break;

					case '锁定用户':
						$id = $_POST['uid'];
						$data['usergrant'] = 999 ; 
						if (is_array($id)) {
							$id = implode($id , ',');
							$where = "uid in ($id)";
						} else {
							$where = "uid = $id";
						}
						$result = update($link , $table , $data , $where);
						echo ($result == true ? '成功':'失败'); 
						break;

					case '积分修改':
						$id = $_POST['uid'];
						$idName = 'uid';
					//截取第一个数组元素
						$data = array_slice($_POST, 0 , 1);
						var_dump($data);
						$result = update_array($link , $table , $data ,$id , $idName);
						echo ($result == true ? '成功':'失败'); 
						break;
					
				}
				break;

			case '4':
			$table = DB_PREFIX.'post';
				switch ($submit) {
					case '删除主题':
						$id = $_POST['pid'];
						$data['display'] = 0 ; 
						if (is_array($id)) {
							$id = implode($id , ',');
							$where = "pid in ($id)";
						} else {
							$where = "pid = $id";
						}
						$result = update($link , $table , $data , $where);
						echo ($result == true ? '成功':'失败'); 
						break;
				}
				break;		
		}
	}
