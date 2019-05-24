<?php session_start();
error_reporting(E_ALL || ~E_NOTICE);
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=login.php&code=105');
    die();
}
$sendbutton='<a href="#" onclick="chkandsend();">发送邮件</a>';
?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <title>更改邮箱</title>
        <script>
        window.onload=function(){
            secs=document.getElementByID("secleft");
        }
        ajax=new XMLHttpRequest();
        function timepass(){
            if(timeleft==0){
                secs.innerText="";
            }else{
                timeleft--;
                secs.innerText="倒计时:"+timeleft+"秒";
            }
        }
        function timer(){
            timeleft=60;
            setTimeout("timepass();",1000);
        }
        function sendmail(){
            ajax.open("POST","apis/mailsend.php",false);
            ajax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            ajax.send();
            res=ajax.responseText;
            
        }
        function chkandsend(){
            if(timeleft>0){
                alert('请勿重复操作！');
            }else{
                sendmail();
            }
        }
        </script>
    </head>
    <body id="body" class="lazy">
        <div class="paybox"><!--Main-->
            <h1>更改邮箱/Update Email</h1>
            <h2>你需要进行的操作(当你中途退出登录，所有内容消失)</h2>
            1.验证现有邮箱 <?=$_SESSION["email"]?>
            <?php
            if(empty($_SESSION["email"])){
                echo "由于没有原邮箱，则无需验证!";
                $_SESSION["FirstStep"]=true;
            }else if(!$_SESSION["isEmailConfirmed"]){
                echo "由于原邮箱未验证，则无需验证!";
                $_SESSION["FirstStep"]=true;
            }else{
                echo $sendbutton.'<font id="secleft"></font>';
                $_SESSION["FirstStep"]=false;
            }
            ?><br>&nbsp;&nbsp;-未完成(如果你已经验证，请刷新后进行下一步)<br>
            2.输入并验证新邮箱
        </div>
        <div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
    </body>
    <script src="./css/bgi.js"></script>
</html>