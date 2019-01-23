<?php
namespace maintask;
session_start(); ?>
<html>
<?php
    ini_set("display_errors", "On");
    error_reporting(E_ALL || E_STRICT);
    $username=$_POST['username'];//获取html中的用户名（通过post请求） 
    $password=hash("sha256", $_POST["password"]);//获取html中的密码（通过post请求） 
    include './include/server-info.php';
    $con=mysql_connect($dbhost,$dbuser,$dbpawd);//连接mysql 数据库
    if (!$con) { 
      die('数据库连接失败'.mysql_error()); 
    } 
    mysql_select_db($dbname,$con);//use user_info数据库； 
    $dbusername=null; 
    $dbpassword=null; 
    $result=mysql_query("select * from user where realname ='{$username}';");//查出对应用户名的信息，isdelete表示在数据库已被删除的内容 
    while ($row=mysql_fetch_array($result)) {//while循环将$result中的结果找出来 
      $dbusername=$row["realname"]; 
      $dbpassword=$row["password"]; 
    } 
    $pw = explode('$',$dbpassword);
    $salt=$pw['2'];
    $pass=$pw['3'];
    $password = hash("sha256", $password.$salt);
    if (is_null($dbusername)) {//用户名在数据库中不存在时跳回
  ?> 
  <script type="text/javascript"> 
    alert("用户名不存在"); 
    //window.location.href="loginform.php?code=104&URL=<?php echo $_GET["URL"];?>"; 
  </script> 
  <?php  
    } 
    else { 
      if ($pass!=$password){//当对应密码不对时跳回
  ?> 
  <script type="text/javascript"> 
    alert("密码错误"); 
    window.location.href="loginform.php?code=103&URL=<?php echo $_GET["URL"];?>"; 
  </script> 
  <?php  
      } 
      else { 
        list($msec, $sec) = explode(' ', microtime());
        $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        $realip = $_SERVER["REMOTE_ADDR"];
        mysql_query ( "update user set ip='{$realip}' where realname='{$username}'" ) or die("存入数据库失败".mysql_error()) ; 
        mysql_query ( "update user set lastlogin='{$msectime}' where realname='{$username}'" ) or die("存入数据库失败".mysql_error()) ; 
        $_SESSION["username"]=$username; 
        $_SESSION["code"]=mt_rand(0, 100000);//给session附一个随机值，防止用户直接通过调用界面访问
  ?> 
  <script type="text/javascript"> 
    window.location.href="<?php echo $_GET["URL"]."?session_id=".session_id();?>"; 
  </script> 
  <?php  
      } 
    } 
  mysql_close($con);//关闭数据库连接，如不关闭，下次连接时会出错 
  ?> 
</html>