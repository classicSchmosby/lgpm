<?php
define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'lgpm');

$dbConn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

date_default_timezone_set('Europe/London');
$date = date('Y-m-d H:i:s', time());

// create query to add column on loginCount
mysqli_query($dbConn, "INSERT INTO auditUserLogin (FK_Username, loginDate) VALUES('$_POST[inputUsername]', '$date')");

header("Location: ../home.php");

?>