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
	tr {
	    background-color:rgba(255,255,255,0.3);
	}
	h1 {
		color:white;
	}
	/* unvisited link */
	a:link {
    		color: white;
	}
	/* visited link */
	a:visited {
    		color: blue;
	}
	/* mouse over link */
	a:hover {
    		color: red;
	}
	/* selected link */
	a:active {
    		color: green;
	}
	a{
		padding: 10px;
	}

        </style>
    </head>
<body> 

<?php
    session_start();

    $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbname = 'store_db';
    $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
    
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        $link = new PDO($dsn, $username, $password, $options);
        if(isset($_SESSION["user"])){
        	$sql = "SELECT i.images_id, name, image FROM Images i "
		."INNER JOIN Bought_items b "
		."ON i.images_id = b.images_id "
		."WHERE b.User_ID = ".$_SESSION['userid']." "
		."AND b.bought != 1;";
        	$stmt = $link->prepare($sql);
        	$stmt->bindParam(':id', $_SESSION["userid"]);
        	$stmt->execute();
        	$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        	$stmt->closeCursor();
        	

        	echo '<p align="right" style="color:white;">Hello, '.$_SESSION['user']
        	. '<br><form action="" method="post" align="right">'
        	. '<input type="submit" value="Logout" name="logout" align="right"></form>'
        	. '<br><form action="" method="post" align="right">'
        	. '<input type="submit" value="Reset Items" name="reset" align="right"></form></p>';
        }
        else {
        	$sql = "SELECT * FROM Images;";
        	$stmt = $link->prepare($sql);
        	$stmt->execute();
        	$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        	$stmt->closeCursor();
        	echo '<p align="right" style="color:white;"><a href="signin.php">Sign in</a>'
        	.'<br><a href="signup.php">Sign up</a></p>';
        }
        echo '<h1 style="color:white;">Buy your Plushies here!</h1>';
        
        $count = 0;
        echo '<form action="" method="post"><table align="center"><tr>';
        foreach($images as $i){
            if ($count == 3){
                $count = 0;
                echo '</tr><tr>';
            }
            else {
                $count++;
            }
            echo '<td><img src="' . $i['image'] . '" alt="' . $i['name'] 
            . '" height="150" width="120"><br>' . $i['name'] 
            . '<input type="checkbox" name="pokemon[]" value="'.$i['images_id'].'"></td>';
        }
        echo '</tr><tr><td><input type="submit" name="submit" value="Buy Now"></td></tr></table></form>';
        if(isset($_POST["submit"]) && isset($_SESSION["user"])){
        $pokemon = $_POST['pokemon']; 
        if(!empty($pokemon)){
		$n = count($pokemon);
        	for($i=0; $i < $n; $i++)
        	{
        		$sql = "UPDATE `Bought_items` SET `bought`=1 "
        		."WHERE `User_ID`= ".$_SESSION["userid"]." AND `images_id` = ".$pokemon[$i].";";
	        	$stmt = $link->prepare($sql);
        		$stmt->execute();
        	       	$stmt->closeCursor();
        		
			header('Location: phpDataBase.php');

        	}
        }	
        
        }
        else if (isset($_POST["submit"])){
        	echo '<p style="color:white;">Items will arrive close to never.</p>';
        }
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
    
    if (isset($_POST["logout"])){
    	// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	header('Location: phpDataBase.php');
    }
    if (isset($_POST["reset"])){
    	$sql = "UPDATE `Bought_items` SET `bought`=0 WHERE `User_ID`= " . $_SESSION['userid'];
	$stmt = $link->prepare($sql);
        $stmt->execute();
        $stmt->closeCursor();
    	header('Location: phpDataBase.php');
    }
?>
</body>
</html>
