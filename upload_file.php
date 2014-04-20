<?php
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
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    if (file_exists("upload/$userid" . $_FILES["file"]["name"]))
		{
		echo $_FILES["file"]["name"] . " already exists. ";
		}
    else
		{
		move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
		echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		echo "Protection mode: ".$prot;
		$filename=$_FILES["file"]["name"];
		echo $filename;
		echo pathinfo($filename,PATHINFO_FILENAME);
		//database access
		$db_username = "root";
		$db_password = "123456";
		$database = "sharehub";
		$server = "127.0.0.1";
		$db_handle = mysql_connect($server, $db_username, $db_password);	  
		$db_found = mysql_select_db($database, $db_handle);
		if ($db_found) 
			{
			$date=date('Y-m-d H:i:s');
			$SQL = "INSERT INTO userfiles (userid, filename, logid,createddate,updatedate) VALUES ('1','$filename','1','$date','$date')";
			$result = mysql_query($SQL);
			if($result)
				echo "you have successfully uploaded. Click <a href='upload.html'>here</a> to ontinue";
			else
				echo "error: ".mysql_error();
			mysql_close($db_handle);
			}
		}
	}
 }
else
  {
  echo "Invalid file";
  }
?>