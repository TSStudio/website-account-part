<?php
error_reporting(E_ALL || ~E_NOTICE);
include '../include/server-info.php';
$con=mysqli_connect($dbhost, $dbuser, $dbpawd, $dbname);
$result = $con->query("select ver,pack,packxz,universal,hex(packsha1),hex(packxzsha1) as ver,pack,packxz,universal,packsha1,packxzsha1 from hmcl");
while ($row = mysqli_fetch_array($result)) {
    
}
?>