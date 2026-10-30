<?php
    print ("<h3>Vis alle studenter</h3>");

    require_once("db.php");

    $sqlSetning="SELECT * FROM student ORDER BY etternavn, fornavn";

    $sqlResultat = mysqli_query($db, $sqlSetning);

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0) {
      print ("<p>Ingen studenter er registrert.</p>");
    }
    else {
      print ("<table border='1'>");

      print ("<tr>
                  <th>Brukernavn</th>
                  <th>Fornavn</th>
                  <th>Etternavn</th>
                  <th>Klassekode</th>
              </tr>");

      while ($rad = mysqli_fetch_array($sqlResultat)) {

        $brukernavn = htmlspecialchars($rad["brukernavn"]);
        $fornavn = htmlspecialchars($rad["fornavn"]);
        $etternavn = htmlspecialchars($rad["etternavn"]);
        $klassekode = htmlspecialchars($rad["klassekode"]);

        print ("<tr>
                    <td>$brukernavn</td>
                    <td>$fornavn</td>
                    <td>$etternavn</td>
                    <td>$klassekode</td>
                </tr>");
      }

      print ("</table>");
    }


?>