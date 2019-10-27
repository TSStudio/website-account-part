<?php session_start();
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
include './include/load.php';
if ($lang=="zh_CN"){
    $zhcn='selected';
    $enus='';
}else if ($lang=="en_US"){
    $enus='selected';
    $zhcn='';
}
$ipv6=strpos($_SERVER["HTTP_X_FORWARDED_FOR"],":")?"IPV6":"IPV4";
 ?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        
        <title><?=$htit?></title>
    </head>
    <body id="body" class="lazy">
        <div id="load">
            <i class="fa fa-spinner fa-pulse fa-5x" style="position:absolute;left:50%;top:50%;transform:translate(-50%,-50%);"></i>
        </div>
        <div id="Main" style="display:none;">
                <?php
                error_reporting(E_ALL || ~E_NOTICE);
                if ($_SESSION['username']==""){
                    echo "You are not logging in,jumping to the log-in page.";
                    header('Refresh:0;url=loginform.php?URL=settings.php&code=105');
                    die();
                }
                $services=array("ebw-class-show"=>"ff","ebw-class-buy"=>"off","ebw-level-show"=>"on","email-send"=>"on","password-reset"=>"on","video"=>"on","BLOGGER"=>"on");
                $available="<h4>".$avsv."</h4><br>";
                $navailabl="<h4>".$navs."</h4><br>";
                foreach($services as $serv=>$stat){
                    if($stat=="on"){
                        $available=$available.$serv."<br>";
                    }else if($stat=="off"){
                        $navailabl=$navailabl.$serv."<br>";
                    }
                };
                $status=$available."<br>".$navailabl;
                ?>
                <h2><?=$setn?></h2>
                <i class="iconfont icon-username"></i><?php echo $_SESSION['username']; ?><br>
                <a href="index.php" class="button button-primary"><i class="iconfont icon-i-back"></i><?=$back?></a><br>
                <h3>语言/Language</h3>
                <form action="langset.php" method="post">
                <select name="lang" style="color:#111111;">
                <option value="zh_CN" style="color:#111111;" <?=$zhcn?>>简体中文</option>
                <option value="en_US" style="color:#111111;" <?=$enus?>>English(US)</option>
                </select>
                <br><br>
                <input type="submit" value="更改/Confirm">
                </form>
                <h3>安全/Security</h3>
                Your Email:<?=$_SESSION['email']?>
                <?php
                    if($_SESSION['isEmailConfirmed']){
                        echo '<font style="background-color:#33EE33;color:#222222;">已验证/Confirmed</font>';
                    }else{
                        echo '<font style="background-color:#EE3333;color:#222222;">未验证/Not Confirmed</font>';
                    }

                ?>
                <a href="reemail.php" class="button button-royal">更改/Update</a><br>
                <h3>状态/Status</h3>
                <?=$status?>
                <h3>服务器负载/Server Load</h3>
                <!--构造框架-->
                TSS负载指数：
                <div class="loadp <?=$clr?>">
                <center><?=$load?></center>
                </div>
                <h4>网络/Network</h4>
                <div><?=$ipv6?></div>
                <h5>TSS Website - ACCOUNT SYSTEM VERSION 19A1</h5>
        </table>
        </div>
        <script>
            document.getElementById('Main').style.display='none';
            document.getElementById('load').style.display='block';
            function load(){
                document.getElementById('load').style.display='none';
                document.getElementById('Main').style.display='block';
            }
            setTimeout('load()',500);
        </script>
        </div>
        <div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php
echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
    </body>
    <script src="./css/bgi.js"></script>
</html>