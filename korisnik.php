<?php include "konekcija.php"?>
<?php include "klase.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="./styles.css" />
<style>
 a{
  color: lightblue;
    text-decoration: none;
  }
  label{
    background-color: purple;
    color: white;
    font-size: large;
  }
  body {
  padding: 0;
  background: url("slika1.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  }
  .unosKorisnika{
  position: relative;
  left: 50%;
  width: 200px;
 }
.proveraIznajmljivanja{
  position: relative;
  left: 50%;
  width: 400px;
}
.iznajmljivanje{
  position: relative;
  left: 50%;
  width: 600px;
}
.sviKorisnici{
  position: relative;
  left: 80%;
  width: 200px;
  font-size: large;
}
input{
  background-color: white;
  color: black;
}
select{
  background-color: white;
  color: black;
}
button{
  font-weight: bold;
  background-color: white;
  color: black;
}
th{
  background-color: purple;
  color: white;
}
td{
  background-color: purple;
  color: white;
}
.iznajmljeni{
  position: relative;
  top:10px;
  left: 800px;
  text-align: center;
  width: 400px;
  height: 150px;
}
h3{
  position: relative;
  left: 760px;
  width: 500px;
  background-color: purple;
}
</style>
<script src="skripta.js"></script>
 <title>Korisnik</title>
</head>
<body>
    <div id="sviKorisnici", class="sviKorisnici">
    <p>Spisak trenutnih
     <a href="sviKorisnici.php" target="_blank">korisnika</a>
    </p>
    </div>
    <div id="unosKorisnika", class="unosKorisnika">
      <form action="" name="frmUnosKorisnika" method="post">
      <label for="">Postanite naš korisnik! </label><br><br>
        <label for="ime">Ime:</label><br>
        <input type="text" name="ime" id="ime" placeholder="Unesite ime"> <br><br>
        <label for="prezime">Prezime: </label><br>
        <input type="text" name="prezime" id="prezime" placeholder="Unesite prezime"> <br><br>
        <label for="vrstaCl">Vrsta članstva: </label><br>
        <input type="text" name="vrstaCl" id="vrstaCl" placeholder="Unesite vrstu članstva"> <br>
        <br>
        <button  type="submit" onclick="proveriUnosKorisnika()" name="registruj">Registruj</button>
        <br>
    </form>
    <br>
    </div>
    <br>
    <div id="proveraIznajmljivanja", class="proveraIznajmljivanja">
      <form action="" name="proveravanje" method="post">
      <label for="">Proverite zaduženje: </label><br><br>
        <label for="prov">Korisnik: </label>
        <select name="listaKorisnika" id="prov">
          <?php
            $rez = Korisnik::vratiSveKorisnike($link);
            while($korisnik = mysqli_fetch_array($rez))
            {
              $imePrezime = $korisnik['ime'].' '.$korisnik['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
        </select>
        <button type="submit" name="proveraZaduzenja">Proveri</button>
        <button type="submit" name="obrisiKorisnika" value="Obrisi">Obriši</button>
      </form>
      <br>
      </div>
      <br>
      <div id="iznajmljivanje", class="iznajmljivanje">
      <form action="" method="post" name="iznajmi">
        <label for="">Novo zaduženje:</label><br><br>
          <label for="kor">Korisnik: </label>
          <select name="listaKor" id="kor">
          <?php
            $rez = Korisnik::vratiSveKorisnike($link);
            while($korisnik = mysqli_fetch_array($rez))
            {
              $imePrezime = $korisnik['ime'].' '.$korisnik['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
          </select>
          <label for="film">Film: </label> 
          <select name="listaFilmova" id="film">
            <?php
              $rez = Film::vratiSveFilmove($link);
              while($film = mysqli_fetch_array($rez))
              {
                $naziv = $film['nazivFilma'];
              ?>
                <option value="<?php echo $naziv ?>"><?php echo $naziv ?></option>      
            <?php
              }
            ?>
          </select>
          <button type="submit" name="iznajmiSad">Iznajmi</button>
          <button type="submit" name="vratiSad">Vrati</button>
      </form>
      <br>
      </div>
</body>
</html>
<?php
  if(isset($_POST['registruj']))
  {
    if($_POST['ime'] !== "" && $_POST['prezime'] !== "" && $_POST['vrstaCl'] !== "")
    {
        $korisnik = new Korisnik($_POST['ime'], $_POST['prezime'], $_POST['vrstaCl']);
        if(!$korisnik->postojiUBazi($link))
          $korisnik->upisiUBazu($link);
        else
           echo "<h2 class='obavestenja'>Korisnik već postoji u bazi.</h2>";
    }
  }
  if(isset($_POST['proveraZaduzenja']))
  {
    $vrednost = $_POST['listaKorisnika'];
    $povratniNiz = Korisnik::odvojImePrezime($vrednost);
    $id = Korisnik::vratiIDKorisnika($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    $rezultatUpita = Iznajmljivanje::vratiKorisnikFilmReditelj($link);
    echo '<table class="iznajmljeni" border="2">';
    echo '<tr>';
      echo '<th>'; echo 'Ime' ; echo '</th>';
      echo '<th>'; echo 'Prezime' ; echo '</th>';
      echo '<th>'; echo 'Film' ; echo '</th>';
      echo '<th>'; echo 'Reditelj' ; echo '</th>';
    echo '</tr>';
    while($korisnik = mysqli_fetch_array($rezultatUpita))
    {
      if($korisnik['korisnikID'] == $id)
      {
        echo '<tr>';
          echo '<th>'; echo $korisnik['ime'] ; echo '</th>';
          echo '<th>'; echo $korisnik['prezime'] ; echo '</th>';
          echo '<th>'; echo $korisnik['nazivFilma'] ; echo '</th>';
          echo '<th>'; echo $korisnik['imeReditelja'].' '.$korisnik['prezimeReditelja'] ; echo '</th>';
      echo '</tr>';
      }
    }
    echo '</table>'; 
  }
  if(isset($_POST['obrisiKorisnika']))
  {
    $vrednost = $_POST['listaKorisnika'];
    $povratniNiz = Korisnik::odvojImePrezime($vrednost);
    $id = Korisnik::vratiIDKorisnika($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    Korisnik::izbaciKorisnika($link, $id);
  }
  if(isset($_POST['iznajmiSad']))
  {
    $imePrezime = $_POST['listaKor'];
    $nazivFilma = $_POST['listaFilmova'];
    $filmID = Film::vratiIDFilma($link, $nazivFilma);
    $povratniNiz = Korisnik::odvojImePrezime($imePrezime);
    $korisnikID = Korisnik::vratiIDKorisnika($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    if(Iznajmljivanje::parKorisnikFilm($link, $korisnikID, $filmID))
      die("<h3>Korisnik $imePrezime je već iznajmio film $nazivFilma.</h3>");
      Iznajmljivanje::ubaciKorisnikaIFilm($link, $korisnikID, $filmID);
  }
  if(isset($_POST['vratiSad']))
  {
    $imePrezime = $_POST['listaKor'];
    $nazivFilma = $_POST['listaFilmova'];
    $filmID = Film::vratiIDFilma($link, $nazivFilma);
    $povratniNiz = Korisnik::odvojImePrezime($imePrezime);
    $korisnikID = Korisnik::vratiIDKorisnika($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    if(!Iznajmljivanje::parKorisnikFilm($link, $korisnikID, $filmID))
      die("<h3>Korisnik $imePrezime nije iznajmio film $nazivFilma.<h3>");
      Iznajmljivanje::izbaciKorisnikaIFilm($link, $korisnikID, $filmID);
  }
?>