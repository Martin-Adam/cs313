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
	if(isset($_POST['submit'])){
	try{
    $username = 'Hello';
    $password = 'Hello2';
	$db = new PDO("mysql:host=127.0.0.1;dbname=hashing",$username, $password);
	
	$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
	
	$stmt = $db->prepare('INSERT INTO `user`(`User_name`, `Password`) VALUES (:name,:pass)');
	$stmt->bindParam(':name', $_POST['user']);
   	$stmt->bindParam(':pass', $pass);
	$stmt->execute();
		
	header('Location: signin.php');
	}
	catch (PDOException $e){
		echo $e;
	}
	
	}
?>
</body>
</html>
