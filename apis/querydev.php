<?php
error_reporting(E_ALL || ~E_NOTICE);
include '../include/server-info.php';
$db=mysqli_connect($dbhost, $dbuser, $dbpawd, $dbname);
$sql = 'select * from devices where id=?';
$stmt = $db->prepare($sql);
$stmt->bind_param('i',$_GET["id"]);
$stmt->bind_result($name,$id,$status,$owner);
$stmt->execute();
$db->close();
$sl=array();
$sl[0]='库内';
$sl[1]='正常使用中';
$sl[2]='损坏待送修';
$sl[3]='损坏正维修';
$sl[4]='报废';
$sl[5]='丢失';
$sl[6]='租期已过';
echo "TSStudio 工作室设备管理系统";
echo "设备名称：".$name."(ID:".$id.")<br>";
echo "当前状态：".$sl[$status]."<br>";
echo "拥有部门：".$owner."<br>";
?>