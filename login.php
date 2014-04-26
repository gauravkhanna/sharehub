<?php
session_start();
$uname = $_POST['usernm'];
$pword = $_POST['pswd'];
$uLength = strlen($uname);
$pLength = strlen($pword);
$errorMessage = "";
if ($uLength >= 8 && $uLength <= 20) {
}
else {
$errorMessage = $errorMessage . "Username must be between 8 and 20 characters" . "<BR>";
}
if ($pLength >= 8 && $pLength <= 16) {
}
else {
$errorMessage = $errorMessage . "Password must be between 8 and 16 characters" . "<BR>";
}
if ($errorMessage == "") {
$db_username = "root";
$db_password = "123456";
$database = "sharehub";
$server = "127.0.0.1";
$db_handle = mysql_connect($server, $db_username, $db_password);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
$SQL = "SELECT password FROM useraccounts WHERE username = '$uname'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if($num_rows>0) {
$db_value = mysql_result($result,0);
$pword = sha1($pword);
if(strcmp($pword,$db_value)){
echo "<h3>incorrect password</h3>";
}
else {
//echo "<h3>logged in</h3>";
//move to home page
$sessid=session_regenerate_id();//create session
$_SESSION['sessionid']=$sessid;
$SQL = "UPDATE useraccounts SET 'sessionid'='$sessid' WHERE username='$uname'";
$result = mysql_query($SQL);
//echo $sessid;
header("Location: myfiles.php");
}
}
else {
echo "<h3>Incorrect username. No such username registered</h3>";
}
}
mysql_close($db_handle);
}
else {
echo "<h3>$errorMessage</h3>";
}
?>
