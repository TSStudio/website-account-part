<?php
namespace maintask;
include './include/server-info.php';
$bgurl="./css/cert.png";
$info=getimagesize($bgurl);
$image=imagecreatefrompng($bgurl);
$font="./css/simhei.ttf";
$col=imagecolorallocatealpha($image,0,0,0,255);
$db=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
$sqll='SELECT * FROM auth where num=\''.strtolower($_GET["serial"]).'\'';
$rows = $db->query($sqll);
if (mysqli_num_rows($rows) < 1){
    $receive="错误：序列号不存在";
    $time="错误：序列号不存在";
    $content="错误：序列号不存在";
}
while($row = $rows->fetch_assoc()){
    $receive=$row['receive'];
    $time=date("y-m-j H:i:s",$row['time']);
    $content=$row['content'];
}
imagefttext($image,36,0,180,300,$col,$font,$receive);
imagefttext($image,36,0,150,365,$col,$font,$time);
imagefttext($image,36,0,20,500,$col,$font,$content);
imagefttext($image,18,0,180,670,$col,$font,$_GET["serial"]);
header("Content-type:".$info["mime"]);
imagepng($image);