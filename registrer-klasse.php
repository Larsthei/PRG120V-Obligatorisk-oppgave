<?php
  print ("<h3>Registrer klasse</h3>");

  require_once("db.php");

  if (isset($_POST["registrer"])) {

    $klassekode = $_POST["klassekode"];
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];

    $sqlSetning= "INSERT INTO klasse (klassekode, klassenavn, studiumkode) 
    VALUES (?, ?, ?);";

    $stmt = mysqli_prepare($db, $sqlSetning);
    mysqli_stmt_bind_param($stmt, "sss", $klassekode, $klassenavn, $studiumkode);

    if (mysqli_stmt_execute($stmt)) {
      print ("Klassen er registrert");
    } else {
      print ("Klassen kunne ikke registreres");
    }

    mysqli_stmt_close($stmt);
    }
?>

<form method="post" action="">
  Klassekode: <input type="text" name="klassekode" maxlength="5" required><br>
  Klassenavn: <input type="text" name="klassenavn" maxlength="50" required><br>
  Studiumkode: <input type="text" name="studiumkode" maxlength="50" required><br>

  <input type="submit" name="registrer" value="Registrer klasse">
</form>
