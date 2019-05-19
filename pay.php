<?php session_start();
error_reporting(E_ALL || ~E_NOTICE);
include './include/server-info.php';
include './include/classes.php';
$lang=$_SESSION['language'];
include './include/'.$lang.'.php';
if(!isset($_GET['class'])){
    header('Refresh:0;url=ebw.php');
    die();
}
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=login.php&code=105');
    die();
}
$username=strtolower($_SESSION['username']);
$class=$_GET['class'];
if(!is_numeric($class)){
    die("错误，请返回");
}else if($class>$classes){
    die("错误，请返回");
}
$value=$cost[$class];
$con=new mysqli($dbhost,$dbuser,$dbpawd,$dbname);
$dbusername=null;
$dbjob=null;
$result = $con->query( "select username,`{$class}` from class where username ='{$username}';" ); 
while ($row=mysqli_fetch_array($result)) {//while循环将$result中的结果找出来 
    $dbusername=$row["username"]; 
    $dbjob=$row[$class]; 
}
if ($dbjob==1){
    //如果拥有职业
    $owned=true;
}
$result=null;
//检测职业积分是否够，等级积分是否够
$result = $con->query( "select * from point where Username ='{$username}';" ); 
while ($row=mysqli_fetch_array($result)) {//while循环将$result中的结果找出来 
    $dbusername=$row["Username"]; 
    $dbpoint=$row["Point"]; 
    $dblvlp=$row["lvlp"];
}
if($dblvlp<500){
    $lvlb=1;
}else if($dblvlp<1500){
    $lvlb=2;
}else if($dblvlp<2500){
    $lvlb=3;
}else{
    $lvlb=4;
}
$classlvl=$level[$class];
$canbuy=true;
if($lvlb<$lvla[$classlvl]){//等级不够
    $canbuy=false;
    $show=$lvtl;
    $chkidshow=$egcl;
}else if($dbpoint<$cost[$class]){//积分不够
    $canbuy=false;
    $show=$nept;
    $chkidshow=$egcl;
}else if($owned){//拥有职业
    $canbuy=false;
    $show=$ebch;
    $chkidshow=$egcl;
}else{
    $canbuy=true;
    //可以购买，则
    //生成购买信息
    $con->query("insert into payment (username,value,obj) values ('{$username}','{$value}','{$class}')");
    $result=$con->query("select chkid from payment where username='{$username}' and status=0");
    while ($row=mysqli_fetch_array($result)) {//while循环将$result中的结果找出来 
        $chkid=$row["chkid"];
    }
    //订单号格式化
    $strinneed="100000000000000000000";
    $outs=$strinneed.$chkid;
    $chkidshow=substr($outs, -20);
}
//删除未完成订单
$con->query("delete from payment where username='{$username}' and status=0");
if($canbuy){
    $_SESSION["CHECKID"]=$chkid;
    $chkbutt='<a href="exchange.php" class="button button-pill button-primary">'.$chec.'</a>';
}else{
    $chkid=$egcl;
    $chkbutt='<a href="#" class="button button-pill button-tiny">'.$show.'</a>';
}
?>

<html>
    <head>
        <link href="css/style.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
        <title><?=$cash?></title>
    </head>
    <body id="body" class="lazy">
        <div class="paybox"><!--Main-->
            <h1><?=$cash?></h1>
            <h2><?=$objb?></h2>
            <?=$f2sj?><?=$truename[$class]?>
            <div class="deti">
                <?=$poin?><?=$dbpoint?><br>
                <?=$pcos?><?=$cost[$class]?><br>
                <?=$pres?><?=$dbpoint-$cost[$class]?><br>
                <?=$chid?><?=$chkidshow?><br>
                <!--结算按钮-->
                <?=$chkbutt?>
            </div>
        </div>
        <div style="color:white;" class="copyright"><p>&nbsp;&nbsp;&nbsp;<?=$copyright?>&copy; 2014-<?php echo date('Y'); ?>.TS Studio <?=$alrr?> 吉ICP备17003700号</p></div>
    </body>
    <script src="./css/bgi.js"></script>
</html>