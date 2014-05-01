<?php
if(isset($_COOKIE['sharehub_phpsession']))
{
	$sessid=$_COOKIE['sharehub_phpsession'];
	$accesscode=$_POST['accesscode'];
	$fileid=$_POST['fileid'];
	$db_username = "root";
	$db_password = "123456";
	$database = "sharehub";
	$server = "127.0.0.1";
	$db_handle = mysql_connect($server, $db_username, $db_password);
	$db_found = mysql_select_db($database, $db_handle);
	if ($db_found) 
	{
		$SQL = "SELECT userid FROM useraccounts WHERE sessionid = '$sessid'";// changed for current user fetched from  session
		$result = mysql_query($SQL);
		$userid=mysql_result($result,0);
		$SQL1 = "SELECT userid FROM userfiles WHERE fileid = '$fileid'";
		$result1 = mysql_query($SQL1);
		$file_userid=mysql_result($result1,0);
		if($userid==$file_userid)
		{
			$SQL2 = "SELECT accesscode FROM userfiles WHERE fileid = '$fileid'";
			$result2 = mysql_query($SQL2);
			$db_accesscode=mysql_result($result2,0);
			if($db_accesscode==$accesscode)
			{
				$SQL2 = "SELECT url FROM userfiles WHERE fileid = '$fileid'";
				$result2 = mysql_query($SQL2);
				$file=mysql_result($result2,0);
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Content-Length: ' . filesize($file));
				readfile($file);
			}
			else
			{
				echo("Incorrect access code. Return to myfiles.php");
			}
		}
		else
		{
		echo("You do not have access permissions to download the file.");
		}
	}
}
else
{
	header("Location:index.php");
}
?>