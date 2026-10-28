<?php
    print ("<h3>Registrer klasse</h3>");

    include "db-tilkobling.php";

    print ("<p>Databaseforbindelsen fungerer!</p>");
?>

<form method="post" action="">
  Klassekode: <input type="text" name="klassekode" maxlength="5" required><br>
  Klassenavn: <input type="text" name="klassenavn" maxlength="50" required><br>
  Studiumkode: <input type="text" name="studiumkode" maxlength="50" required><br>

  <input type="submit" name="registrer" value="Registrer klasse">
</form>
