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

	$sql = 'SELECT User FROM Users';
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
	
	$message = "";
	foreach($users as $u){
		if($u['user'] == $_POST['user'])
		{
			$message = 'Username is taken.';
		}
	}
	
	if($message == ""){
		$sql = "INSERT INTO `Users`(`User`, `Pass`) VALUES (:name,:pass);";
        	$stmt = $link->prepare($sql);
         	$stmt->bindParam(':name', $_POST['user']);
		$stmt->bindParam(':pass', $_POST['pass']);
         	$stmt->execute();
         	$stmt->closeCursor();
        	
		header('Location: signin.php');
	}
	
	}
	catch (PDOException $e){
		echo $e;
	}
}
?>
</body>
</html>
