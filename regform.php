<?php
session_start();
error_reporting(E_ALL || ~E_NOTICE);
?>
<html>
<head>
<title>Sign up</title>
<link href="css/style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">
<script defer src="./css/bgi.js"></script>
</head>
<body id="body">
    <div style="vertical-align: middle;" id="input-box">
        <form action="register.php?URL=<?php echo $_GET['URL'];?>" method="post" onsubmit="return check()" style="margin:auto;" class="reg info-input">
            <center><font style="font-size:3em;">Sign up</font></center><br>
            <table style="margin:auto;">
            <center style="background-color:rgba(255,50,50,0.5);"><i class="iconfont icon-warning"></i><?php if ($_GET['code']=="100"){echo 'Error:Password is different between the Confirm password!';}else if($_GET['code']=="101"){echo 'Error:One or more than one section is empty!';}else if($_GET['code']=="102"){echo 'Error:Special Letter has been found!';}else if($_GET['code']=="103"){echo 'Error:Password is not match to the user!';}else if($_GET['code']=="104"){echo 'Error:User not found!';}else if($_GET['code']=="105"){echo 'Error:You are not logged in!';}else if($_GET['code']=="106"){echo 'Error:Captcha is not correct!';}else if($_GET['code']=="107"){echo 'Error:User exist';}?></center><br>
            <tr><td><i class="iconfont icon-username"></i>Username</td><td><input type="text" name="username" id="username" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i>Password</td><td><input type="password" name="password" id="password" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i>Confirm Password</td><td><input type="password" name="assertpassword" id="assertpassword" class="input-box"></td></tr>
            <tr><td>Captcha</td><td><input type="text" name='authcode' value='' class="input-box" style="width:30%;"/><a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./captcha.php?r='+Math.random()"><img id="captcha_img" border='1' src='./captcha.php?r=echo rand(); ?>' style="width:100px; height:30px" /></a></td></tr>
            </table>
            <center>
            当您点击注册即代表同意<a href="Policy.html" target="view_window">条款</a><br>
            <input type="submit" value="Register" class="button button-primary"><br>
            <p>Have an account?<a href="loginform.php?URL=<?php echo $_GET['URL']?>&code=<?php echo $_GET['code']?>">Login</a></p>
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
        alert("用户名格式不对"); 
        return false; 
      } 
      if(regex.test(password)||password.length==0){ 
        alert("密码格式不对"); 
        return false;     
      } 
      if(password!=assertpassword){ 
        alert("两次密码不一致"); 
        return false; 
      } 
    } 
  </script>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;Copyright &copy; 2014-<?php echo date('Y');?>.TS Studio All rights reserved.</p></div>
</body>
</html>