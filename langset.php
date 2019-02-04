<?php 
namespace maintask;
session_start();
header("Content-type: text/html; charset=utf-8");
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=settings.php&code=105');
    die();
}
include './include/server-info.php';
$lang=$_SESSION['language'];
$con=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
$l=$_POST['lang'];
$sname=strtolower($_SESSION['username']);
if ($l=="zh_CN"||$l=="en_US"){
    $con->query("update user set lang='{$l}' where name='{$sname}'");
    $_SESSION['language']=$l;
    include './include/'.$l.'.php';
    echo '<script>alert("'.$edsc.'");</script>';
    header('Refresh:0;url=settings.php');
}else{
    echo "Invalid value";
    header('Refresh:0;url=settings.php');
}
$con->close();
?>