<?php
    print ("<h3>Registrer student</h3>");

    require_once("db.php");

    $melding = "";

    if (isset($_POST["registrer"])) {

      $brukernavn = trim($_POST["brukernavn"]);
      $fornavn = trim($_POST["fornavn"]);
      $etternavn = trim($_POST["etternavn"]);
      $klassekode = trim($_POST["klassekode"]);

      $sqlsetning = "INSERT INTO student
                     (brukernavn, fornavn, etternavn, klassekode)
                     VALUES (?, ?, ?, ?)";

      $stmt = mysqli_prepare($db, $sqlsetning);

      $mysqli_stmt_bind_param($stmt, "ssss", $brukernavn, $fornavn, $etternavn, $klassekode);

      try {
        mysqli_stmt_execute($stmt);
        $melding = "Studenten er registrert.";
      }
      catch (mysqli_sql_exception $e) {

        if ($e ->getCode() == 1062) {
          $melding = "Studenten er allerede registrert.";
        }
        else {
          $melding = "Studenten kunne ikke registreres.";
        }
      }

      mysqli_stmt_close($stmt);
    }

    $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode";

    $sqlResultat = mysqli_query($db, $sqlSetning);

    $antallKlasser = mysqli_num_rows($sqlResultat);
?>  

<form method="post" action="">

  Brukernavn
  <input type="text" name="brukernavn" maxlenght="7" required>
  <br>

  Fornavn
  <input type="text" name="fornavn" maxlength="50" required>
  <br>

  Etternavn
  <input type="text" name="etternavn" maxlength="50" required>
  <br>

  Velg klasse
  <select name="klassekode" required>
    <?php
      while ($rad = mysqli_fetch_array($sqlResultat)) {

        $klassekode = htmlspecialchars($rad["klassekode"]);
        $klassenavn = htmlspecialchars($rad["klassenavn"]);

        print ("<option value='$klassekode'>
                    $klassekode - $klassenavn
                </option>");
      }
    ?>
  </select>

  <br></br>

  <?php
     if ($antallKlasser > 0) {
        print ('<input type="submit" name="registrer" value="Registrer student">');
     }
     else {
        print ("<p>Du må registrere en klasse før du kan registrere en student.</p>");
     }
  ?>

</form>

<?php
  
    if ($melding != "") {
      print ("<p>" . htmlspecialchars($melding) . "</p>");
    }
?>