<?php
namespace maintask;
include './include/server-info.php';
header("Content-type: text/html; charset=utf-8");
session_start();
error_reporting(E_ALL || ~ E_NOTICE);
?>
<html>
<body>
  <?php
$iptru=$_SERVER["HTTP_X_FORWARDED_FOR"];
$url='https://ssl.captcha.qq.com/ticket/verify?aid='.$captappid.'&AppSecretKey='.$captappsecret.'&Ticket='.$_POST['ticket'].'&Randstr='.$_POST['randstr'].'&UserIP='.$iptru;
$html = file_get_contents($url);
$json = json_decode($html,true);
if($json['response']!=1){
    echo '验证失败';
}
$username = $_POST["username"];
if(strpos($username," or ")||strpos($username,"--")||strpos($username,"/*")||strpos($username,"*/")){
    ?> 
  <script type="text/javascript"> 
    alert("用户名含有非法字符"); 
    window.location.href="loginform.php?code=103&URL=<?php echo $_GET["URL"];?>"; 
  </script> 
  <?php
    die();
    }
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
$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
mysql_query("insert into user (username,regip,ip,world,x,y,z,regdate,lastlogin,name,realname,password) values('0','{$realip}','{$realip}','world','0','0','0','{$msectime}','{$msectime}','{$realname}','{$username}','{$password}')") or die("存入数据库失败" . mysql_error());
mysql_close($con);
$_SESSION["username"] = $username;
$_SESSION["id"] = $time;
$_SESSION["language"] = "zh_CN";
?> 
  <script type="text/javascript"> 
    alert("注册成功"); 
    window.location.href="index.php"; 
  </script> 
</body>
</html>
