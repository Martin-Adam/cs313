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
	try{
  $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
  $dbname = 'store_db';
  $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
  $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
  $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
  $db = new PDO($dsn, $username, $password, $options);

	$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

	$query = $db->query("SELECT Users WHERE User = '$_POST['user']'");

  if($query)
  {
    echo 'it exists';
  }
	else{
	  echo 'it doesn't exist';
	}
	
	
	//$stmt = $db->prepare('INSERT INTO `user`(`User_name`, `Password`) VALUES (:name,:pass)');
	//$stmt->bindParam(':name', $_POST['user']);
  //$stmt->bindParam(':pass', $pass);
	//$stmt->execute();
		
	//header('Location: signin.php');
	}
	catch (PDOException $e){
		echo $e;
	}
?>
</body>
</html>
