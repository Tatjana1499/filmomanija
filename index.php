<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles.css" />
    <title>Filmomanija</title>
<style>
h2 {
  text-align: center;
  font-size: xx-large;
}
.tekstONama{
  position: relative;
  left: 50%;
 width: 50%;
  background-color: purple;
  text-align: center;
}
.najpopRed{
  position: relative; 
  left: 45%;
 width: 20%;
 color: black;
}
 a{
    color: white;
    text-decoration: none;
  }
.korfil{
  position: relative;
    top: 500px;
  left: 70%;
 width: 200px;
  border: 3px outset lightblue;
  background-color: purple;
  text-align: center;
}
  body {
    padding: 0;
  font-weight: 10px;
  background: url("slika1.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  }
  button{
    font-weight: bold;
    position: relative;
    left: 1000px;
    top: 500px;
    background-color: purple;
    color: white;
  }
</style>
  </head>
  <body>
   <button type="submit" name="oNama" id="oNama">O nama</button>
   <button type="submit" name="skloni" id="skloni" onclick="skloniDiv('tekstONama')">Ukloni tekst</button>
   <br><br>
   <button type="submit" name="btnNajReditelji" id="btnNajReditelji">Najpopularniji reditelji</button>
   <button type="submit" name="skloniReditelje" id="skloniReditelje" onclick="skloniDiv('najpopRed')">Ukloni tekst</button>
    <h2>Dobro došli u FILMOMANIJU!</h2>
    <div class="korfil">
        <a href="korisnik.php" target="_blank">Korisnici</a>
        <br> <br>
        <a href="film.php" target="_blank">Filmovi</a>
    </div>
    <div id="tekstONama", class="tekstONama"></div>
    <div id="najpopRed", class="najpopRed"></div>
    <script>
    //AJAX - ucitavanje iz json fajla
    document.getElementById("btnNajReditelji").addEventListener("click", vratiReditelje);
    function vratiReditelje() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "najpopularnijiReditelji.json", true);
        xhr.onload = function () {
          if (this.status == 200) {
            var reditelji = JSON.parse(this.responseText); //parsiranje niza objekata zbog pristupa poljima dot operatorom
            var output = "";
            for (var r in reditelji) {
              output +=
                "<ul>" +
                "<li>ID: " +
                reditelji[r].rediteljID +
                " </li>" +
                "<li>ime: " +
                reditelji[r].ime +
                " </li>" +
                "<li>prezime: " +
                reditelji[r].prezime +
                " </li>" +
                "</ul>";
            }
            document.getElementById("najpopRed").innerHTML = output;
          }
        };
        xhr.send();
      }
    //AJAX - o nama
     document.getElementById("oNama").addEventListener("click", vratiONama);
    function vratiONama() {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "oNama.txt", true);
      xhr.onload = function () {
        if (this.status == 200) {
          document.getElementById("tekstONama").innerHTML = this.responseText;
        }
      };
      xhr.send();
    }
    function skloniDiv(div) {
      document.getElementById(div).innerHTML = "";
    }
    </script>
  </body>
</html>