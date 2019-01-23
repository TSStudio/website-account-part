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
    session_start();
    if (strtolower($_REQUEST['authcode']) != $_SESSION['authcode']) {
        //提示以及跳转页面
        echo "<script language=\"javascript\">";
        echo "document.location=\"./regform.php?URL=" . $_GET['URL'] . "&code=106\"";
        echo "</script>";
        exit();
    }
}
$username = $_POST["username"];
$password = hash("sha256", $_POST["password"]);
function random($length) {
    srand(date("s"));
    $possible_charactors = "0123456789abcdef";
    $string = "";
    while (strlen($string) < $length) {
        $string.= substr($possible_charactors, (rand() % (strlen($possible_charactors))) , 1);
    }
    return ($string);
}
$randomstr = random(15);
$password = hash("sha256", $password . $randomstr);
$password = '$SHA$' . $randomstr . '$' . $password;
$con = mysql_connect($dbhost, $dbuser, $dbpawd);
if (!$con) {
    die('数据库连接失败' . $mysql_error());
}
mysql_select_db($dbname, $con);
$dbusername = null;
$dbpassword = null;
$result = mysql_query("select * from user where realname ='{$username}';");
while ($row = mysql_fetch_array($result)) {
    $dbusername = $row["realname"];
    $dbpassword = $row["password"];
}
if (!is_null($dbusername)) {
?>
  <script type="text/javascript"> 
    alert("用户已存在"); 
    window.location.href="regform.php?URL=<?php
    echo $_GET['URL']; ?>&code=107"; 
  </script>  
  <?php
}
list($msec, $sec) = explode(' ', microtime());
$msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
$realname = strtolower($username);
$realip = $_SERVER["REMOTE_ADDR"];
mysql_query("insert into user (username,regip,ip,world,x,y,z,regdate,lastlogin,name,realname,password) values('0','{$realip}','{$realip}','world','0','0','0','{$msectime}','{$msectime}','{$realname}','{$username}','{$password}')") or die("存入数据库失败" . mysql_error());
mysql_close($con);
$_SESSION["username"] = $username;
$_SESSION["id"] = $time;
?> 
  <script type="text/javascript"> 
    alert("注册成功"); 
    window.location.href="index.php"; 
  </script> 
</body>
</html>
