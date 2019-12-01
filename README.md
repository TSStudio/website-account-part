## TSS WEBSITE OPENSOURCE PROJECT
### ACCOUNT PART
### 使用指南
PHP 5.6+,mysql数据库  
你需要注意的是，这个库的，给第三方使用的东西，比如sql都很长时间没有更新了，直接套用代码绝壁报错。所以并不推荐第三方使用。如果你一定要用的话，自己改一下或者找我。
#### 克隆本库

`git-clone https://github.com/TSStudio/website-account-part.git`
#### 修改配置文件
将

`include/server-info.php.default`

的文件名改成

`server-info.php`

编辑此文件
```php
<?php    
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
#### 导入SQL表
直接导入user.sql (表名为user)

### PHP7注意
~~请在每一个用了数据库的页面加上~~
~~`include "php7-support.php";`~~
已经完美支持PHP7(PHP5.6以上都可使用PHP7版本，分支只是我测试用的版本)
### 和源站的区别
没有exchange.php,内容保密
### 欢迎提交BUG 请到issues页面