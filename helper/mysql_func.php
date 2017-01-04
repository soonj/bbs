<?php
/*
*???????ݿ???Ӻ??
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

	$result = mysqli_query($link , $sql);
	
	if ($result) {
		return mysqli_insert_id($link);
	} else {
		return false;
	}
}
//
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

	$set = join(',' , parseSet($data));
	
	$sql = "update $table set $set where $where";



	$result = mysqli_query($link , $sql);
	
	return $result;
}

function parseSet($data)
{
	
	//username = 'Ů?',password = 'niaiwowozhidao'
	foreach ($data as $key => $value) {

		$value = parseValue($value);
		
		if (is_scalar($value)) {
			$set[] = $key . '=' . $value; 
		}
	}
	return $set;
}

//???????

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







































