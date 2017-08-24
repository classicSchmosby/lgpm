<?php
	include('session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Passwords</title>
	<!-- CSS -->
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="assets/css/passwordManager.css" type="text/css" />
	<!-- JS -->
	<script src="assets/js/bootstrap.js" type="text/javascript"></script>
	<script src="assets/js/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<?php
   	//Read your session (if it is set)
	/* // check if session exists
	if (session_status() == PHP_SESSION_NONE) {
		header('location: login.php');
	}
	// check if sessions are disabled by the browser
	if (session_status() == PHP_SESSION_DISABLED) {
		header('location: login.php');
	} */

	// define all valuable variables early on in file - for later use.
	$vers = phpversion();
	$apachePort = 8080;
	$mySqlPort = 3306;
?>

	<div id="header">
		<h3 id="leftHeaderObject" class="headerObjects" title="LG Password Manager">
			PHP version is running: <i style="color:#0F63EE;"> <?php echo($vers); ?> </i>
		<i class="glyphicon glyphicon-wrench"></i></h3>
		<h3 id="middleHeaderObject" class="headerObjects" title="LG Password Manager"><i class="glyphicon glyphicon-lock"></i>&nbsp;LGPM&nbsp;<i class="glyphicon glyphicon-lock"></i></h3>
		<h3 id="rightHeaderObject" class="headerObjects" title="LG Password Manager"><i style="color:#79BDB4" class="glyphicon glyphicon-log-out"></i>
		<a href="logout.php">Logout</a></h3>
	</div>
	<div id="sideNav">

		<form id="newFolderForm" action="actions/newFolder.php" method="post">
			<input id="newFolder" name="newFolder" type="text" placeholder="New Folder" required="required" autocomplete="off" value="" autofocus />
			<button id="createFolder" title="Create Folder! [Enter]">
				<i style="color:#333;" class="glyphicon glyphicon-plus"></i> Create!
			</button>	
		</form>
		<hr />
		<div class="row" style="width:100%;">
		<div class="col-lg-6" style="width:90%;margin-left:20px;">
    		<div class="input-group">
      			<input id="folderSearcher" onkeyup="myFunc()" type="text" class="form-control" placeholder="Search for..." value="" />
    		</div><!-- /input-group -->
 		 </div><!-- /.col-lg-6 -->
 		 </div><!-- row -->
		<!-- <tr>
			<td id="userFolders"> -->
				<?php
					// configure server connection
					$server = "localhost";
					$username = "root"; // default is 'root'?
					$password = ""; // default is '' or 'password'?
					// ensure passwordManager database is located elsewhere to torpedo database.
					$database = "lgpm"; // database name - no default?

					$conn = mysqli_connect($server, $username, $password, $database); // newest connect function.
					// if an error is show.
					if (mysqli_connect_errno() ) {
						// display the following. - problems displaying?
						$noConn = ("Connection to <strong>" . $server . "</strong> failed, due to the following error: <strong>" . mysqli_connect_error() . "</strong>");
					} else {
						// problems display?
						$yesConn = ("Successfully Connected! You're logged into: <strong>" . $server . "</strong>");
					}

					// check if any folders exist from db.
   					$checkResults = mysqli_query($conn, "SELECT COUNT(*) AS total FROM folders");
   					$values = mysqli_fetch_assoc($checkResults);
   					$num_rows = $values['total'];
   					if ($num_rows < 1) {
   						echo("<script type='text/javascript'>");
   							echo(" 
   								document.getElementById('folderSearcher').value='No Results!';
   								document.getElementById('folderSearcher').disabled = true;
   								document.getElementById('searchFolders').disabled = true;
   								");
   						echo("</script>");
   					}

   					// echo("<script>alert('$num_rows');</script>");

					// check server connection with a ping. - PROBLEMATIC?
					if (!mysqli_ping($conn)) {
						echo('Connection has been lost!');
						exit;
					} ?>

					<?php
						$conn = mysqli_connect($server, $username, $password, $database);
						if (isset($_POST['deleteFolder']))
							{
   								$deleteFolder = mysqli_query($conn,
   									"DELETE FROM folders WHERE siteId = '".$_POST['deleteFolder']."'");

   								//header("Location: home.php");
   								header("Location: redirect.php");

   								// avoid: 'confirm form resubmission' error?
   								unset($_POST);
							}
					?>

				<div id="folderTblWrapper">
					<table id="folderTbl">
						<?php
						$results = mysqli_query($conn, "SELECT * FROM folders WHERE (hidden = 0 AND FK_userId = 1) ORDER BY siteName asc");
						while ($row = mysqli_fetch_assoc($results)): ?>
							<tr class="folders">
								<td class="userFolders">

									<span class="userFolderIcon"><i class="glyphicon glyphicon-folder-close"></i>
										<?php echo($row["siteName"] . ' (' . $row["siteId"] . ')') ?>
									</span>

								</td>
								<td class="userFolderBtnWrapper">
									<div class="userFolderBtnHolder">

										<form method="POST" class="userFolderBtn">
											<button name="deleteFolder" class="btn deleteFolder" title="Delete Folder" value="<?= $row['siteId'] ?>"><i class="glyphicon glyphicon-trash"></i></button>
										</form>
										<form method="POST" class="userFolderBtn">
											<button name="openFolder" class="btn openFolder" title="Open Folder" value="<?= $row['siteId'] ?>"><i class="glyphicon glyphicon-enter"></i></button>
										</form>

									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</table>
				</div>
				<?php
					$folderTotal = mysqli_query($conn,
						"SELECT * FROM folders WHERE hidden = 0");
					$folderTotalResult = mysqli_num_rows($folderTotal);
				?>
				<h3 id="folderTotal"><?php echo('Total number of folders: ' . $folderTotalResult); ?></h3>
	</div>
	<div id="mainPageNav">
		<div id="currentDirectoryBox">
			<h3 id="folderName" class="headerObjects2">
				<i class="glyphicon glyphicon-user" style="color:#79BDB4;"></i>
				<?php echo($login_session); ?>
			</h3>
			<br /><br /><p></p>
			<?php 
				$recentLogin = mysqli_query($conn,
					"SELECT loginId, FK_Username, loginDate FROM auditUserLogin WHERE FK_Username = '$login_session' order by loginDate desc LIMIT 1, 1");
				$recentLoginResult = mysqli_fetch_row($recentLogin);
			?>
			<h5 id="currentDirectory">Last logged in:<i>&nbsp;<?php echo($recentLoginResult[2]); ?></i></h5>

			<form method="POST" action="">
				<button id="directoryOptions" name="directoryOptions" type="submit"><i style="color:#79BDB4;" class="glyphicon glyphicon-cog"></i>Test Conn</button>
			</form>

			<?php
				$server = "localhost";
				$username = "root";
				$password = "";
				$database = "lgpm";

				$conn = mysqli_connect($server, $username, $password, $database);
				if (isset($_POST['directoryOptions']))
					{
   						if (!$conn) {
							$noConn = ("Connection to " . $server . " failed, due to the following error: <strong>"
							. mysqli_connect_error() . "</strong>");
							echo("<script>alert('$noConn');</script>");
						} else {
							$yesConn = ("Success! You are now connected to: " . $server);
							echo("<script>alert('$yesConn');</script>");
							unset($_POST);
					}	
					//header("Location: ../home.php");
				}
			?>

			<a href="detailGenerator.html" target="_blank"><h4 id="directoryDownload"><i style="color:#79BDB4;" class="glyphicon glyphicon-briefcase"></i> Generator</h4></a>
			<a href="#"><h4 id="directoryShare"><i style="color:#79BDB4;" class="glyphicon glyphicon-link"></i> Create Link</h4></a>
		</div>
	</div>
	<div id="mainPage">
	<br/><br/><br/><br/><br/><br/>
		<div id="saveAlertSuccess" class="alert alert-info" role="alert">
  			<strong>Your changes have been saved.</strong>
		</div>
		<div id="saveAlertFailure" class="alert alert-danger" role="alert">
  			<strong>There is nothing to save.</strong>
		</div>
		<!-- Big 'ol text box for the username, password etc - may need to create a foreach for every field. -->
		<textarea id="emptyDemo" placeholder="Your details will appear here." value="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?php
			if (isset($_POST['openFolder'])) {
				$openFolder = mysqli_query($conn, "SELECT * FROM folders WHERE siteId = '".$_POST['openFolder']."'");
				while ($disp = mysqli_fetch_assoc($openFolder)):
					echo("Site ID: " . ($disp["siteId"]));
					echo("\r\n");
					echo("Site Name: " . ($disp["siteName"]));
					echo("\r\n");
					echo("Site Key: " . ($disp["siteKey"]));
					echo("\r\n");
					echo("Date Created: " . ($disp["dateCreated"]));
					echo("\r\n");
					echo("Last Modified: " . ($disp["dateModified"]));
				endwhile;
			}
		?></textarea>

		<button id="saveDetails">Save</button>
		<button id="downloadDetails">Download</button>
		<br /><p></p>
		<button id="downloadLink"><i class="glyphicon glyphicon-save"></i> Download</button>
		<br /><br /><br />
	</div>


<script type="text/javascript">
	function refresh() {
		window.location.reload();
	}
	function somethings() {
		var u = document.getElementsByClassName('userFolderIcon').value;
		document.getElementById('emptyDemo').innerHTML = (u);
	}
	function openFolder(elem) {
		alert(elem.id);
	}
	function myFunc() {
		var input = document.getElementById('folderSearcher');
		var filter = input.value.toUpperCase();
		var table = document.getElementById('folderTbl');
		var tr = table.getElementsByTagName('tr');

		for (var i = 0; i < tr.length; i++) {
			var td = tr[i].getElementsByTagName('td')[0];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}
		}
	}
	$(document).ready(function() {
		// clear all input values on page load.
		$('#emptyDemo').value = '';
		$('#newFolder').value = '';
		$('#folderSearcher').value = '';
		// enter NOTHING into inputs
		$('#emptyDemo').innerHTML = '';
		$('#newFolder').innerHTML = '';
		$('fodlerSearcher').innerHTML = '';
	});




/* AJAX - RENAME FOLDER - PROBLEMATIC
function editFolder() {
	var j = prompt("Rename Folder:", "");
	// alert when prompt is filled in.
	alert('sent!');
	$.AJAX({
		type: "POST",
		// send request to this page - default is this page.
		//url: "actions/renameFolder.php",
		data: j,
		success: function() {
			alert('success!');
			//alert(<?php echo($_POST['data']); ?>)
		}
		error: function() {
			alert('failure!');
		}
	});
} */
</script>
</body>
</html>