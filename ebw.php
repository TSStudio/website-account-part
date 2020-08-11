<?php 
session_start();
error_reporting(E_ALL || ~E_NOTICE);
header("Content-type: text/html; charset=utf-8");
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=ebw.php&code=105');
die();
}
include './include/classes.php';
$includer=true;
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <link href="css/pct.css" rel="stylesheet">
        <title>Fortress II:Siege</title>
        <script>
            function buy(cass,cost){
                if(confirm("<?=$ebb2?>"+cost+"<?=$ebpt?>")){
                    window.location.href="pay.php?class="+cass;
                }
            }
            function showhelp(){
                alert("<?=$ebhm?>");
            }
        </script>
        <?php
                $db=new \mysqli($dbhost,$dbuser,$dbpawd,$dbname);
                if ($db->connect_errno) {
                    printf("Connect failed: %s\n", $db->connect_error);
                    exit();
                }
                $sqll='SELECT * FROM point where Username=\''.strtolower($_SESSION['username']).'\'';
                $rows = $db->query($sqll);
                if (mysqli_num_rows($rows) < 1){
                    header('Refresh:0;url=firsttime.php');
                    die();
                }
                while($row = $rows->fetch_assoc()){
                    $dbpoint=$row['Point'];
                    $dblvlp=$row['lvlp'];
                    $crtt=$row['crtt'];
                }
                if($dblvlp<500){
                    $lvl=$ebl1;
                    $next=500;
                    $percent=$dblvlp/$next*100;
                    $lvlb=1;
                }else if($dblvlp<1500){
                    $lvl=$ebl2;
                    $next=1500;
                    $percent=$dblvlp/$next*100;
                    $lvlb=2;
                }else if($dblvlp<2500){
                    $lvl=$ebl3;
                    $next=2500;
                    $percent=$dblvlp/$next*100;
                    $lvlb=3;
                }else{
                    $lvl=$ebl4;
                    $next=2500;
                    $percent=100;
                    $lvlb=4;
                }
                ?>
                <style type="text/css">
                    .LVLB{
                        width:<?php echo $percent.'%';?>;
                    }
                </style>
        </head>
        <body id="body">
        <div id="Main" style="
    margin-bottom:50px;">
            <i class="iconfont icon-username"></i><?php echo $_SESSION['username']; ?><br>
            <a href="index.php" class="button button-primary"><i class="iconfont icon-i-back"></i><?=$back?></a><br>
            <?=$ebcp?>:(<a href="#" onclick="showhelp();">?</a>)：<?php echo $dbpoint;?>
            <div class="LINEBOX"><div class="PERCENT LVLB"><nobr><center><?php echo $lvl.' '.$dblvlp.'/'.$next;?></center></nobr></div></div>
    <br>
    <?php
    echo $ebde;
    global $ebch;
    global $ebcd;
    function replacement($num,$row){
        $str=str_replace("1",$GLOBALS['ebch'],$row[(string)$num]);
        $str=str_replace("0",$GLOBALS['ebcd'],$str);
        return $str;
    }
    function showbuy($able2buy,$str){
        if($able2buy){
            return $str;
        }
        return;
    }
    $rows=null;
    $row=null;
    $rows = $db->query('SELECT * FROM class where username=\''.strtolower($_SESSION['username']).'\'');
    if (mysqli_num_rows($rows) < 1){
        $username=strtolower($_SESSION['username']);
        $db->query("insert into class (username) values('{$username}')") or die("存入数据库失败");
        $rows=null;
        $rows = $db->query('SELECT * FROM class where username=\''.strtolower($_SESSION['username']).'\'');
    }
    while($row = $rows->fetch_assoc()){
        echo '<table border="1">';
        $times=1;
        while($times<=$classes){
            if($row[(string)$times]==1){
                $color="#5555CC";
                $able2buy=false;
            }else if($lvlb<$lvla[$level[$times]]){
                $color="#CC5555";
                $able2buy=false;
            }else{
                $color="#55CC55";
                $able2buy=true;
            }
            echo '<tr style="background-color:'.$color.';"><td>'.replacement($times,$row).'</td><td>'.$truename[$times].'</td><td>'.ucfirst($level[$times]).'</td><td>'.showbuy($able2buy,'<a href="#" onclick="buy('.$times.','.$cost[$times].');">'.$ebex.'('.$cost[$times].$ebpt.')</a></td></tr>');
            $times++;
        }
        echo '</table>';
    }
?>
</div>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php
echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
</body>
<script defer src="./css/bgi.js"></script>
</html>