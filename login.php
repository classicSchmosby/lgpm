<?php
	include("config.php");
   	session_start();
   
		if($_SERVER["REQUEST_METHOD"] == "POST") {	      
	      	// passing username into variable
	      	$myusername = mysqli_real_escape_string($db,$_POST['inputUsername']);
	      	// passing regular password into variable
	      	$mypassword = mysqli_real_escape_string($db,$_POST['inputPassword']); 
	      
	      	$sql = "SELECT userId FROM users WHERE username = '$myusername' and password = '$mypassword'";

	      	// getting userId?????
	      	$userId = mysqli_query($db, "SELECT userId FROM users WHERE username = '$myusername'");
	      	$userIdDisp = mysqli_fetch_assoc($userId);

			date_default_timezone_set('Europe/London');
			$date = date('Y-m-d H:i:s', time());

			$pswd = $_POST[inputPassword][0];

	      	$testQuery = "INSERT INTO auditUserLogin (FK_Username, password, loginDate) VALUES('$_POST[inputUsername]', '$pswd', '$date')";
	      	$testResult = mysqli_query($db, $testQuery);
	      	$testRow = $row = mysqli_fetch_array($testResult,MYSQLI_ASSOC);

	      	$result = mysqli_query($db,$sql);
	      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	      	// $active = $row['active'];
	      
	      	$count = mysqli_num_rows($result);
	      
	      	// If result matched $myusername and $mypassword, table row must be 1 row
			
	      	if($count == 1) {
	         	// session_register("myusername");
	         	$_SESSION['login_user'] = $myusername;
	         	header("location: home.php");
	      	} else {
	      	 	// NEED TO DO SOMETHING WITH THIS.
	         	$error = "Your Login Name or Password is invalid";
	      	}
	   	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- CSS -->
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/passwordManager.css" type="text/css" />
	<!-- JS -->
	<script src="assets/js/bootstrap.js" type="text/javascript"></script>
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<div id="background">
    <div class="container">
    <h1 class="welcome text-center">Welcome to<br />LGPM</h1>
        <div class="card card-container">
        <h2 class='login_title text-center'><i class="glyphicon glyphicon-fire"></i> Login <i class="glyphicon glyphicon-fire"></i></h2>
        <hr>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <h4 class="input_title"><i class="glyphicon glyphicon-user"></i> Username</h4>
                <input type="text" id="inputUsername" name="inputUsername" class="login_box" placeholder="Username" required autofocus>
                <h4 class="input_title"><i class="glyphicon glyphicon-lock"></i> Password</h4>
                <input type="password" id="inputPassword" name="inputPassword" class="login_box" onkeypress="return runLogin(event)" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <a href="resetPassword.html">
                    <label id="userForgot" onclick="userForgot()"><i class="glyphicon glyphicon-cutlery"></i> Forgotten Password?</label>
                    </a>
                </div>
                <button id="userLogin" class="btn btn-lg btn-primary" type="submit" onclick="userLogin()">
                	<i class="glyphicon glyphicon-thumbs-up"></i>Login
                </button>
                <!-- <h2 id="blahhh"><?php echo($error); ?></h2> -->
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</div> <!-- background -->    
</body>
<script type="text/javascript">
	// Login button function.
	function userLogin() {
		// stuff
		var name = document.getElementById('inputUsername').value;
		// alert('Hello, ' + name);
		// window.location.href = "index.html";
	}
	// run searchFolders function on Enter key.
	function runLogin(e) {
		if (e.keyCode == 13) {
			userLogin();
		}
	}
</script>
<script type="text/javascript">
// pick a random image from the array for each time the page is loaded.
	$(function() {
		var images = ['abstractBg1.jpg', 'abstractBg2.jpg', 'abstractBg3.jpg', 'abstractBg4.jpg', 'abstractBg5.jpg'];
		$('#background').css({'background-image': 'url(assets/img/' + images[Math.floor(Math.random() * images.length)] + ')' });
	});
</script>
</html>