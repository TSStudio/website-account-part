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
include './include/server-info.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
?>
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
        $finaloutput="";
        $finaloutput=$finaloutput.'你曾经拥有<br>';
        $times=1;
        while($times<=$classes){
            if($row[(string)$times]==1){
                $finaloutput=$finaloutput.$truename[$times]." ";
            }
            $times++;
        }
        $finaloutput=$finaloutput.'<br>这只是一个记录，未来这些职业的处理方式如何暂时未知。';
    }
?>
<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <link href="css/pct.css" rel="stylesheet">
        <title>Fortress II:Siege</title>
        <style type="text/css">
            .LVLB{
                width: <?=$percent.'%'?>;
            }
        </style>
    </head>
    <body id="body" class="lazy">
        <div class="paybox"><!--Main-->
            <h1>Fortress II:Siege 已终止服务</h1>
            <div class="LINEBOX"><div class="PERCENT LVLB"><nobr><center><?php echo $lvl.' '.$dblvlp.'/'.$next;?></center></nobr></div></div>
            <div class="deti">
                <?=$finaloutput?>
            </div>
        </div>
        <div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
    </body>
    <script src="./css/bgi.js"></script>
</html>