<?php
    print ("<h3>Slett student</h3>");

    require_once("db.php");

    $melding = "";

    if (isset($_POST["slett"])) {

        $brukernavn = $_POST["brukernavn"];

        $sqlSetning = "DELETE FROM student WHERE brukernavn = ?";

        $stmt = mysqli_prepare($db, $sqlSetning);

        mysqli_stmt_bind_param($stmt, "s", $brukernavn);

          try {
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
              $melding = "Studenten er slettet.";
            }
            else {
              $melding = "Studenten finnes ikke.";
            }
          }
          catch (mysqli_sql_exception $e) {
            $melding = "Studenten kunne ikke slettes.";
          }

          mysqli_stmt_close($stmt);
    }

    $sqlSetning = "SELECT * FROM student ORDER BY etternavn, fornavn";

    $sqlResultat = mysqli_query($db, $sqlSetning);

    $antallStudenter = mysqli_num_rows($sqlResultat);
?>

<form method="post" action="">

    Velg student

    <select name="brukernavn" required>
      <?php
        while ($rad = mysqli_fetch_array($sqlResultat)) {

          $brukernavn = htmlspecialchars($rad["brukernavn"]);
          $fornavn = htmlspecialchars($rad["fornavn"]);
          $etternavn = htmlspecialchars($rad["etternavn"]);

          print ("<option value='$brukernavn'>
                      $fornavn $etternavn
                  </option>");

        }
      ?>

    </select>
    <br></br>

    <?php
      if ($antallStudenter > 0) {
        print ("<input type='submit' name='slett' value='Slett student'>");
      }
      else {
        print ("<p>Ingen studenter er registrert.</p>");
      }

    ?>
</form>

<?php
    if ($melding != "") {
      print ("<p>" . htmlspecialchars($melding) . "</p>");
    }
?>
