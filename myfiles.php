<?php
// show files list
$db_username = "root";
$db_password = "123456";
$database = "sharehub";
$server = "127.0.0.1";
$db_handle = mysql_connect($server, $db_username, $db_password);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) {
$SQL = "SELECT * FROM userfiles WHERE userid = '1'";// chnge for current user fetched from  session
$result = mysql_query($SQL);
$num_rows = mysql_num_rows($result);
echo("<a href=\"logout.php\">Sign out</a>");
if($num_rows>0) {
echo("You can upload one by clicking <a href=\"upload.html\">here</a><br/>");
echo("<table width=\"1000\"><th>Filename</th><th>Extension</th><th>Upload date</th><th>Last updated</th><th>Protection</th><th>Check log</th>");
while($tuple=mysql_fetch_object($result)) {
//echo var_dump($tuple);
echo("<tr>");
echo("<td>$tuple->filename</td>");
echo("<td>$tuple->filetype</td>");
echo("<td>$tuple->createddate</td>");
echo("<td>$tuple->updatedate</td>");
echo("<td>$tuple->storagetype</td>");
echo("<td><a href=\"log.php\">Log</a></td>");
echo("</tr>");
}
echo("</table>");
}
else{
echo("You have not uploaded any files");
echo("You can upload one by clicking <a href=\"upload.html\">here</a>");
}
}
?>