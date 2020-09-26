<?php
session_start();
?>
<html>
<?php
    ini_set("display_errors", "Off");
    if($_SERVER['REQUEST_METHOD']!='POST'){
        echo "非法请求";
        header('Refresh:0;url=loginform.php?URL=index.php&code=105');
        die();
    }
    if(!isset($_POST['username'])||!isset($_POST['password'])){
        echo "非法请求";
        header('Refresh:0;url=loginform.php?URL=index.php&code=105');
        die();
    }
    $username=$_POST['username'];
    if(strpos($username," ")||strpos($username,"--")||strpos($username,"/*")||strpos($username,"*/")){
        ?>
        <script type="text/javascript">
        alert("用户名含有非法字符");
        window.location.href="loginform.php?code=103&URL=<?php echo $_GET["URL"];?>";
        </script> 
        <?php  
        die();
    }
    $password=hash("sha256", $_POST["password"]);
    $includer=true;
    include './include/server-info.php';
    $con=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);//挂载数据库
    if (!$con) { 
        header('Refresh:0;url=loginform.php?URL=index.php&code=105');
        die('数据库连接失败'.mysqli_error()); 
    }
    $dbusername=null; 
    $dbpassword=null; 
    $result=$con->query("select realname,password,lang,email,isEmailConfirmed from user where realname ='{$username}';");
    while ($row=mysqli_fetch_array($result)) {
        $dbusername=$row["realname"]; 
        $dbpassword=$row["password"]; 
        $dblanguage=$row["lang"];
        $dbemail=$row["email"];
        $isDbemailConfirmed=$row["isEmailConfirmed"];
    } 
    $pw = explode('$',$dbpassword);
    $salt=$pw['2'];
    $pass=$pw['3'];
    $password = hash("sha256", $password.$salt);
    if (is_null($dbusername)){//用户名在数据库中不存在时跳回
        ?>
        <script type="text/javascript">
            alert("用户名不存在");
            window.location.href="loginform.php?code=104&URL=<?php echo $_GET["URL"];?>";
        </script> 
        <?php  
    }else{ 
        if($pass!=$password){//当对应密码不对时跳回
            ?>
            <script type="text/javascript">
                alert("密码错误");
                window.location.href="loginform.php?code=103&URL=<?php echo $_GET["URL"];?>";
            </script>
            <?php
        }else{
            list($msec, $sec) = explode(' ', microtime());
            $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            $con->query ( "update user set ip='{$realip}' where realname='{$username}'" ) or die("存入数据库失败".mysql_error());
            $con->query ( "update user set lastlogin='{$msectime}' where realname='{$username}'" ) or die("存入数据库失败".mysql_error());
            $_SESSION["language"]=$dblanguage;
            $_SESSION["username"]=$username;
            if($isDbemailConfirmed==1){
                $_SESSION["isEmailConfirmed"]=true;
            }else{
                $_SESSION["isEmailConfirmed"]=false;
            }
            $_SESSION["email"]=$dbemail;
            if(isset($_GET["URL"])){
                ?>
                <script type="text/javascript">
                    window.location.href="<?php echo $_GET["URL"];?>";
                </script>
                <?php
            }else{
                ?>
                <script type="text/javascript">
                    window.location.href="<?php echo $_GET["URL"];?>";
                </script>
                <?php
            } 
        } 
    } 
    mysqli_close($con);//关闭数据库连接，如不关闭，也没事，反正就，书上这么写的就这么做吧。
?> 
</html>