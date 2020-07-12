<?php
session_start();
error_reporting(E_ALL || ~E_NOTICE);
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=ebw.php&code=105');
    die();
}
$includer=true;
include './include/server-info.php';
?>
<html>
<body>
  <?php
    $username=strtolower($_SESSION['username']);
    $con=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
    $dbusername=null; 
    $result = $con->query ( "select * from point where Username ='{$username}';" ); 
    while ($row=mysqli_fetch_array($result)) {//while循环将$result中的结果找出来 
      $dbusername=$row["Username"]; 
    }
    if (is_null ( $dbusername )) {
        $con->query("insert into point (Username,Point) values('{$username}',0)") or die($username.$dbusername."存入数据库失败".mysql_error()) ;
    }
    echo '<script>window.location.href="ebw.php";</script>';
?>