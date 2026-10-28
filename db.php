<?php
  $host = "DATABASERVERT";
  $username = "DATABASEBRUKER";
  $password = "DATABASEPASSORD";
  $database = "DATABASENAVN";

  $db = mysqli_connect($host, $username, $password, $database);

  if (!$db) {
    die("Kunne ikke koble til databasen");
  }

  mysqli_set_charset($db, utf8mb4);
?>


