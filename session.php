<?php
	include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"SELECT username FROM users WHERE username = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }

	/* 
	Hash a variable:
	$a = 'SOME_PASSWORD';
	$aHash = password_hash("$a", PASSWORD_DEFAULT);
	echo($aHash);
		// alert in browser
	echo("<script>alert('$aHash');</script>");
	*/


	/*
	Change ownership of opt/lampp/htdocs:
	sudo chown username:group /opt/lampp/htdocs
	E.g: sudo chown leeg:leeg /opt/lampp/htdocs

	Change permissions to R/W/E:
	sudo chmod 700 /opt/lampp/htdocs

	*/
?>