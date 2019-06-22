<?php
session_start();
header("Content-type: text/html; charset=utf-8");
include './include/server-info.php';
error_reporting(E_ALL || ~E_NOTICE);
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=index.php&code=105');
    die();
}
if(isset($_REQUEST['authcode'])){
    if(strtolower($_REQUEST['authcode'])!= $_SESSION['authcode']){
        //提示以及跳转页面
        echo "<script language=\"javascript\">";
        echo "alert(\"验证码错误\");";
        echo "document.location=\"./quest.php\"";
        echo "</script>";
        exit();
    }
} 
$uid=$_POST['uid'];
$content=$_POST['content'];
if(empty($uid)||empty($content)){
    echo '<script>alert("UID或内容不能为空");</script>';
    header('Refresh:0;url=quest.php');
    die();
}
$content=str_replace('<','&lt;',$content);
$content=str_replace('>','&gt;',$content);
$con=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
$time=time();
$serial=hash("sha512",$time);
$username=$_SESSION['username'];
$con->query("insert into quest (username,uid,time,content,status,serial) values('{$username}','{$uid}','{$time}','{$content}',1,'{$serial}')") or die("存入数据库失败".mysqli_error()); 
$con->close (); 
echo '<script>alert("审核中");</script>';
header('Refresh:0;url=quest.php');
?>