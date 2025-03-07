<?php
$BD_server = 'localhost';
$DB_username = 'root';
$BD_password = '';
$DB_name = 'myanime_db';

$conn = mysqli_connect($BD_server, $DB_username, $BD_password, $DB_name);

if (!$conn) {
  die("Failed to connect to MySQL: " . mysqli_connect_error());
};
