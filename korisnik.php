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
    background-color: #FFCC99;
  }

  td{
    background-color: #FFCC99;
  }
  
</style>
<script src="skripta.js"></script>

 <title>Korisnik</title>
</head>
<body>

    <!-- div za prikaz svih blokova -->
    <div id="prikaziSveStoPostoji" style="display:none">
      <label for="nmp">Prikaži sve: </label>
      <a href="citalac.php"><input type="submit" value="Potvrdi" name="nmp"></a>
    </div>
    

    <!-- prikaz svih citalaca -->
    <div id="sviKorisnici", class="sviKorisnici">
    <p>Spisak trenutnih
     <a href="svicitaoci.php" target="_blank">korisnika</a>
    </p>
    </div>

    <!-- forma za dodavananje citalaca -->
    <div id="unosKorisnika", class="unosKorisnika">
    
      <form action="" name="frmUnosKorisnika" method="post">
      <label for="">Postanita naš korisnik! </label><br><br>
        <label for="ime">Ime:</label><br>
        <input type="text" name="ime" id="ime" placeholder="Unesite ime"> <br><br>
        <label for="prezime">Prezime: </label><br>
        <input type="text" name="prezime" id="prezime" placeholder="Unesite prezime"> <br><br>
        <label for="vrsta">Vrsta članstva: </label><br>
        <input type="text" name="vrstaCL" id="vrstaCl" placeholder="Unesite vrstu članstva"> <br>
        <br>
        <button type="submit" name="registruj"onclick="proveriFormuZaUnosCitaoca()">Unesi u bazu</button>
        <br>
    </form>
    <br>
    <input type="submit" value="Rezultat" onclick="skloniBlokove(blok1, 'prikaziSveStoPostoji')">
  
    </div>
    <br>

    <div id="proveraIznajmljivanja", class="proveraIznajmljivanja">
      <!-- forma za proveru -->
      
      <form action="" name="proveravanje" method="post">
      <label for="">Proverite zaduženje: </label><br><br>
        <label for="prov">Korisnik: </label>
        <select name="ponudaCitaoca" id="prov">
          <?php
            $rez = Citalac::vratiSveCitaoce($link);
            while($citalac = mysqli_fetch_array($rez))
            {
              $imePrezime = $citalac['ime'].' '.$citalac['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
        </select>
        <button type="submit" name="provera">Proveri</button>
        <button type="submit" name="brisanjeCitaoca" value="Obriši">Obriši</button>
      </form>
      <br>
     <input type="submit" value="Rezultat" onclick="skloniBlokove(blok2, 'prikaziSveStoPostoji')">
      
      </div>
      <br>

      <!-- vratiSad/iznajmiSad -->
      <div id="iznajmljivanje", class="iznajmljivanje">
     
      <form action="" method="post" name="iznajmi">
        <label for="">Unesite novo iznajmljivanje:</label><br><br>
          <label for="citic">Korisnik: </label>
          <select name="ponudaCitalaca" id="citic">
          <?php
            $rez = Citalac::vratiSveCitaoce($link);
            while($citalac = mysqli_fetch_array($rez))
            {
              $imePrezime = $citalac['ime'].' '.$citalac['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
          </select>
          <label for="knjiga">Film: </label> 
          <select name="ponudaKnjiga" id="knjiga">
            <?php
              $rez = Knjiga::vratiSveKnjige($link);
              while($knjiga = mysqli_fetch_array($rez))
              {
                $naslov = $knjiga['imeKnjige'];
              ?>
                <option value="<?php echo $naslov ?>"><?php echo $naslov ?></option>      
            <?php
              }
            ?>
          </select>
          <button type="submit" name="iznajmiSad">Iznajmi</button>
          <button type="submit" name="vratiSad">Vrati</button>
      </form>
      <br>
      <input type="submit" value="Rezultat" onclick="skloniBlokove(blok2, 'prikaziSveStoPostoji')">
      
      </div>
    

      <script>
        var svi = ["sviKorisnici" ,"unosKorisnika", "proveraIznajmljivanja", "iznajmljivanje"];
        var blok1 = ["sviKorisnici", "proveraIznajmljivanja", "iznajmljivanje"];
        var blok2 = ["sviKorisnici", "unosKorisnika", "iznajmljivanje"];
        var blok3 = ["sviKorisnici", "unosKorisnika", "proveraIznajmljivanja"];

      </script>
</body>
</html>

<?php
  //  upisivanje novog citaoca u bazu 
  if(isset($_POST['registruj']))
  {
    if($_POST['ime'] !== "" && $_POST['prezime'] !== "" && $_POST['vrstaCl'] !== "")
    {
        $citalac = new Citalac($_POST['ime'], $_POST['prezime'], $_POST['vrstaCl']);
        //provera da li postoji u bazi
        if(!$citalac->postojiUBazi($link))
          $citalac->upisiUBazu($link);
        else
           echo "Citalac vec postoji u bazi!";
    }

  }

  //provera koju knjigu je uzeo koji korisnik
  if(isset($_POST['provera']))
  {
    $vrednost = $_POST['ponudaCitaoca'];
    $povratniNiz = Citalac::iseciImePrezime($vrednost);
    $id = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    $rezultatUpita = UzeoKnjigu::vratiSpojenoCitalacKnjigaPisac($link);

    echo '<table border="2">';
    echo '<tr>';
      echo '<th>'; echo 'Ime' ; echo '</th>';
      echo '<th>'; echo 'Prezime' ; echo '</th>';
      echo '<th>'; echo 'Knjiga' ; echo '</th>';
      echo '<th>'; echo 'Pisac' ; echo '</th>';
    echo '</tr>';
    while($korisnik = mysqli_fetch_array($rezultatUpita))
    {
      if($korisnik['citalacID'] == $id)
      {
        echo '<tr>';
          echo '<th>'; echo $korisnik['ime'] ; echo '</th>';
          echo '<th>'; echo $korisnik['prezime'] ; echo '</th>';
          echo '<th>'; echo $korisnik['imeKnjige'] ; echo '</th>';
          echo '<th>'; echo $korisnik['imePisca'].' '.$korisnik['prezimePisca'] ; echo '</th>';
      echo '</tr>';
      }
    }
    echo '</table>'; 
  }

  //brisanje konkretnog citaoca
  if(isset($_POST['brisanjeCitaoca']))
  {
    $vrednost = $_POST['ponudaCitaoca'];
    $povratniNiz = Citalac::iseciImePrezime($vrednost);
    $id = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    Citalac::izbaciCitaoca($link, $id);
  }



  //unos zaduzenja
  if(isset($_POST['iznajmiSad']))
  {
    $imePrezime = $_POST['ponudaCitalaca'];
    $imeKnjige = $_POST['ponudaKnjiga'];
    $idKnjige = Knjiga::vratiIDKnjigeNaOsnovuImena($link, $imeKnjige);
    $povratniNiz = Citalac::iseciImePrezime($imePrezime);
    $citalacID = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    
    if(UzeoKnjigu::postojiParCitalacKnjiga($link, $citalacID, $idKnjige))
      die("Čitalac $imePrezime je već zadužio knjigu $imeKnjige.");

    UzeoKnjigu::ubaciParCitalacKnjigaUBazu($link, $citalacID, $idKnjige);
    
  }
  //vratiSad citaoca
  if(isset($_POST['vratiSad']))
  {
    $imePrezime = $_POST['ponudaCitalaca'];
    $imeKnjige = $_POST['ponudaKnjiga'];
    $idKnjige = Knjiga::vratiIDKnjigeNaOsnovuImena($link, $imeKnjige);
    $povratniNiz = Citalac::iseciImePrezime($imePrezime);
    $citalacID = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    
    if(!UzeoKnjigu::postojiParCitalacKnjiga($link, $citalacID, $idKnjige))
      die("Čitalac $imePrezime nije uzeo knjigu $imeKnjige.");

    UzeoKnjigu::izbaciParCitalacKnjiga($link, $citalacID, $idKnjige);

  }



?>
