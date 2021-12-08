<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filmovi</title>
<style>
  h2{
    position: relative;
  left: 65%;
 width: 200px;
  } 
  body {
    padding: 0;
  font-weight: 10px;
  background: url("slika1.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  }
table{
  position: relative;
  width: 700px;
  left: 50%;
  top: 100px;
  background-color: purple;
    color: white;
    text-align: center;
}
</style>
</head>
<body>
</body>
</html>
<?php
  include "konekcija.php";
  echo "<h2>Dostupni filmovi: </h2>";
  $sqlUpit = "SELECT * FROM film JOIN reditelj USING(rediteljID) JOIN zanr USING(zanrID)";
  $rez = mysqli_query($link, $sqlUpit);
  if(!$rez)
    die ("Došlo je do greške.");
  echo "<table border=2>";
  echo "<tr>";
    echo "<th>"; echo "Naziv filma"; "</th>";
    echo "<th>"; echo "Reditelj"; "</th>";
    echo "<th>"; echo "Žanr"; echo "</th>";
  echo "</tr>";  
    while($film = mysqli_fetch_array($rez))
    {
      echo "<tr>";
         echo "<td>"; echo $film['nazivFilma'];  echo "</td>";
         echo "<td>"; echo $film['imeReditelja'].' '.$film['prezimeReditelja'];
         echo "<td>"; echo $film['nazivZanra'];  echo "</td>";
      echo "</tr>";
    }
  echo "</table>";
?>