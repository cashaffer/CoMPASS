<?php
if ( !defined( "_BASE_DB_LAYER" ) ){ 
define("_BASE_DB_LAYER", 1 ); 

include "config.inc"; 
                
class db { 
var $connect_id; 
var $database; 

//MySQL���ݿ��� 
function db(){ 
} 

function open($database="") { 
//Ϊ�˷�������͸��ӿ��ٴ����ݿ⣬�����ǽ���һ���־����� 
$this->connect_id=mysql_pconnect(ServerName, UserName, PassWord); 

if ($this->connect_id) { 
//�ɹ� 
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
//so this call is �����. 
// $result=@mysql_close($this->connect_id); 
// return $result; 
} 
};//END db class 


//MySQL���ݿ��ѯ�� 
// 
//row��Ա��������һ�в�ѯ�������������, 
//��ֱ��ʹ�ã����Ƽ�ʹ���ҵ�field����:) 
class query { 
var $result; 
var $row; 

//���캯����ʹ��ʱ�����ȳ�ʼ��һ��db�࣬����Ϊ�������� 
function query(&$db, $query="", $database="") { 
if($database!=""){ 
$db->select_db($database); 
} 

if($query!="" && $db->database!=""){ 
$this->result=@mysql_db_query($db->database, $query, $db->connect_id); 
return $this->result; 
} 
} 

//�õ�һ���µļ�¼ 
//���û�и���������FALSE 
function getrow() { 
$this->row=@mysql_fetch_array($this->result); 
return $this->row; 
} 

//�õ����ؼ�¼���ļ�¼�� 
//ORACLEʵ�������ʹ�࣬������д��23�д��룡 
function numrows() { 
$result=@mysql_num_rows($this->result); 
return $result; 
} 

//�õ����һ������ 
function error() { 
$result=@mysql_error(); 
return $result; 
} 

//�õ����һ�β����յ�Ӱ������� 
function affectnum(){ 
$result=@mysql_affected_rows(); 
return $result; 
} 

//�õ�ָ����$field�Ľ��,���$row����Ϊ�գ� 
//���ص�ǰ��¼�Ĵ�����,������ָ���еĴ����� 
// 
//����0��ʾҪ�󲻺Ϸ� 
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

//�Ǻǣ��ѵ�ǰ��¼��ָ�뷵�ص�һ�ORACLE����û�д˹��ܰɣ� 
function firstrow() { 
$result=@mysql_data_seek($this->result,0); 
if($result){ 
$result=$this->getrow(); 
return $this->row; 
}else{ 
return 0; 
} 
} 

//�ƶ���¼��ָ�뵽ָ��λ�ã� 
//���أ��մ�ORACLE�н��ѳ������ң� 
//����������ܼ�ֱ�ж���ʹ������ 
function seek($row){ 
@mysql_data_seek($this->result, $row); 
} 

//�ͷ�ռ����Դ��PHP���಻������������˵ 
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