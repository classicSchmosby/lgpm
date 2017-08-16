<?php
/* SALT ALL PASSWORDS (PHP):
// hash(60) a password string.
echo(password_hash('SOME_PASSWORD_VALUE', PASSWORD_DEFAULT));

// verify what a hash says, with given guesses.
$hash = 'SOMELARGESTRING_HERE';
$attempt = 'SOMEGUESS';
if (password_verify($attempt, $hash)) {
	echo('Found! The password is: ' . $attempt);
} else {
	echo('Invalid password!');
} */
$testingVar = $_POST['testing'];
?>



<!DOCTYPE html>
<html>
<head>
	<title>Test Hash</title>
</head>
<body>
<form method="post" action="testHash.php">
	<input type="text" id="testing" name="testing" placeholder="type here" />
	<input name="submit" type="submit" value="Submit" />
</form>

<h2>
	<?php 
		echo($testingVar);
		$testingVarEnc = (password_hash('$testingVar', PASSWORD_DEFAULT));
	?>
</h2>
<br />
<h2><?php echo ($testingVarEnc); ?></h2>

</body>
</html>