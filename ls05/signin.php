<!DOCTYPE html>
<html>
    <head>
        <title>Products</title>
        <style>
        body{
			background-image: url(http://i.imgur.com/48wh8Ab.jpg);
			color: black;
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
<form action="" method="post">
  Data can only be 12 characters long:<br>
  Username: <input type="text" name="user" maxlength="12">
  <br>
  Password: <input type="password" name="pass" maxlength="12">
  <br>
  <input type="submit" value="Submit" name="submit">
  <input type="submit" value="Create User" name="create">
  <br>
  <a href="phpDataBase.php">Product Page</a>
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
        
        $sql = "SELECT * FROM Users;";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        $message = "";
        foreach($users as $u){
         if($_POST['user'] == $u['User'] && $_POST['pass'] == $u['Pass']){
         
	         session_start();
         	$_SESSION["userl"] = $u['User'];
         	$_SESSION["userid"] = $u['User_ID'];

         	$message ='<p style="color:white;">Welcome Back ' . $_SESSION["userl"] . '</p>';
         }
         else if($_POST['user'] != $u['User'] && $_POST['pass'] != $u['Pass']) {
         	$message = '<p style="color:white;">Wrong Username or Password</p>';
         }
        }
        echo $message;
        }
        else if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['create'])){
        	$link = new PDO($dsn, $username, $password, $options);
        	
        	$sql = "INSERT INTO `Users`(`User`, `Pass`) VALUES (:name,:pass);";
        	$stmt = $link->prepare($sql);
         	$stmt->bindParam(':name', $_POST['user']);
		$stmt->bindParam(':pass', $_POST['pass']);
         	$stmt->execute();
         	$stmt->closeCursor();         
         	session_start();
         	$_SESSION["userl"] = $_POST['user'];
                echo '<p style="color:white;">Welcome ' . $_SESSION["userl"] . "</p>";
        }
    } catch (Exception $ex) {
        echo '<p style="color:white;">Couldnt connect to Database try again later</p>';
    }
?> 
</body>
</html>
