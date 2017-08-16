<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'lgpm');

$dbConn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

$id = $_GET['id'];
mysqli_query($dbConn, "DELETE FROM folders WHERE id='$id'");

header("Location: ../home.php");
?>