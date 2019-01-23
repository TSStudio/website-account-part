<html>
<head>
<link href="css/style.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">
<script defer src="./css/bgi.js"></script>
<title>Sign in</title>
</head>
<body id="body">
<?php
error_reporting(E_ALL || ~E_NOTICE);?>
    <div style="vertical-align: middle;" id="input-box">
        <form action="login.php?URL=<?php echo $_GET['URL'];?>" method="post" onsubmit="return enter()" style="margin:auto;" class="login info-input">
            <center><font style="font-size:3em;">Sign in</font></center><br>
            <table style="margin:auto;">
            <center style="background-color:rgba(255,50,50,0.5);"><i class="iconfont icon-warning"></i><?php if ($_GET['code']=="100"){echo 'Error:Password is different between the Confirm password!';}else if($_GET['code']=="101"){echo 'Error:One or more than one section is empty!';}else if($_GET['code']=="102"){echo 'Error:Special Letter has been found!';}else if($_GET['code']=="103"){echo 'Error:Password is not match to the user!';}else if($_GET['code']=="104"){echo 'Error:User not found!';}else if($_GET['code']=="105"){echo 'Error:You are not logged in!';}else if($_GET['code']=="106"){echo 'Error:Captcha is not correct!';}else if($_GET['code']=="107"){echo 'Error:User exist';}?></center><br>
            <tr><td><i class="iconfont icon-username"></i>Username</td><td><input type="text" name="username" id="username" class="input-box"></td></tr>
            <tr><td><i class="iconfont icon-key"></i>Password</td><td><input type="password" name="password" id="password" class="input-box"></td></tr>
            </table>
            <center>
            <input type="submit" value="Login" class="button button-royal"><br>
<p>Don't have an account?<a href="regform.php?URL=<?php echo $_GET['URL']?>&code=<?php echo $_GET['code']?>">Register</a></p>
            </center>
        </form> 
    </div>
 
  <script type="text/javascript"> 
    function enter() 
    { 
      var username=document.getElementById("username").value;//获取form中的用户名 
      var password=document.getElementById("password").value; 
      var regex=/^[/s]+$/;//声明一个判断用户名前后是否有空格的正则表达式 
      if(regex.test(username)||username.length==0)//判定用户名的是否前后有空格或者用户名是否为空 
        { 
          alert("用户名格式不对"); 
          return false; 
        } 
      if(regex.test(password)||password.length==0)//同上述内容 
      { 
        alert("密码格式不对"); 
        return false; 
      } 
      return true; 
    }
  </script> 
<br>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;Copyright &copy; 2014-<?php echo date('Y');?>.TS Studio All rights reserved.</p></div>
</body>
</html>