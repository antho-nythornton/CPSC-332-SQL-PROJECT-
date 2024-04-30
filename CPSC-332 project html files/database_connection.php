<?php

$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "university_registry";

$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

if($conn->connect_error)
{
    echo "Connection Failed: " . $conn->connect_error;
    die();
}
?>