<?php
/*
*数据库函数
*@param $host string
*@param $user string
*@param $pass srring
*@param return object
*/

function connect($host , $user , $pass , $charset , $name)
{
	$link = mysqli_connect($host , $user , $pass);
	
	if (!$link) {
		return false;
	}
	
	mysqli_set_charset($link , $charset);
	
	if (!mysqli_select_db($link , $name)){
		return false;
	} 
	return $link;
}

function insert($link , $table , $data)
{

	$keys = array_keys($data);
	$fileds = join(',' , $keys);
	$value = array_values($data);
	$values = implode(',' , parseValue($value));
	
	$sql = "insert into $table($fileds) values($values) ";
	echo $sql;
	$result = mysqli_query($link , $sql);
	
	if ($result) {
		return mysqli_insert_id($link);
	} else {
		return false;
	}
}

function parseValue($data)
{
	if (is_string($data)) {
		$data = '\''.$data.'\'';
	} else if(is_array($data)) {
		$data = array_map('parseValue',$data);
	} else if (is_null($data)) {
		$data = 'null';
	}
	return $data;
}

function update($link , $table , $data , $where)
{

	if (is_array($data)){
		$data = implode(',' , parseSet($data));
	}
	
	$sql = "update $table set $data where $where";

	$result = mysqli_query($link , $sql);
	
	return $result;
}


/*批量更新多条记录不同值
/	
/@param $link object
/@param $table string
/@param $data array
/@param $id array
/@param return boolean
/
*/
function update_array($link , $table , $data , $ids , $idName)
{
	/*$data = array(
	    title => array(	'1' => 2,
	    				'2' => 3,
	    				'3' => 2),
	    content => array(	'1' => 3,
	    					'2' => 3,
	    					'3'),
	);
	*/
 	$ids = implode(',', array_values($ids));
	$sql = "UPDATE $table SET ";
	foreach ($data as $key => $value) {
		$sql .= "`$key` = CASE $idName ";
		foreach ($value as $id => $ordinal) {
	    $sql .= sprintf("WHEN %d THEN '%s' ", $id, $ordinal);
		}
		$sql .= 'END,';
	}
	$sql = rtrim($sql , ',');
	$sql .= " WHERE $idName IN ($ids)";
	$result = mysqli_query($link , $sql);
	return $result;
}

function parseSet($data)
{
	foreach ($data as $key => $value) {

		$value = parseValue($value);
		
		if (is_scalar($value)) {
			$set[] = $key . '=' . $value; 
		}
	}
	return $set;
}



function select($link , $table , $fileds , $where)
{
	$sql = "select $fileds from $table where $where";
	$result = mysqli_query($link , $sql);

	if ($result && mysqli_affected_rows($link)) {
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}
		return $data;
	} else {
		return false;
	}
}


function del($link , $table , $where)
{
	$sql = "delete from $table where $where";
	
	$result = mysqli_query($link , $sql);
	//echo $sql;
	if ($result && mysqli_affected_rows($link)) {
		return mysqli_affected_rows($link);
	} else {
		return false;
	}
}

function sum($link , $table , $fileds)
{
	$sql = "select sum($fileds) as sum from $table";
	$result =mysqli_query($link , $sql);
	
	$sum = mysqli_fetch_assoc($result);
	
	return $sum['sum'];
	
}

function idCount($link , $table , $fileds)
{
	$sql = "select count($fileds) as count from $table";
	$result =mysqli_query($link , $sql);
	
	$count = mysqli_fetch_assoc($result);
	
	return $count['count'];
	
}







































