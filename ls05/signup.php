<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Results</title>
</head>
<body>
<h1>Sign Up</h1>
<form action="" method="post">
Username: <input type="text" name="user">
<br>
Password:<input type="password" name="pass">
<br>
<input type="submit" value="Submit" name="submit">
</form>

<?php
echo 'bye';
if(isset($_POST['submit'])){
	echo 'hi';
	try{
	echo 'test';
	$server = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbname = 'store_db';
	$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	$db = new PDO($dsn, $username, $password, $options);


	$db->prepare('SELECT User FROM Users WHERE User = "' . $_POST['user']. '";');
	$db->execute();
       	$db->closeCursor();         

	$rows_found = $db->rowCount();
	
	
	$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

	echo $rows_found;
	}
	catch (PDOException $e){
		echo $e;
	}
}
?>
</body>
</html>
