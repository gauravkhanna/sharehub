<?php
if(isset($_COOKIE['sharehub_phpsession'])) {
$logid=$_POST['logid'];
$db_username = "root";
$db_password = "123456";
$database = "sharehub";
$server = "127.0.0.1";
$db_handle = mysql_connect($server, $db_username, $db_password);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
$SQL1="SELECT filename FROM userfiles WHERE logid='$logid'";
$result1=mysql_query($SQL1);
$fname=mysql_result($result1,0);
echo("The log file for $fname is:\n");
$SQL = "SELECT * FROM logfiles WHERE logid = '$logid' ORDER BY updatedate DESC";
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
if($num_rows>0)	{
echo("<table width=\"1000\"><th>Author</th><th>Edit date</th><th>Description</th>");
while($tuple=mysql_fetch_object($result)) {
//echo var_dump($tuple);
echo("<tr>");
$SQL3="SELECT username FROM useraccounts WHERE userid='$tuple->userid'";
$result3=mysql_query($SQL3);
$author=mysql_result($result3,0);
echo("<td>$author</td>");
echo("<td>$tuple->updatedate</td>");
echo("<td>$tuple->description</td>");
echo("</tr>");
}
echo("</table>");
}
}
}
else {
header("Location: index.php");
}
?>