<?php include "konekcija.php"?>
<?php include "klase.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Film</title>
<style>
  a{
    color: lightblue;
    text-decoration: none;
  }
  label{
    background-color: purple;
  }
  body {
    padding: 0;
  font-weight: 10px;
  background: url("slika1.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  color: white;
  }
  .prikazFilmova{
    position: relative;
  left: 85%;
  width: 200px;
  font-size: x-large;
  }
  .frmFilmPoReditelju{
    position: relative;
  left: 50%;
  width: 500px;
} 
  table{
    position: fixed;;
   bottom: 450px;
    width: 400px;
    height: 100px;
    text-align: center;
    background-color: purple;
     color: white;
  }
.frmDodajFilm{
  position: relative;
  left: 50%;
  width: 600px;
}
.frmRediteljPoDrzavi{
  position: relative;
  left: 50%;
  width: 500px;
}
.frmFilmPoZanru{
  position: relative;
  left: 50%;
  width: 500px;
}
</style>
<script src="skripta.js"></script>
</head>
<body>
   <div class="prikazFilmova">
   <p>Dostupni
   <a href="sviFilmovi.php" target="_blank">filmovi</a></p>
   </div>
   <div class="frmDodajFilm">
   <form action="" method="post">
   <label for="">Dodaj novi film: </label><br><br>
     <label for="nazivFilma">Naziv filma: </label>
     <input type="text" name="nazivFilma" id="nazivFilma">
     <label for="cmbReditelji">Reditelj: </label>
     <select name="cmbReditelji" id="cmbReditelji">
       <?php 
          $rez = Reditelj::vratiSvePisce($link);
          while($reditelj = mysqli_fetch_array($rez))
          {
            $imePrezime = $reditelj['imeReditelja'].' '.$reditelj['prezimeReditelja'];
        ?>
            <option value="<?php echo $imePrezime ?>"><?php echo $imePrezime ?></option>
        <?php
          }
        ?>
     </select>
     <label for="listaZanrova">Žanr: </label>
     <select name="listaZanrova" id="listaZanrova">
        <?php
          $rez = Zanr::vratiSveZanrove($link);
          while($zanr = mysqli_fetch_array($rez))
          {
            $nazivZanra = $zanr['nazivZanra'];
        ?>
            <option value="<?php echo $nazivZanra ?>"><?php echo $nazivZanra?></option>
        <?php
          }
        ?>
     </select>
     </label>
     <br><br>
     <label for="">Ukoliko nema reditelja u padajućoj listi: </label><br><br>
     <label for="imeNovogRed">Ime reditelja: </label>
     <input type="text" name="imeNovogRed" id="imeNovogRed">
     <label for="prezimeNovogRed">Prezime reditelja: </label>
     <input type="text" name="prezimeNovogRed" id="prezimeNovogRed">
     <br> <br>
     <label for="drzavaRed">Država: </label>
     <input type="text" name="drzavaRed" id="drzavaRed">
     <br><br>
     <label for="">Ukoliko nema žanra u padajućoj listi: </label><br><br>
     <label for="noviZanr">Žanr: </label>
     <input type="text" name="noviZanr" id="noviZanr">
     <br>
     <br>
     <button type="submit" name="dodajFilm" onclick="proveriUnosFilma()">Dodaj film</button>
     <button type="submit" name="brisanje" onclick="proveriBrisanjeFilma()">Obriši film</button>
   </form>
   <br>
   </div>
   <br>
   <div class="frmFilmPoReditelju">
   <form action="" method="post">
   <label for="">Filmovi režisirani od odabranog reditelja: </label><br><br>
     <label for="reditelji">Reditelj: </label>
     <select name="reditelji" id="reditelji">
      <?php 
          $rez = Reditelj::vratiSvePisce($link);
          while($reditelj = mysqli_fetch_array($rez))
          {
            $imePrezime = $reditelj['imeReditelja'].' '.$reditelj['prezimeReditelja'];
        ?>
            <option value="<?php echo $imePrezime ?>"><?php echo $imePrezime ?></option>
        <?php
          }
        ?>
     </select>
     <button type="submit" name="nadjiFilmove">Odaberi</button>
   </form>
   <br>
   </div>
   <br>
   <div class="frmRediteljPoDrzavi">
   <form action="" method="post">
   <label for="">Pogledajte koji reditelji dolaze iz odabrane države: </label><br><br>
     <label for="drzave">Država: </label>
     <select name="drzave" id="drzave">
          <?php
            $rez = Reditelj::vratiSveZemljeRazlicito($link);
            while($zemlje = mysqli_fetch_array($rez))
              {
                $zemlja = $zemlje['drzava'];
          ?>
              <option value="<?php echo $zemlja ?>"><?php echo $zemlja ?></option>
          <?php      
              }
          ?>
     </select>
     <button type="submit" name="nadjiReditelja">Odaberi</button>
   </form>
   <br>
   </div>
   <br>
   <div class="frmFilmPoZanru">
   <form action="" method="post">
   <label for="">Pogledajte filmove odabranog žanra: </label><br><br>
   <label for="zanrovi">Žanr: </label>
   <select name="zanrovi" id="zanrovi">
      <?php
        $rez = Zanr::vratiSvaImenaZanrovaRazlicito($link);
        while($zanr = mysqli_fetch_array($rez))
        {
          $nazivZanra = $zanr['nazivZanra'];
      ?>
          <option value="<?php echo $nazivZanra ?>"><?php echo $nazivZanra ?></option>
      <?php
        }
      ?>
   </select>
   <button type="submit" name="proveriZanr">Odaberi</button>
   </form>
   <br>
   </div>
</body>
</html>
<?php
   if(isset($_POST['dodajFilm']))
   {
      $imeReditelja;
      $prezimeReditelja;
      $drzavaReditelja;
      $nazivZanra;
      $povratniNiz = Korisnik::iseciImePrezime($_POST['cmbReditelji']);
      $imeReditelja = $povratniNiz['ime'];
      $prezimeReditelja = $povratniNiz['prezime'];
      $nazivZanra = $_POST['listaZanrova'];
      if($_POST['imeNovogRed'] != '' && $_POST['prezimeNovogRed'] != '' &&  $_POST['drzavaRed'] != '')
      {
         $imeReditelja = $_POST['imeNovogRed'];
         $prezimeReditelja = $_POST['prezimeNovogRed'];
         $drzavaReditelja = $_POST['drzavaRed'];
         $reditelj = new Reditelj($imeReditelja, $prezimeReditelja, $drzavaReditelja);
         $reditelj->unesiPiscaUBazu($link);
      }
      if($_POST['noviZanr'] != "")
      {
         $nazivZanra = $_POST['noviZanr'];
         $zanr = new Zanr($nazivZanra);
         if(!$zanr->postojiZanr($link))
           $zanr->unesiZanrUBazu($link);
         else
           echo "Žanr već postoji.";
      }
      $rediteljID = Reditelj::vratiIdPisca($link, $imeReditelja, $prezimeReditelja);
      $zanrID = Zanr::vratiIdZanra($link, $nazivZanra);
      $nazivFilma = $_POST['nazivFilma'];
      if($nazivFilma == "")
        die();
      $film = new Film($nazivFilma, $rediteljID, $zanrID);
      if(!$film->postojiKnjiga($link))
          $film->dodajKnjiguUBazu($link);
      else
        echo "Film već postoji.";     
   }
   if(isset($_POST['brisanje']))
   {
     $nazivFilma = $_POST['nazivFilma'];
     $povratniNiz = Korisnik::iseciImePrezime($_POST['cmbReditelji']);
     $imeReditelja = $povratniNiz['ime'];
     $prezimeReditelja = $povratniNiz['prezime'];
     $nazivZanra = $_POST['listaZanrova'];
     if($_POST['imeNovogRed'] != "" || $_POST['prezimeNovogRed'] != "" || $_POST['drzavaRed'] != "" || $_POST['noviZanr'] != "")
      {
        die();
      }
     $rediteljID = Reditelj::vratiIdPisca($link, $imeReditelja, $prezimeReditelja);
     $zanrID = Zanr::vratiIdZanra($link, $nazivZanra);
     $filmBrisi = new Film($nazivFilma, $rediteljID, $zanrID);
     $filmBrisi->izbaciKnjiguIzBaze($link);
     var_dump($_POST);
   }
   if(isset($_POST['nadjiFilmove']))
   {
      $imePrezReditelja = $_POST['reditelji'];
      $niz = Korisnik::iseciImePrezime($imePrezReditelja);
      $idReditelj = Reditelj::vratiIdPisca($link, $niz['ime'], $niz['prezime']);
      echo "<table border=2>";
       echo "<tr>";
         echo "<th>"; echo "Reditelj"; echo "</th>";
         echo "<th>"; echo "Naziv filma"; echo "</th>";
         echo "<th>"; echo "Žanr"; echo "</th>";
       echo "</tr>";
         $rez = Film::vratiKnjigeSpojenoSaZanrom($link);
         while($film = mysqli_fetch_array($rez))
         {
           if($film['rediteljID'] == $idReditelj)
           {
              echo "<tr>";
                echo "<td>"; echo $niz['ime'].' '.$niz['prezime']; echo "</td>";
                echo "<td>"; echo $film['nazivFilma']; echo "</td>";
                echo "<td>"; echo $film['nazivZanra']; echo "</td>";
              echo "</tr>";
           }
         }
      echo "</table>";
   }
   if(isset($_POST['nadjiReditelja']))
   {
      $drzava = $_POST['drzave'];
      $rez = Reditelj::vratiSvePisce($link);
      echo "<table border=2>";
      echo "<tr>";
         echo "<th>"; echo "Reditelj"; echo "</th>";
         echo "<th>"; echo "Država"; echo "</th>";
       echo "</tr>";
      while($reditelj = mysqli_fetch_array($rez))
      {
          if($reditelj['drzava'] == $drzava)
          {
            echo "<tr>";
              echo "<td>"; echo $reditelj['imeReditelja'].' '.$reditelj['prezimeReditelja']; echo "</td>";
              echo "<td>"; echo $reditelj['drzava']; echo "</td>";
           echo "</tr>";
          }
      }
      echo "</table>";
   }
   if(isset($_POST['proveriZanr']))
   {
     echo "<br>";
     $nazivZanra = $_POST['zanrovi'];
     $tabela = Film::vratiKnjigeSpojenoSaZanromSpojenoSaPiscem($link);
     echo "<table border=2>";
     echo "<tr>";
         echo "<th>"; echo "Naziv filma"; echo "</th>";
         echo "<th>"; echo "Reditelj"; echo "</th>";
         echo "<th>"; echo "Žanr"; echo "</th>";
     echo "</tr>";
     while($film = mysqli_fetch_array($tabela))
     {
        if($film['nazivZanra'] == $nazivZanra)
        {
          echo "<tr>";
           echo "<td>"; echo $film['nazivFilma']; echo "</td>";
           echo "<td>"; echo $film['imeReditelja'].' '.$film['prezimeReditelja']; echo "</td>";
           echo "<td>"; echo $film['nazivZanra']; echo "</td>";
          echo "</tr>";
        }
     }
     echo "</table>";
   }
?>