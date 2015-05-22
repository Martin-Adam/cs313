<!DOCTYPE html>
<html>
<body>

<?php

    $llama = getenv('OPENSHIFT_APP_NAME');
    echo "app name: $llama ::: "; 
    
    //$server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $server = getenv('OPENSHIFT_MYSQL_DB_HOST');
    echo "Server: $server ";
    $dbname = 'store_db';
    $username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
    
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    
    try {
        $link = new PDO($dsn, $username, $password, $options);
        $statement = $link->query('SELECT * FROM Users');
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo $results;
    } catch (Exception $ex) {
        echo "Fail".$ex;
    }
?> 

</body>
</html>
