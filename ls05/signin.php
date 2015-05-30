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
	    background-color:rgba(255,255,255,0.3);
	}
        </style>
    </head>
<body> 
<form action="" method="post">
  Username: <input type="text" name="user">
  <br>
  Password: <input type="password" name="pass">
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
        
        $sql = "SELECT User, Pass FROM Users;";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach($users as $u){
         if($_POST['user'] == $u['User'] && $_POST['pass'] == $u['Pass']){
         session_start();
         $_SESSION["userl"] = $u['User'];
                 echo 'Welcome Back ' . $_SESSION["userl"];
         }
         else if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['create'])){
         	$sql = "INSERT INTO `Users`(`User`, `Pass`) VALUES ('.$_POST['user'].','.$_POST['pass'].');";
         	$stmt = $link->prepare($sql);
         	$stmt->execute();
         	$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
         	$stmt->closeCursor();         
         	session_start();
         	$_SESSION["userl"] = $_POST['user'];
                echo 'Welcome Back ' . $_SESSION["userl"];
         }
         else {
         	echo 'Wrong Username or Password';
         }
        }
        }
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
?> 
</body>
</html>
