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
	try {
	$server = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbname = 'store_db';
	$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
	
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
        $link = new PDO($dsn, $username, $password, $options);

	$sql = 'SELECT User FROM Users WHERE User = "'.$_POST['user'].'"';
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

	foreach($users as $u){
		echo 'hello world';
	}
	}
	catch (PDOException $e){
		echo $e;
	}
}
?>
</body>
</html>
