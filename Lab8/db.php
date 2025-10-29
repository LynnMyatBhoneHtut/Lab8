<?php

$host = 'localhost';
$user = 'root';   
$pass = '';       
$name = 'lab_profile_db';

$mysqli = new mysqli($host, $user, $pass, $name);
if ($mysqli->connect_errno) {
  die('DB connection failed: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
