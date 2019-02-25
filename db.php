<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "SERVER_NAME";
$username   = "USER_NAME";
$password   = "PASSWORT";
$dbname     = "DB_NAME";
try {
  $mysqli = new mysqli($servername, $username, "${password}", $dbname);
  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  exit('Fehler db');
}