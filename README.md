## TSS WEBSITE OPENSOURCE PROJECT
### ACCOUNT PART
### 使用指南
PHP 5.6+

克隆本库
`git-clone https://github.com/TSStudio/website-account-part.git`
将
`include/server-info.php.default`
的文件名改成
`server-info.php`
编辑此文件
```php
<?php    
    namespace maintask;//******** RCON SETTIONGS ********
    $rpawd=;//rcon密码
    $rhost=;//rcon地址
    $rport=;//rcon端口
    //******** MYSQL SETTIONGS ********
    $dbhost=;//数据库地址
    $dbport=3306;//端口，默认3306
    $dbuser=;//用户名
    $dbpawd=;//密码
    $dbname=;//数据库名
    $dbhost=$dbhost.':'.$dbport;//勿动
```
### PHP7注意
请在每一个用了数据库的页面加上
`include "php7-support.php";`
### 和源站的区别
没有exchange.php,里面有一些东西不能拿出来的