<?php 
namespace maintask;
session_start();
header("Content-type: text/html; charset=utf-8");
include './include/classes.php';
include './include/server-info.php';
error_reporting(E_ALL || ~E_NOTICE);
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=quest.php&code=105');
    die();
}?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <script defer src="./css/bgi.js"></script>
        <title>申请中心</title>
        </head>
        <body id="body">
        <div id="Main">
        你的授权申请列表：
        <?php
        $db=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
        if ($db->connect_errno) {
            printf("Connect failed: %s\n", $db->connect_error);
            exit();
        }
        $sqll='SELECT * FROM quest where username=\''.$_SESSION['username'].'\'';
        $rows = $db->query($sqll);
        if (mysqli_num_rows($rows) < 1){
            echo "<br>目前没有提交过授权申请<br>";
        }else{
            $rows = $db->query('SELECT * FROM quest where username=\''.$_SESSION['username'].'\';');
            echo '<br><table border="1"><tr><td>时间</td><td>信息</td><td>UID</td><td>序列号</td><td>状态</td></tr>';
            while($row = $rows->fetch_assoc()){
                echo '<tr><td>'.date("y-m-j H:i:s",$row['time']).'</td>';
                echo '<td>'.$row['content']."</td>";
                echo '<td>'.$row['uid']."</td>";
                echo '<td>'.$row['serial']."</td>";
                if($row['status']==0){
                    $status="未通过(原因已私信)";
                }else if($row['status']==1){
                    $status="审核中";
                }else if($row['status']==2){
                    $status="已通过(<a href=\"cert.php?serial=".$row['result']."\">查看证书</a>)";
                }
                echo '<td>'.$status.'</td></tr>';
            }
            echo "</table><br>";
        }
        ?>
        申请授权：
          <form action="qp.php" method="post" onsubmit="return enter()"> <br>
    B站UID：<input type="number" name="uid" id="uid">申请内容：<input type="text" name="content" id="content"><br>
    验证码:<input type="text" name='authcode' value=''style="100px"/><a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./captcha.php?r='+Math.random()"><img id="captcha_img" border='1' src='./captcha.php?r=echo rand(); ?>' style="width:100px; height:30px" /></a><br>
    <input type="submit" value="发送" class="button button-royal"> 
  </form> 
        </div>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;Copyright &copy; 2014-<?php echo date('Y');?>.TS Studio All rights reserved.</p></div>
</body>
</html>