<?php	
if(isset($_COOKIE['sharehub_phpsession']))
{
	$sessid=$_COOKIE['sharehub_phpsession'];
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
			$SQL2 = "SELECT storagetype FROM userfiles WHERE fileid = '$fileid'";
			$result2 = mysql_query($SQL2);
			$pType=mysql_result($result2,0);
			if($pType==0)
			{
				$accesscode=rand(10000,99999);
				//echo($accesscode);
				$SQL3 = "SELECT emailid FROM useraccounts WHERE userid = '$userid'";
				$result3 = mysql_query($SQL3);
				$email=mysql_result($result3,0);
				$SQL4="SELECT filename FROM userfiles where fileid='$fileid'";
				$result4=mysql_query($SQL4);
				$filename=mysql_result($result4,0);
				//update access code to db
				$SQL5="UPDATE userfiles SET accesscode='$accesscode' WHERE fileid='$fileid'";
				$result5=mysql_query($SQL5);
				mail($email,'Access code for $filename from sharehub','Access code: $accesscode.\n\n You have received this mail because somenone has requested access to $filename.Please delete this mail as soon as you are able to access this file',"From: noreply@sharehub.com\n");
				echo("<form method='POST' action='downloader.php'>");
				echo("<table>");
				echo("<tr><td>An access code has been sent to our registered email address</td></tr>");
				echo("<tr><td>Enter access code</td><td><input type='text' name='accesscode'></td></tr>");
				echo("<tr><td><input type='hidden' name='fileid' value='$fileid'></td></tr>");
				echo("<tr><td><input type='submit' value='Download file'></td></tr>");
				echo("</table></form>");
			}
			else
			{
				$SQL5 = "SELECT url FROM userfiles WHERE fileid = '$fileid'";
				$result5 = mysql_query($SQL5);
				$file=mysql_result($result5,0);
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Content-Length: ' . filesize($file));
				readfile($file);
			}
		}
		else
		{
			echo("You do not have access rights to open this file");
		}
	}
	mysql_close($db_handle);
}
else
{
header('Location: index.php');
}
?>