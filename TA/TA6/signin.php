<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Results</title>
</head>
<body>
<h1>Sign In</h1>
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
		
		$stmt = $db->prepare('SELECT `User_name`, `Password` FROM `user` WHERE `User_name` = :name');
		$stmt->bindParam(':name', $_POST['user']);
		$stmt->execute();
       	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
       	$stmt->closeCursor();
		
		//$_SESSION['user'] = $username;
		//header('Location: homepage.php');	
		
		foreach($user as $u){
			if (password_verify($_POST['pass'], $u['Password'])){
				$_SESSION['user'] = $_POST['user'];
				header('Location: homepage.php');
			}
		}	
				
		
		echo 'Wrong Username or Password';
		
		}
		catch (PDOException $e){
			echo $e;
		}
	}
?>
</body>
</html>
