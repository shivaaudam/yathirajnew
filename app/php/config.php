<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manonethra";
define('PROJECT_ROOT', '../');
//define ('SITE_ROOT', realpath(dirname(__FILE__)));
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
