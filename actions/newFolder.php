<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'lgpm');

$dbConn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s', time());

$newFolderValue = ($_POST[newFolder]);

mysqli_query($dbConn, "INSERT INTO folders (siteName, siteKey, dateCreated) VALUES('$newFolderValue', '{$newFolderValue}_key', '$date')");

header("Location: ../home.php");
?>