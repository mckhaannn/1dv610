<?php
$dbServername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbname = 'logindatabase';
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 