<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Svi čitaoci</title>
<style>
 a{
    color: black;
    text-decoration: none;
  }

  /* body {
  padding: 0;
  font-weight: 10px;
  background-color: rgb(65,105,225);
  color: #000;
  } */

  body {
  padding: 0;
  font-weight: 10px;
  background: url("slika1.jpg");
  color: #990000;
  }

  input{
     background-color: #FFCC99;
     color: black;
  }

  select{
    background-color: #FFCC99;
     color: black;
  }

  button{
    font-weight: bold;
    background-color: #ffb266;
    color: black;
  }

  th{
     background-color: #ffb266;
  }

  td{
     background-color: #FFCC99;
  }
</style>
</head>
<body>
   
</body>
</html>


<?php
  include "konekcija.php";
  echo "<h2>Svi naši čitaoci: </h2>";
  $sqlUpit = "SELECT * FROM citalac c JOIN kategorijaclanstva k USING(kategorijaClanstvaID)";
  $rez = mysqli_query($link, $sqlUpit);
  if(!$rez)
    die("Upit nije uspešno izvršen.");
  echo "<table border=2>";
     echo "<tr>";  
        echo "<th>"; echo "Ime";  echo "</th>";
        echo "<th>"; echo "Prezime";  echo "</th>";
        echo "<th>"; echo "Kategorija clanstva";  echo "</th>";
     echo "</tr>";
  while($korisnik = mysqli_fetch_array($rez))
  {
      echo "<tr>";  
        echo "<td>"; echo $korisnik['ime'];  echo "</td>";
        echo "<td>"; echo $korisnik['prezime'];  echo "</td>";
        echo "<td>"; echo $korisnik['nazivClanstva'];  echo "</td>";
        echo '<br>';
     echo "</tr>";
  }
  echo "</table>";
?>
