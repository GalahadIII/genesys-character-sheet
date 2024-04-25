<?php
function createPDO(): PDO {
    $host = "localhost";
    $dbName = "genesys";
    $user = "root";
    $passwd = "";
    $charset = "utf8";
    return new PDO("mysql:host=$host;dbname=$dbName;$charset", $user, $passwd);
}
