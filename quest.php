<?php 
session_start();
error_reporting(E_ALL || ~E_NOTICE);
header("Content-type: text/html; charset=utf-8");
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=quest.php&code=105');
die();
}
include './include/classes.php';
$includer=true;
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
error_reporting(E_ALL || ~E_NOTICE);
?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <script defer src="./css/bgi.js"></script>
        <title><?=$qtit?></title>
        </head>
        <body id="body">
        <div id="Main">
        <i class="iconfont icon-username"></i><?php echo $_SESSION['username']; ?><br>
        <a href="index.php" class="button button-primary"><i class="iconfont icon-i-back"></i><?=$back?></a><br>
        <?=$ylis?>
        <?php
        $db=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
        if ($db->connect_errno) {
            printf("Connect failed: %s\n", $db->connect_error);
            exit();
        }
        $sqll='SELECT * FROM quest where username=\''.$_SESSION['username'].'\'';
        $rows = $db->query($sqll);
        if (mysqli_num_rows($rows) < 1){
            echo "<br>".$nquy."<br>";
        }else{
            $rows = $db->query('SELECT * FROM quest where username=\''.$_SESSION['username'].'\';');
            echo '<br><table border="1"><tr><td>'.$lati.'</td><td>'.$laif.'</td><td>'.$buid.'</td><td>'.$lase.'</td><td>'.$last.'</td></tr>';
            while($row = $rows->fetch_assoc()){
                echo '<tr><td>'.date("y-m-j H:i:s",$row['time']).'</td>';
                echo '<td>'.$row['content']."</td>";
                echo '<td>'.$row['uid']."</td>";
                echo '<td>'.$row['serial']."</td>";
                if($row['status']==0){
                    $status=$qs01;
                }else if($row['status']==1){
                    $status=$qs02;
                }else if($row['status']==2){
                    $status=$qs03."(<a href=\"cert.php?serial=".$row['result']."\">".$vict."</a>)";
                }
                echo '<td>'.$status.'</td></tr>';
            }
            echo "</table><br>";
        }
        ?>
        <?=$gire?>
          <form action="qp.php" method="post" onsubmit="return enter()"> <br>
    <?=$buid?>:<input type="number" name="uid" id="uid"><?=$quct?><input type="text" name="content" id="content"><br>
    <?=$capt?>:<input type="text" name='authcode' value=''style="100px"/><a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='./captcha.php?r='+Math.random()"><img id="captcha_img" border='1' src='./captcha.php?r=echo rand(); ?>' style="width:100px; height:30px" /></a><br>
    <input type="submit" value="<?=$subm?>" class="button button-royal"> 
  </form> 
        </div>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php
echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
</body>
</html>