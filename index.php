<?php
if(!isset($_COOKIE['sharehub_phpsession']))
{
echo"<html>";
echo"<head>";
echo"<title>Sharehub-Save your files here</title>";
echo"</head>";
echo"<body bgcolor=\"#eeeeee\">";
echo"<h2 align=\"center\">Sharehub</h2>";
echo"<p>Are you new to this site?</p>";
echo"<p>Please register here first</p>";
echo"<form action=\"register.php\" method=\"post\">";
	echo"<table>";
		echo"<tr>";
			echo"<td>";
				echo"User Name(8-20 alphanumeric characters):";
			echo"</td>";
			echo"<td>";
				echo"<input type=\"text\" name=\"usernm\" value=\"\">";
			echo"</td>";
		echo"</tr>";
		echo"<tr>";
			echo"<td>";
				echo"Email ID:";
			echo"</td>";
			echo"<td>";
				echo"<input type=\"text\" name=\"emailid\" value=\"\">";
			echo"</td>";
		echo"</tr>";
		echo"<tr>";
			echo"<td>";
				echo"Password(8-16 alphanumeric characters):";
			echo"</td>";
			echo"<td>";
				echo"<input type=\"password\" name=\"pswd\" value=\"\">";
			echo"</td>";
		echo"</tr>";
	echo"</table>";
echo"<input type=\"submit\" value=\"Register\">";
echo"</form>";

echo"</br></br></br>";

echo"<p>Already registered?</p>";
echo"<form action=\"login.php\" method=\"post\">";
	echo"<table>";
		echo"<tr>";
			echo"<td>";
				echo"User Name:";
			echo"</td>";
			echo"<td>";
				echo"<input type=\"text\" name=\"usernm\" value=\"\">";
			echo"</td>";
		echo"</tr>";
		echo"<tr>";
			echo"<td>";
				echo"Password:";
			echo"</td>";
			echo"<td>";
				echo"<input type=\"password\" name=\"pswd\" value=\"\">";
			echo"</td>";
		echo"</tr>";
	echo"</table>";
echo"<input type=\"submit\" value=\"Login\">";
echo"</form>";
echo"</body>";
echo"</html>";
}
else
{
header("Location: myfiles.php");
}
?>