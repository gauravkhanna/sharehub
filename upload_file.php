<?php
if(isset($_COOKIE['sharehub_phpsession']))	{
$prot=$_POST["protected"];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
	//database access
	$db_username = "root";
	$db_password = "123456";
	$database = "sharehub";
	$server = "127.0.0.1";
	$db_handle = mysql_connect($server, $db_username, $db_password);	  
	$db_found = mysql_select_db($database, $db_handle);
	$userid=0;
	if ($db_found) 
		{
		$filename=$_FILES["file"]["name"];
		$fname=pathinfo($filename,PATHINFO_FILENAME);
		$ftype=pathinfo($filename,PATHINFO_EXTENSION);
		$sessid=$_COOKIE['sharehub_phpsession'];
		$SQL = "SELECT userid FROM useraccounts WHERE sessionid = '$sessid'";// changed for current user fetched from  session
		$result = mysql_query($SQL);
		$userid=mysql_result($result,0);
		$date=date('Y-m-d H:i:s');
		$protType=$_POST['protected'];
		$SQL = "INSERT INTO userfiles (userid, filename,filetype,storagetype,logid,createddate,updatedate) VALUES ('$userid','$fname','$ftype','$protType','1','$date','$date')";
		$result = mysql_query($SQL);
		if($result) {
			//echo "you have successfully uploaded. Click <a href='upload.html'>here</a> to continue";
			if (file_exists("upload/$userid/" . $_FILES["file"]["name"])) {
				echo $_FILES["file"]["name"] . " already exists. ";
				}
			else {
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/$userid/" . $_FILES["file"]["name"]);
				//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				//echo "Type: " . $_FILES["file"]["type"] . "<br>";
				//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
				//echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
				//echo "Protection mode: ".$prot;
				//
				//echo $filename;
				//echo pathinfo($filename,PATHINFO_FILENAME);
				}
			}
		else
			echo "error: ".mysql_error();
		mysql_close($db_handle);
		header('Location: myfiles.php');
		}
	}
 }
else
  {
  echo "Invalid file";
  }
 }
 
 else
 {
 header("Location: index.php");
 }
?>