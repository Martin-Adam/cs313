<!DOCTYPE html>
<html>
    <head>
        <title>Sign In</title>
        <style>
        body{
			background-image: url(http://i.imgur.com/48wh8Ab.jpg);
			color: white;
			no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
			text-align: center;
		}
	form {
	    background-color:rgba(255,255,255,0.2);
	}
        </style>
    </head>
<body> 
<?php
session_start();
?>
<form action="" method="post">
  <a href="phpDataBase.php">Product Page</a>
  <a href="signup.php">Sign Up</a>
  <br>
  Data can only be 12 characters long:<br>
  Username: <input type="text" name="user" maxlength="12">
  <br>
  Password: <input type="password" name="pass" maxlength="12">
  <br>
  <input type="submit" value="Submit" name="submit">
  <br>
</form>
<?php
    $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbname = 'store_db';
    $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
    
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['submit'])){
        $link = new PDO($dsn, $username, $password, $options);
        
	$stmt = $db->prepare('SELECT `User`, `Pass` FROM `Users` WHERE `User` = :name');
	$stmt->bindParam(':name', $_POST['user']);
	$stmt->execute();
       	$user = $stmt->fetchAll(PDO::FETCH_ASSOC);
       	$stmt->closeCursor();
	
	
	foreach($user as $u){
		require 'password.php';
		if (password_verify($_POST['pass'], $u['Password'])){
			$_SESSION['user'] = $_POST['user'];
			$_SESSION["userid"] = $u['User_ID'];
			$_SESSION["num"] = 1;
			header('Location: phpDataBase.php');
		}
		else {
			echo 'Wrong Username or Password';
		}
	}	
        }
        else {
        	echo 'Please enter a valid username and password';
        }
        
    } catch (Exception $ex) {
        echo '<p style="color:white;">Couldnt connect to Database try again later</p>';
    }
?>
</body>
</html>
