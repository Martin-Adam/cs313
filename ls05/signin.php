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
  Password: <input type="text" name="pass">

</form>
<?php
    $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbname = 'store_db';
    $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
    
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        if(isset($_POST['user']) && isset($_POST['user'])){
        $link = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT * FROM Images;";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        echo '<p align="right" style="color:white;"><a href="signin.php">Sign in</a></p>'
        . '<h1 style="color:white;">Buy your Plushies here!</h1>';
        
        $count = 0;
        echo '<table align="center"><tr>';
        
        }
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
?> 
</body>
</html>
