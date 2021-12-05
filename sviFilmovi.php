<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sve knjige</title>
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
  echo "<h2>Sve naše knjige: </h2>";
  $sqlUpit = "SELECT * FROM knjiga JOIN pisac USING(pisacID) JOIN zanr USING(zanrID)";
  $rez = mysqli_query($link, $sqlUpit);
  if(!$rez)
    die ("Upit nije uspešno izvršen.");
  echo "<table border=2>";
  echo "<tr>";
    echo "<th>"; echo "Naslov knjige"; "</th>";
    echo "<th>"; echo "Pisac knjige"; "</th>";
    echo "<th>"; echo "Zanr"; echo "</th>";
  echo "</tr>";  
    while($knjiga = mysqli_fetch_array($rez))
    {
      echo "<tr>";
         echo "<td>"; echo $knjiga['imeKnjige'];  echo "</td>";
         echo "<td>"; echo $knjiga['imePisca'].' '.$knjiga['prezimePisca'];
         echo "<td>"; echo $knjiga['imeZanra'];  echo "</td>";
      echo "</tr>";
    }
  echo "</table>";

?>