<?php
if ( !defined( "_BASE_DB_LAYER" ) ){ 
define("_BASE_DB_LAYER", 1 ); 

include "config.inc"; 
                
class db { 
var $connect_id; 
var $database; 

//MySQL数据库类 
function db(){ 
} 

function open($database="") { 
//为了方便起见和更加快速打开数据库，让我们建立一个持久连接 
$this->connect_id=mysql_pconnect(ServerName, UserName, PassWord); 

if ($this->connect_id) { 
//成功 
$this->database=$database; 
return $this->connect_id; 
}else{ 
echo "MISSION IMPOSSIBLE : I cannot open the database!"; 
return 0; 
} 
} 

function select_db($database){ 
$this->database=$database; 
} 

function close() { 
// Closes anything that can be closed. 

//I find the mysql_pconnect() cannot be closed be mysql_close, 
//so this call is 多余的. 
// $result=@mysql_close($this->connect_id); 
// return $result; 
} 
};//END db class 


//MySQL数据库查询类 
// 
//row成员变量包含一列查询结果的联合数组, 
//可直接使用，但推荐使用我的field函数:) 
class query { 
var $result; 
var $row; 

//构造函数，使用时必须先初始化一个db类，并作为参数传入 
function query(&$db, $query="", $database="") { 
if($database!=""){ 
$db->select_db($database); 
} 

if($query!="" && $db->database!=""){ 
$this->result=@mysql_db_query($db->database, $query, $db->connect_id); 
return $this->result; 
} 
} 

//得到一条新的记录 
//如果没有更多结果返回FALSE 
function getrow() { 
$this->row=@mysql_fetch_array($this->result); 
return $this->row; 
} 

//得到返回记录集的记录数 
//ORACLE实现这个好痛苦，我最少写了23行代码！ 
function numrows() { 
$result=@mysql_num_rows($this->result); 
return $result; 
} 

//得到最后一个错误 
function error() { 
$result=@mysql_error(); 
return $result; 
} 

//得到最后一次操作收到影响的列数 
function affectnum(){ 
$result=@mysql_affected_rows(); 
return $result; 
} 

//得到指定域$field的结果,如果$row参数为空， 
//返回当前记录的此域结果,否则是指定行的此域结果 
// 
//返回0表示要求不合法 
function field($field, $row=-1) { 
if($row!=-1){ 
$result=@mysql_result($this->result, $row, $field); 
}else{ 
$result=$this->row[$field]; 
} 

if(isset($result)){ 
return $result; 
}else{ 
return '0'; 
} 
} 

//呵呵，把当前记录集指针返回第一项，ORACLE好像没有此功能吧？ 
function firstrow() { 
$result=@mysql_data_seek($this->result,0); 
if($result){ 
$result=$this->getrow(); 
return $this->row; 
}else{ 
return 0; 
} 
} 

//移动记录集指针到指定位置， 
//呜呜，刚从ORACLE中解脱出来的我， 
//看到这个功能简直感动的痛哭流涕 
function seek($row){ 
@mysql_data_seek($this->result, $row); 
} 

//释放占用资源，PHP的类不用析构函数的说 
function free() { 
return @mysql_free_result($this->result); 
} 

function select_rows(){ 
$result=@mysql_num_rows($this->result); 
if($result){ 
return $result; 
}else{ 
return 0; 
} 
} 

function get_last_insert(&$db){ 
return @mysql_insert_id($db->connect_id); 
} 
}; // End query class 
} 
?>