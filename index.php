﻿<?php session_start();
error_reporting(E_ALL || ~E_NOTICE);
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=index.php&code=105');
die();
}
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
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
                <i class="iconfont icon-username"></i><?php echo $_SESSION['username']; ?>
        <table><tr><td><a href="logout.php?URL=index.php" style="font-style:normal;text-decoration:none;width:100%;" class="button button-caution"><i class="iconfont icon-login"></i><?=$ladc?></a></td></tr>
        <tr><td><a href="http://pan.tmysam.top/?session_id=<?php echo base64_encode(session_id());?>" style="font-style:normal;text-decoration:none;width:100%;" class="button button-primary"><i class="iconfont icon-disk"></i><?=$ls01?></a></td></tr>
        <tr><td><a href="reset.php" style="font-style:normal;text-decoration:none;width:100%;" class="button button-action"><i class="iconfont icon-refresh"></i><?=$ls02?></a></td></tr>
        <tr><td><a href="ebw.php" style="font-style:normal;text-decoration:none;width:100%;" class="button button-royal"><?=$ls03?></a></td></tr>
        <tr><td><a href="quest.php" style="font-style:normal;text-decoration:none;width:100%;" class="button button-highlight"><?=$ls04?></a></td></tr>
        <tr><td><a href="settings.php" style="font-style:normal;text-decoration:none;width:100%;" class="button button-tiny"><?=$ls05?></a></td></tr>
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