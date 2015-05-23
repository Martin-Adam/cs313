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

    $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbname = 'store_db';
    $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
    
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        $link = new PDO($dsn, $username, $password, $options);
        
        $sql = "SELECT * FROM Images;";
        $stmt = $link->prepare($sql);
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        
        $count = 1;
        echo '<table style="width:100%"><tr>';
        foreach($images as $i){
            if ($count == 3){
                $count = 1;
                echo '</tr><tr>';
            }
            else {
                $count++;
            }
            echo '<td><img src="' . $i['image'] . '" alt="' . $i['name'] 
            . '" height="150" width="120"><br>' . $i['name'] . '</td>';
            
        }
        echo '</tr></table>';
        
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
?> 

</body>
</html>
