<?php
function getDB()
{
    $dbProperties = parse_ini_file("pharmeasy.ini");
    $serverName = $dbProperties['ServerName'];
    $userName = $dbProperties['UserName'];
    $password = $dbProperties['Password'];
    $databaseName = $dbProperties['DataBaseName'];
    $dbConnection = new mysqli($serverName, $userName, $password, $databaseName);
    mysqli_set_charset($dbConnection, "utf8");
    //$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $dbConnection;
}

?>