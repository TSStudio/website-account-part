<?php
namespace maintask;
include './include/server-info.php';
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Original Author <author@example.com>                        |
// |          Your Name <you@example.com>                                 |
// +----------------------------------------------------------------------+
//
// $Id:$

session_start();
error_reporting(E_ALL || ~ E_NOTICE);
?>
<html>
<body>
  <?php
if (isset($_REQUEST['authcode'])) {
    if (strtolower($_REQUEST['authcode']) != $_SESSION['authcode']) {
        //提示以及跳转页面
        echo "<script language=\"javascript\">";
        echo "alert(\"验证码错误\");";
        echo "document.location=\"./reset.php\"";
        echo "</script>";
        exit();
    }
}
function random($length) {
    srand(date("s"));
    $possible_charactors = "0123456789abcdef";
    $string = "";
    while (strlen($string) < $length) {
        $string.= substr($possible_charactors, (rand() % (strlen($possible_charactors))) , 1);
    }
    return ($string);
}
$username = $_SESSION['username'];
$oldpassword = hash("sha256", $_POST["oldpw"]);
$newpassword = hash("sha256", $_POST["password"]);
$con = mysql_connect($dbhost, $dbuser, $dbpawd);
mysql_select_db($dbname, $con);
$dbusername = null;
$dbpassword = null;
$result = mysql_query("select * from user where realname ='{$username}';");
while ($row = mysql_fetch_array($result)) {
    $dbusername = $row["realname"];
    $dbpassword = $row["password"];
}
//
$pw = explode('$', $dbpassword);
$salt = $pw['2'];
$pass = $pw['3'];
$password = hash("sha256", $oldpassword . $salt);
if (is_null($dbusername)) {
?> 
  <script type="text/javascript"> 
    alert("用户名处理错误"); 
    window.location.href="index.php"; 
  </script>  
  <?php
}
if ($password != $pass) {
?> 
  <script type="text/javascript"> 
    alert("密码错误"); 
    window.location.href="reset.php"; 
  </script> 
  <?php
}
$randomstr = random(15);
$newpassword = hash("sha256", $newpassword . $randomstr);
$newpassword = '$SHA$' . $randomstr . '$' . $newpassword;
mysql_query("update user set password='{$newpassword}' where realname='{$username}'") or die("存入数据库失败" . mysql_error()); //如果上述用户名密码判定不错，则update进数据库中
mysql_close($con);
?> 
 
 
  <script type="text/javascript"> 
    alert("密码修改成功"); 
    window.location.href="index.php"; 
  </script> 
?>
</body>
</html>
