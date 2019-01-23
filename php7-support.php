<?php
namespace maintask;
// *************** PHP7 START ***************
if(!function_exists('mysql_connect')){
    $mysqli = mysqli_connect("$dbhost:$dbport", $dbuser, $dbpass, $dbname);
    function mysql_pconnect($dbhost, $dbuser, $dbpass){
        global $dbport;
        global $dbname;
        global $mysqli;
        $mysqli = mysqli_connect("$dbhost:$dbport", $dbuser, $dbpass, $dbname);
        return $mysqli;
        }
    function mysql_select_db($dbname){
        global $mysqli;
        return mysqli_select_db($mysqli,$dbname);
        }
    function mysql_fetch_array($result){
        return mysqli_fetch_array($result);
        }
    function mysql_fetch_assoc($result){
        return mysqli_fetch_assoc($result);
        }
    function mysql_fetch_row($result){
        return mysqli_fetch_row($result);
        }
    function mysql_query($query){
        global $mysqli;
        return mysqli_query($mysqli,$query);
        }
    function mysql_escape_string($data){
        global $mysqli;
        return mysqli_real_escape_string($mysqli, $data);
        //return addslashes(trim($data));
        }
    function mysql_real_escape_string($data){
        return mysql_real_escape_string($data);
        }
    function mysql_close(){
        global $mysqli;
        return mysqli_close($mysqli);
        }
}
?>