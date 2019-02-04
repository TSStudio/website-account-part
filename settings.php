<?php session_start();
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
if ($lang=="zh_CN"){
    $zhcn='selected';
    $enus='';
}else if ($lang=="en_US"){
    $enus='selected';
    $zhcn='';
}
 ?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <script src="./jquery-3.3.1.min.js"></script>
        <script src="./jquery.lazyload.min.js"></script>
        <script src="./css/bgi.js"></script>
        <script>
            $(function(){
            $("body.lazy").lazyload({
                effect: 'fadeIn',
                threshold: '200',
                failure_limit: '10'
            });
            });
        </script>
        <title><?=$htit?></title>
    </head>
    <body id="body" class="lazy" data-original="css/background.png">
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
                }?>
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
</html>