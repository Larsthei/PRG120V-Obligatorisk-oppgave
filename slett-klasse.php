<?php
    print ("<h3>Slett klasse</h3>");

    require_once("db.php");

    $melding = "";

    if (isset($_POST["slett"])) {
      
      $klassekode = $_POST["klassekode"];

      $sqlSetning = "DELETE FROM klasse WHERE klassekode = ?";

      $stmt = mysqli_prepare($db, $sqlSetning);

      mysqli_stmt_bind_param($stmt, "s", $klassekode);

      try {
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
          $melding = "Klassen er slettet.";

        }
        else {
          $melding = "Klassen finnes ikke.";
        }
      }
      catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1451) {
           $melding = "Klassen kan ikke slettes fordi den har registrerte studenter.";
      }
      else {
        $melding = "Klassen kunne ikke slettes.";
      
    }
    
       mysqli_stmt_close($stmt);
    }

    sqlSetning = "SELECT * FROM klasse ORDER BY klassekode";

    sqlResultat = mysqli_query($db, $sqlSetning);
?>

<form method="post" action="">

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

    <input type="submit" name="slett" value="Slett klasse">

</form>

<?php
    if ($melding != "") {
      print ("<p>" . htmlspecialchars($melding) . "</p>");
    }
?>