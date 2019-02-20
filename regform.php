<?php
error_reporting(E_ALL || ~E_NOTICE);
include './include/zh_CN.php';
?>
<html>
<head>
<title><?=$regi?></title>
<link href="css/style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">
<script defer src="./css/bgi.js"></script>
</head>
<body id="body">
    <div style="vertical-align: middle;" id="input-box">
        <form action="register.php?URL=<?php echo $_GET['URL'];?>" method="post" onsubmit="return check()" style="margin:auto;" class="reg info-input">
            <center><font style="font-size:3em;"><?=$regi?></font></center><br>
            <table style="margin:auto;">
            <center style="background-color:rgba(255,50,50,0.5);"><i class="iconfont icon-warning"></i><?php if ($_GET['code']=="100"){echo $erro.$e100;}else if($_GET['code']=="101"){echo $erro.$e101;}else if($_GET['code']=="102"){echo $erro.$e102;}else if($_GET['code']=="103"){echo $erro.$e103;}else if($_GET['code']=="104"){echo $erro.$e104;}else if($_GET['code']=="105"){echo $erro.$e105;}else if($_GET['code']=="106"){echo $erro.$e106;}else if($_GET['code']=="107"){echo $erro.$e107;}?></center><br>
            <tr><td><i class="iconfont icon-username"></i><?=$usnm?></td><td><input type="text" name="username" id="username" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i><?=$lapw?></td><td><input type="password" name="password" id="password" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i><?=$cnpw?></td><td><input type="password" name="assertpassword" id="assertpassword" class="input-box"></td></tr>
            <tr><td><?=$capt?></td><td><input type="text" name='authcode' value='' class="input-box" style="width:30%;"/><a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./captcha.php?r='+Math.random()"><img id="captcha_img" border='1' src='./captcha.php?r=echo rand(); ?>' style="width:100px; height:30px" /></a></td></tr>
            </table>
            <center>
            <?=$wycr?><a href="Policy.html" target="view_window"><?=$lise?></a><br>
            <input type="submit" value="<?=$regi?>" class="button button-primary"><br>
            <p><?=$haac?><a href="loginform.php?URL=<?php echo $_GET['URL']?>&code=<?php echo $_GET['code']?>"><?=$logi?></a></p>
            </center>
        </form> 
    </div>
  <script type="text/javascript"> 
    function check() { 
      var username=document.getElementById("username").value; 
      var password=document.getElementById("password").value; 
      var assertpassword=document.getElementById("assertpassword").value; 
      var regex=/^[/s]+$/; 
       
      if(regex.test(username)||username.length==0){ 
        alert("<?=$lapw.$misw?>"); 
        return false; 
      } 
      if(regex.test(password)||password.length==0){ 
        alert("<?=$lapw.$misw?>"); 
        return false;     
      } 
      if(password!=assertpassword){ 
        alert("<?=$ttpd?>"); 
        return false; 
      } 
    } 
  </script>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php
echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
</body>
</html>