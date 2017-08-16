<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'lgpm');

$dbConn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

mysqli_query($dbConn, "SELECT siteName FROM folders WHERE hidden = 0 ORDER BY siteName asc LIMIT 10");

header("Location: ../home.php");
?>