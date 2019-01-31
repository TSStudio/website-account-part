<?php 
namespace maintask;
session_start();
header("Content-type: text/html; charset=utf-8");
include './include/classes.php';
include './include/server-info.php';
?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <link href="css/pct.css" rel="stylesheet">
        <script defer src="./css/bgi.js"></script>
        <title>Fortress II:Siege</title>
        <script>
            function buy(cass,cost){
                frsc=confirm('请确认该用户名和游戏用户名完全一致（包括大小写）');
                if(frsc&&confirm("你确定要购买此职业吗，这将花费你"+cost+"积分")){
                    window.location.href="exchange.php?class="+cass;
                }
            }
            function showhelp(){
                alert("此积分如有问题，请向管理员反馈。通过玩Fortress II : Siege可获得更多积分");
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
                    $lvl="Fortress Noob";
                    $next=500;
                    $percent=$dblvlp/$next*100;
                    $lvlb=1;
                }else if($dblvlp<1500){
                    $lvl="Fortress Starter";
                    $next=1500;
                    $percent=$dblvlp/$next*100;
                    $lvlb=2;
                }else if($dblvlp<2500){
                    $lvl="Fortress Pro";
                    $next=2500;
                    $percent=$dblvlp/$next*100;
                    $lvlb=3;
                }else{
                    $lvl="Fortress Star";
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
            <div id="Main">
                <?php
                error_reporting(E_ALL || ~E_NOTICE);
                if ($_SESSION['username']==""){
                    echo "You are not logging in,jumping to the log-in page.";
                    header('Refresh:0;url=loginform.php?URL=ebw.php&code=105');
                    die();
                }?>
                <i class="iconfont icon-username"></i><?php echo $_SESSION['username']; ?><br>
                <a href="index.php" class="button button-primary"><i class="iconfont icon-i-back"></i>返回</a><br>
                职业积分:(<a href="#" onclick="showhelp();">?</a>)：<?php echo $dbpoint;?>
                <div class="LINEBOX"><div class="PERCENT LVLB"><center><?php echo $lvl.' '.$dblvlp.'/'.$next;?></center></div></div>
    <br>职业：(蓝色已经拥有，绿色可以兑换，红色因为你等级过低不能兑换，按照推出时间排列)
    <?php
    function replacement($num,$row){
        $str=str_replace("1","拥有",$row[(string)$num]);
        $str=str_replace("0","未拥有",$str);
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
    $rows = $db->query('SELECT * FROM class where username=\''.strtolower($_SESSION['username']).'\'');//用sql语句获取数据
    if (mysqli_num_rows($rows) < 1){
        $username=strtolower($_SESSION['username']);
        $db->query("insert into class (username) values('{$username}')") or die("存入数据库失败");
        $rows=null;
        $rows = $db->query('SELECT * FROM class where username=\''.strtolower($_SESSION['username']).'\'');//用sql语句获取数据
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
            echo '<tr style="background-color:'.$color.';"><td>'.replacement($times,$row).'</td><td>'.$truename[$times].'</td><td>'.ucfirst($level[$times]).'</td><td>'.showbuy($able2buy,'<a href="#" onclick="buy('.$times.','.$cost[$times].');">兑换('.$cost[$times].'积分)</a></td></tr>');
            $times++;
        }
        echo '</table>';
    }
?>
</div>
<div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;Copyright &copy; 2014-<?php echo date('Y');?>.TS Studio All rights reserved.</p></div>
</body>
</html>