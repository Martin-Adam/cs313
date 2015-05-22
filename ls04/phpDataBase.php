<!DOCTYPE html>
<html>
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
        
        $sql = "SELECT * FROM Users;";
        $stmt = $link->prepare($sql);
        foreach ($link->query($sql) as $row) {
        print $row;
        }
        $stmt->execute();
        $rows = $stmt->rowCount();
        $stmt->closeCursor();
        echo $rows;
        
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
?> 

</body>
</html>
