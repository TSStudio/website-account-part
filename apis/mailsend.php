<?
session_start();
error_reporting(E_ALL || ~E_NOTICE);
include './include/server-info.php';
$lang=$_SESSION['language'];
if ($_SESSION['username']==""){
    echo "You are not logging in,jumping to the log-in page.";
    header('Refresh:0;url=loginform.php?URL=login.php&code=105');
    die();
}
include_once 'include/aliyun-php-sdk-core/Config.php';
use Dm\Request\V20151123 as Dm;            
$iClientProfile = DefaultProfile::getProfile("cn-hangzhou", $aliaccesskey, $aliaccesssecret);        
$client = new DefaultAcsClient($iClientProfile);    
$request = new Dm\SingleSendMailRequest();     
$request->setAccountName("no-reply@mailsend.tmysam.top");
$request->setFromAlias("TSStudio");
$request->setAddressType(1);
$request->setTagName("TSStudio");
$request->setReplyToAddress("true");
$request->setToAddress($email);
$request->setSubject("TS Studio邮箱验证");
$address='https://account.tmysam.top/emailchc.php?secret='.$econfirm;
$htmlbody='<div style="background-color:#000000;"><div><b><font size="5" style="background-color: rgb(0, 0, 0);" color="#ffffff">TS Studio邮箱验证</font></b></div><div><font style="background-color: rgb(0, 0, 0);" color="#ffffff" size="4">刚刚有人使用此邮箱账号进行<a href="https://account.tmysam.top/" style="">本站</a>修改邮箱，需要验证邮箱，如果这是您的操作，请点击<a href="'.$address.'">此链接</a>（如无法点击请复制下方链接打开）</font></div><div><font size="5" color="#ffffff" style="">'.$address.'</font></div><div><font size="5" color="#ffffff" style=""><br></font></div><div><font size="5" color="#ffffff" style="">如果这不是你的操作，请忽略此邮件。</font></div><div><includetail><!--<![endif]--></includetail></div></div>';
$request->setHtmlBody($htmlbody);        
try {
    $response = $client->getAcsResponse($request);
}
catch (ClientException  $e) {
    print_r($e->getErrorCode());   
    print_r($e->getErrorMessage());   
}
catch (ServerException  $e) {        
    print_r($e->getErrorCode());   
    print_r($e->getErrorMessage());
}