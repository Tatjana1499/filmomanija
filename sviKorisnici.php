<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Svi korisnici</title>
<style>
  body {
      padding: 0;
      font-weight: 10px;
      background: url("slika1.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      color: white;
  }
  table{
     width: 800px;
     height: 400px;
     position: relative;
    left: 700px;
    text-align: center;
  }
  th{
     background-color: purple;
     color: white;
  }
  td{
     background-color: purple;
     color: white;
  }
  h1{
   position: relative;
    left: 1000px;
    width: 200px;
  }
  h3{
   position: relative;
   top: 100px;
    left: 800px;
    width: 500px;
  }
</style>
</head>
<body>
</body>
</html>
<?php
  include "konekcija.php";
  echo "<h1>Svi korisnici: </h1>";
  $sqlUpit = "SELECT * FROM korisnik k JOIN clanstvo c USING(vrstaClanstvaID)";
  $rez = mysqli_query($link, $sqlUpit);
  if(!$rez)
    die("<h3>Došlo je do greške prilikom učitavanja korisnika.</h3>");
  echo "<table border=2>";
     echo "<tr>";  
        echo "<th>"; echo "Ime";  echo "</th>";
        echo "<th>"; echo "Prezime";  echo "</th>";
        echo "<th>"; echo "Vrsta članstva";  echo "</th>";
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