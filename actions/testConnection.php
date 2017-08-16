<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "lgpm";

	$conn = mysqli_connect($server, $username, $password, $database);
	if (isset($_POST['directoryOptions']))
		{
   			if (!$conn) {
				$noConn = ("Connection to <strong>" . $server . "</strong> failed, due to the following error: <strong>"
				. mysqli_connect_error() . "</strong>");
				echo("<script>alert('$noConn');</script>");
			} else {
				$yesConn = ("Success! You are now connected to: <strong>" . $server . "</strong>");
				echo("<script>alert('$yesConn');</script>");
			}	
			header("Location: ../home.php");
		}
?>