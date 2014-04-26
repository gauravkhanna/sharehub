<?php
$db_username = "root";
$db_password = "123456";
$database = "sharehub";
$server = "127.0.0.1";
$db_handle = mysql_connect($server, $db_username, $db_password);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
$sessid=$_COOKIE['sharehub_phpsession'];
$SQL = "UPDATE useraccounts SET sessionid='0' WHERE sessionid='$sessid'";
$result = mysql_query($SQL);
mysql_close($db_handle);
setcookie ('sharehub_phpsession', '', time() - 4800);
session_destroy();
}
header("Location: index.php");
?>
