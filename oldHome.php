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
		<h2 id="sideNavTitle">Your Folders - <button onclick="refresh()">Refresh</button></h2>

		<form id="newFolderForm" action="actions/newFolder.php" method="post">
			<input id="newFolder" name="newFolder" type="text" placeholder="New Folder" style="margin-left:10px;" required="required" autocomplete="off" />
			<button id="createFolder">
				<i style="color:#79BDB4" class="glyphicon glyphicon-plus"></i> Create!
			</button>	
		</form>
		<hr />
		<div class="row" style="width:100%;">
		<div class="col-lg-6" style="width:90%;margin-left:20px;">
    		<div class="input-group">
      			<input id="folderSearcher" onkeypress="searcher()" type="text" class="form-control" placeholder="Search for..." />
      			<span class="input-group-btn">
        			<button type="button" id="searchFolders" title="Search! [enter]" onclick="searchBar()">Search!</button>
      			</span>
    		</div><!-- /input-group -->
 		 </div><!-- /.col-lg-6 -->
 		 </div><!-- row -->
		<table id="folderTbl">
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

					// check server connection with a ping.
					if (!mysqli_ping($conn)) {
						echo('Connection has been lost!');
						exit;
					} ?>

					<?php
						$conn = mysqli_connect($server, $username, $password, $database);
						if (isset($_POST['deleteFolder']))
							{
   								// $testing = mysqli_query($conn, "DELETE FROM folders WHERE siteId = '".$row['siteId']."'");
   								$tester = mysqli_query($conn, "DELETE FROM folders WHERE siteId = '".$_POST['deleteFolder']."'");
							}
						/* if (isset($_POST['openFolder']))
							{

							} */

					$results = mysqli_query($conn, "SELECT * FROM folders WHERE hidden = 0 ORDER BY siteName asc");
					while ($row = mysqli_fetch_assoc($results)): ?>
							<tr class="folders">
								<td class="userFolders">
									<span class="userFolderIcon"><i class="glyphicon glyphicon-folder-close"></i>
										<?php echo($row["siteName"] . ' (' . $row["siteId"] . ')') ?>
									</span>
									
									<form method="POST">
										<button name="deleteFolder" class="btn deleteFolder" title="Delete Folder" value="<?= $row['siteId'] ?>"><i class="glyphicon glyphicon-trash"></i></button>
									</form>

									<form method="POST">
										<button name="openFolder" class="btn openFolder" title="Open Folder" valu="<?= $row['siteId'] ?>"><i class="glyphicon glyphicon-log-in"></i></button>
									</form>

								</td>
							</tr>
					<?php endwhile; ?>
					
		</table>
	</div>
	<div id="mainPageNav">
		<div id="currentDirectoryBox">
			<h3 id="folderName" class="headerObjects2">
				<?php echo($login_session); ?>
			</h3>
			<br /><br /><p></p>
			<h5 id="currentDirectory"><a href="#">Home&nbsp;</a>&nbsp;/&nbsp;</h5>

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
		<!-- <h2 id="emptyDemo" style="text-align:center;"></h2> -->
		<div id="saveAlertSuccess" class="alert alert-info" role="alert">
  			<strong>Your changes have been saved.</strong>
		</div>
		<div id="saveAlertFailure" class="alert alert-danger" role="alert">
  			<strong>There is nothing to save.</strong>
		</div>
		<!-- Big 'ol text box for the username, password etc - may need to create a foreach for every field. -->
		<textarea id="emptyDemo" placeholder="Your details will appear here." value=""></textarea>
		<button id="saveDetails">Save</button>
		<button id="downloadDetails">Download</button>
		<br /><p></p>
		<button id="downloadLink"><i class="glyphicon glyphicon-save"></i> Download</button>
		<br /><br /><br />
		<h1 id="demooo" style="z-index:4300;color:#000;opacity:1;"></h1>
	</div>


<script type="text/javascript">
	function refresh() {
		window.location.reload();
	}
	/* function searchFolders() {
		var j = document.getElementById('folderSearcher').value;
		// any folder not containing j will be hidden.
		$("tr:not(:contains(" + j + "))").css("display", "none");
		// any folder containing j will be shown.
		$("tr:contains(" + j +  ")" ).css( "display", "inline" );
		// if j is empty, show everything.
		if (j = '') {
			$('tr').css("display", "inline");
		}
	} */
	function searchBar() {
		var j = document.getElementById('folderSearcher').value;
		if (j = '') {
			$('tr').css("display", "inline");
		}
	}
	$(document).keypress(function() {
		var b = document.getElementById('folderSearcher').value;
		// any folder not containing j will be hidden.
		$("tr:not(:contains(" + b + "))").css("display", "none");
		// any folder containing j will be shown.
		$("tr:contains(" + b +  ")" ).css( "display", "inline" );
		// if j is empty, show everything.
		if (b = '') {
			$('tr').css("display", "inline");
		}
	});
	function somethings() {
		var u = document.getElementsByClassName('userFolderIcon').value;
		document.getElementById('emptyDemo').innerHTML = (u);
	}
	function openFolder(elem) {
		alert(elem.id);
	}

/* PROBLEMATIC
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