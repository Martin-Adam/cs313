<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Results</title>
</head>
<body>
<?php
if (isset($_SESSION["user"])){
	echo '<h1>Welcome ' .$_SESSION["user"] . '</h1>';
}
else {
	header('Location: signin.php');
}

?>
</p>
</body>
</html>
