<?php   
function getDB() {
    $hostname = 'prophet.njit.edu';
    $username = 'lm457';
    $password = '@Xim3Fcoat7!';
    $service_name = 'course';
    $port = '1521';

    $dsn = "oci:dbname=(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$hostname)(PORT=$port))(CONNECT_DATA=(SID=$service_name)))";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    
    } catch (PDOException $e) {

        die("Connection failed: " . $e->getMessage());
    }
}