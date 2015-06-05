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
        	$sql = 'SELECT Images.* '
        	.'FROM Images '
        	. 'INNER JOIN Bought_items '
        	. 'INNER JOIN Users ON Users.User_ID = Bought_items.User_ID '
        	. 'WHERE  Bought_items.images_id != Images.images_id AND Bought_items.User_ID = :id;';
        	$stmt = $link->prepare($sql);
        	$stmt->bindParam(':id', $_SESSION["userid"]);
        	$stmt->execute();
        	$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        	$stmt->closeCursor();

        	echo '<p align="right" style="color:white;">Hello, '.$_SESSION['userl']
        	. '<br><button type="button" onclick="logout()">Logout</button></p>';
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
        if(isset($_POST["submit"]) && isset($_SESSION["userl"])){
        $pokemon = $_POST['pokemon']; 
        if(!empty($pokemon)){
		$n = count($pokemon);
        	for($i=0; $i < $n; $i++)
        	{
        		$sql = "INSERT INTO `Bought_items`(`images_id`, `User_ID`, `Price`) VALUES (:pid,:id);";
	        	$stmt = $link->prepare($sql);
	        	$stmt->bindParam(':pid', $pokemon[$i]);
	        	$stmt->bindParam(':id', $_SESSION["userid"]);
        		$stmt->execute();
        	       	$stmt->closeCursor();

        		echo($pokemon[$i] . " ");
        	}
        }	
        
        }
        else if (isset($_POST["submit"])){
        	echo '<p style="color:white;">Items will arrive close to never.</p>';
        }
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
?> 
<script>
function logout(){
	alert('hi');
	<?php
	session_unset();
	session_destroy();
	?>
	location.reload();
	}
</script>
</body>
</html>
