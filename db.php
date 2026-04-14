<?php
$host = "database-1.c1iuso6mu7tt.ap-south-1.rds.amazonaws.com";
$user = "devops";
$password = "DevOps@123";
$dbname = "testdb";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>