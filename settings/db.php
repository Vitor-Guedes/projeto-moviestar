<?php

$dbname = 'moviestar';
$dbhost = "mysql";
$dbuser = "root";
$dbpass = "root";

try {
    $connection = new PDO("mysql:dbname=$dbname;host=$dbhost", $dbuser, $dbpass);
    $connection->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (Exception $e) {
    echo 'Error-Connection: ' . $e->getMessage();
}