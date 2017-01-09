<?php

include './common/common.php';

//管理员登录判断
if (true) {
	# code...

//表单未传值
	if (!empty($_GET['q']) && empty($_POST)) {
		$model = $_GET['q'];

		switch ($model) {
			//板块查询
			case '1':
				$table = DB_PREFIX.'tab';
				$title = '板块管理';
				$result = select($link , $table , '*' , 'id > 0');
				var_dump($result);
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
				$result = select($link , $table , '*' , 'pid > 0 and rid=0');
				break;
		}

		display('admin/admin.html' , compact('result' , 'title'));
	} elseif(!empty($_GET['q']) && !empty($_POST)) {
//表单传值修改
		$model = $_GET['q'];
		switch ($model) {
			//板块查询
			case '1':
				$table = DB_PREFIX.'tab';
				$title = '板块管理';
			//多选框批量删除
				$id = $_POST['id'];
				if (is_array($id)) {

					//多选id处理
					$id = implode($id , ',');
					$where = "id in ($id)";

					//删除选项
					if ($_POST['delete']) {
						$data['hidden'] = 0;
						update($link , $table , $data , $where);
					}elseif ($_POST['update']) {
					//更新选项
						$data['tabname'] = $_POST['tabname'];
						$data['logo'] = $_POST['logo'];
						$data['info'] = $_POST['info'];
						$data['scythe'] = $_POST['scythe'];
						update($link , $table , $data , $where);
					}
				} else {

			//单选管理
					$where = "id = $id";
			//添加板块
					if ($_POST['add']) {
						$data['add_tabname'] = $_POST['add_tabname'];
						$data['add_logo'] = $_POST['add_logo'];
						$data['add_info'] = $_POST['add_info'];
						$data['add_scythe'] = $_POST['add_scythe'];
						insert($link , $table , $data);
					}elseif ($_POST['delete']) {
			//删除板块	
						$data['hidden'] = 1;
						update($link , $table , $data , $where);	
					}elseif ($_POST['update']) {
			//更新板块
						$data['tabname'] = $_POST['tabname'];
						$data['logo'] = $_POST['logo'];
						$data['info'] = $_POST['info'];
						$data['scythe'] = $_POST['scythe'];
						update($link , $table , $data , $where);
					}
				}
				break;
			//友链查询
			case '2':
				$table = DB_PREFIX.'friend';
				$title = '站点信息';
				$id = $_POST['id'];
				if (is_array($id)) {

					//多选id处理
					$id = implode($id , ',');
					$where = "id in ($id)";

					//删除选项
					if ($_POST['delete']) {
						$data['hidden'] = 0;
						update($link , $table , $data , $where);
					}elseif ($_POST['update']) {
					//更新选项
						$data['add_link'] = $_POST['add_link'];
						$data['add_info'] = $_POST['add_info'];
						$data['add_level'] = $_POST['add_level'];
						update($link , $table , $data , $where);
					}
				} else {

			//单选管理
					$where = "id = $id";
			//添加友链
					if ($_POST['add']) {
						$data['add_link'] = $_POST['add_link'];
						$data['add_info'] = $_POST['add_info'];
						$data['add_level'] = $_POST['add_level'];
						insert($link , $table , $data);
					}elseif ($_POST['delete']) {
			//删除友链	
						$data['hidden'] = 1;
						update($link , $table , $data , $where);	
					}elseif ($_POST['update']) {
			//更新友链
						$data['add_link'] = $_POST['add_link'];
						$data['add_info'] = $_POST['add_info'];
						$data['add_level'] = $_POST['add_level'];
						update($link , $table , $data , $where);
					}
				}
				break;
			//用户查询
			case '3':
				$table = DB_PREFIX.'user';
				$title = '用户管理';
				$uid = $_POST['uid'];
				if (is_array($uid)) {

					//多选id处理
					$uid = implode($uid , ',');
					$where = "uid in ($uid)";

					//锁定用户
					if ($_POST['delete']) {
						$data['usergrant'] = 1;
						update($link , $table , $data , $where);
					}elseif ($_POST['ban']) {
						$data['usergrant'] = 999;
						update($link , $table , $data , $where);
					}elseif ($_POST['update']) {
					//积分修改
						$data['coin'] = $_POST['coin'];
						update($link , $table , $data , $where);
					}
				} else {

			//单选管理
					$where = "uid = $uid";
			//删除用户
					if ($_POST['delete']) {
						$data['usergrant'] = 1;
						update($link , $table , $data , $where);
					}elseif ($_POST['ban']) {
			//锁定用户
						$data['usergrant'] = 999;
						update($link , $table , $data , $where);	
					}elseif ($_POST['update']) {
			//积分修改
						$data['coin'] = $_POST['coin'];
						update($link , $table , $data , $where);
					}
				}
				break;
			//帖子查询
			case '4':
				$table = DB_PREFIX.'post';
				$title = '帖子管理';
				$pid = $_POST['pid'];
				if (is_array($id)) {
			//多选id处理
					$id = implode($id , ',');
					$where = "pid in ($pid)";

				//锁定用户
					if ($_POST['delete']) {
						$data['usergrant'] = 1;
						update($link , $table , $data , $where);
						break;
					}elseif ($_POST['ban']) {
						$data['usergrant'] = 999;
						update($link , $table , $data , $where);
						break;
					}elseif ($_POST['update']) {
				//积分修改
						$data['coin'] = $_POST['coin'];
						update($link , $table , $data , $where);
						break;
					}
				} else {

			//单选管理
					$where = "uid = $uid";
			//删除用户
					if (!empty($_POST['delete'])) {
						$data['usergrant'] = 1;
						update($link , $table , $data , $where);
					}elseif (!empty($_POST['ban'])) {
			//锁定用户	
						echo 1111;
						$data['usergrant'] = 999;
						update($link , $table , $data , $where);	
					}elseif (!empty($_POST['update'])) {
			//积分修改
						$data['coin'] = $_POST['coin'];
						update($link , $table , $data , $where);
					}
				}
				break;
		}

	}

} else {


}