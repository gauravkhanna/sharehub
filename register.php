<?php
$uname = $_POST['usernm'];
$pword = $_POST['pswd'];
$umail = $_POST['emailid'];
$uname = htmlspecialchars($uname);
$pword = htmlspecialchars($pword);
$umail = htmlspecialchars($umail);
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
if(filter_var($umail, FILTER_VALIDATE_EMAIL)){
}
else {
$errorMessage=$errorMessage." Enter a valid email address";
}

if ($errorMessage == "") {
$db_username = "root";
$db_password = "123456";
$database = "sharehub";
$server = "127.0.0.1";
$db_handle = mysql_connect($server, $db_username, $db_password);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
$SQL = "SELECT * FROM useraccounts WHERE username = '$uname'";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if ($num_rows > 0) {
echo "<h3>Username already taken</h3>";
} 
else {
$pword=sha1($pword);
$SQL = "INSERT INTO useraccounts (username, password, emailid) VALUES ('$uname','$pword', '$umail')";
$result = mysql_query($SQL);
if($result) {
$SQL = "SELECT userid FROM useraccounts WHERE username = '$uname'";
$result = mysql_query($SQL);
$uid= mysql_result($result,0);
mkdir("upload/$uid");
echo "you have successfully registered. Click <a href='index.php'>here</a> to ontinue";
}
else
echo "error: ".mysql_error();
}
}
mysql_close($db_handle);
}
else {
echo "<h3>".$errorMessage."</h3>";
}
?>