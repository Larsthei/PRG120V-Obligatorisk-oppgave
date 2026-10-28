<?php 
    print ("<h3>Vis alle klasser</h3>");

    require_once("db.php");

    $sqlSetning="SELECT * FROM klasse ORDER BY klassekode";

    $sqlResultat = mysqli_query($db, $sqlSetning);

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0) {
        print ("<p>Ingen klasser er registrert.</p>");
    }
    else {
      print ("<table border=1>");
      print ("<tr>
                  <th>Klassekode</th>
                  <th>Klassenavn</th>
                  <th>Studiumkode</th>
              </tr>");

      while ($rad = mysqli_fetch_array($sqlResultat)) {

      $klassekode = htmlspecialchars($rad["klassekode"]);
      $klassenavn = htmlspecialchars($rad["klassenavn"]);
      $studiumkode = htmlspecialchars($rad["studiumkode"]);

      print ("<tr>
                  <td>$klassekode</td>
                  <td>$klassenavn</td>
                  <td>$studiumkode</td>
              </tr>");
      }

      print ("</table>");
    }





?>