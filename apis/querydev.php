<?php
$i=$_GET["id"];
if(!is_numeric($i)){
    die();
}
if($i<1){
    die();
}
//error_reporting(E_ALL || ~E_NOTICE);
include '../include/server-info.php';
$db=new mysqli($dbhost, $dbuser, $dbpawd, $dbname);
$sql = 'select name,id,status,owner from devices where id='.$i;
$res=$db->query($sql);
$qr=$res->fetch_array();
$sl=array();
$sl[0]='库内';
$sl[1]='正常使用中';
$sl[2]='损坏待送修';
$sl[3]='损坏正维修';
$sl[4]='报废';
$sl[5]='丢失';
$sl[6]='租期已过';
echo "TSStudio 工作室设备管理系统<br>";
echo "设备名称：".$qr["name"]."(ID:".$qr["id"].")<br>";
echo "当前状态：".$sl[$qr["status"]]."<br>";
echo "拥有部门：".$qr["owner"]."<br>";
?>