﻿<?php
namespace maintask;
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

session_start(); ?>
<html>
<head>
<link href="css/style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">
<script defer src="./css/bgi.js"></script>
<title>Reset Password</title>
</head>
<body id="body">
<?php
error_reporting(E_ALL || ~ E_NOTICE);
if ($_SESSION['username'] == "") {
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=index.php&code=105');
}
?>
<br>
    <div style="vertical-align: middle;" id="input-box">
        <form action="resetprocess.php?URL=<?php
echo $_GET['URL']; ?>" method="post" name="form_register" onsubmit="return check()" style="margin:auto;" class="reg info-input">
            <center><font style="font-size:3em;">Reset Password</font></center><br>
            <table style="margin:auto;">
            <tr><td><i class="iconfont icon-key"></i>Old password</td><td><input type="password" name="oldpw" id="username" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i>New Password</td><td><input type="password" name="password" id="password" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i>Confirm New Password</td><td><input type="password" name="assertpassword" id="assertpassword" class="input-box"></td></tr>
            <tr><td>Captcha</td><td><input type="text" name='authcode' value='' class="input-box" style="width:30%;"/><a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./captcha.php?r='+Math.random()"><img id="captcha_img" border='1' src='./captcha.php?r=echo rand(); ?>' style="width:100px; height:30px" /></a></td></tr>
            </table>
            <center>
            <table><tr><td><input type="submit" value="Confirm" class="button button-primary" style="font-style:normal;text-decoration:none;width:100%;"></td></tr><tr><td><a href="index.php" class="button button-action" style="font-style:normal;text-decoration:none;width:100%;">Back</a></td></tr></table>
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
        alert("旧密码格式不对"); 
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
</p>
</form>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;Copyright &copy; 2014-<?php
echo date('Y'); ?>.TS Studio All rights reserved.</p></div>
</body>
</html>