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
<script>
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
</script>
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
     <label for="novaKnjiga">Naziv filma: </label>
     <input type="text" name="novaKnjiga" id="novaKnjiga">
     <label for="sviPisci">Reditelj: </label>
     <select name="sviPisci" id="sviPisci">
       <?php 
          $rezultatUpita = Pisac::vratiSvePisce($link);
          while($pisac = mysqli_fetch_array($rezultatUpita))
          {
            $imePrezime = $pisac['imePisca'].' '.$pisac['prezimePisca'];
        ?>
            <option value="<?php echo $imePrezime ?>"><?php echo $imePrezime ?></option>
        <?php
          }
        ?>
     </select>
     <label for="sviZanrovi">Žanr: </label>
     <select name="sviZanrovi" id="sviZanrovi">
        <?php
          $rezultatUpita = Zanr::vratiSveZanrove($link);
          while($zanr = mysqli_fetch_array($rezultatUpita))
          {
            $imeZanra = $zanr['imeZanra'];
        ?>
            <option value="<?php echo $imeZanra ?>"><?php echo $imeZanra?></option>
        <?php
          }
        ?>
     </select>
     </label>
     <br><br>
     <label for="">Ukoliko nema reditelja u padajućoj listi: </label><br><br>
     <label for="imeNovogPisca">Ime reditelja: </label>
     <input type="text" name="imeNovogPisca" id="imeNovogPisca">
     <label for="prezimeNovogPisca">Prezime reditelja: </label>
     <input type="text" name="prezimeNovogPisca" id="prezimeNovogPisca">
     <br> <br>
     <label for="zemljaPisca">Država: </label>
     <input type="text" name="zemljaPisca" id="zemljaPisca">
     <br><br>
     <label for="">Ukoliko nema žanra u padajućoj listi: </label><br><br>
     <label for="noviZanr">Žanr: </label>
     <input type="text" name="noviZanr" id="noviZanr">
     <br>
     <br>
     <!-- dugme za dodavanje knjige -->
     <button type="submit" name="dodavanjeKnjige" onclick="proveriFormuZaKnjige()">Dodaj film</button>
     <button type="submit" name="brisanje" onclick="proveriFormuZaBrisanjeKnjige()">Obriši film</button>
   </form>
   <br>
 
   </div>
   <br>
   
   <div class="frmFilmPoReditelju">
   <form action="" method="post">
   <label for="">Pogledajte koje knjige imamo u ponudi od strane konkretnog pisca: </label><br><br>
     <label for="pisci">Pisac: </label>
     <select name="pisci" id="pisci">
      <?php 
          $rezultatUpita = Pisac::vratiSvePisce($link);
          while($pisac = mysqli_fetch_array($rezultatUpita))
          {
            $imePrezime = $pisac['imePisca'].' '.$pisac['prezimePisca'];
        ?>
            <option value="<?php echo $imePrezime ?>"><?php echo $imePrezime ?></option>
        <?php
          }
        ?>
     </select>
     <button type="submit" name="proveriKnjige">Odaberi</button>
   </form>
   <br>
   </div>
   <br>
   <div class="frmRediteljPoDrzavi">
   <form action="" method="post">
   <label for="">Pogledajte koji reditelji dolaze iz odabrane države: </label><br><br>
     <label for="zemlje">Država: </label>
     <select name="zemlje" id="zemlje">
          <?php
            $rez = Pisac::vratiSveZemljeRazlicito($link);
            while($redTabele = mysqli_fetch_array($rez))
              {
                $zemlja = $redTabele['zemljaPorekla'];
          ?>
              <option value="<?php echo $zemlja ?>"><?php echo $zemlja ?></option>
          <?php      
              }
          ?>
     </select>
     <button type="submit" name="proveriZemlje">Odaberi</button>
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
        $rezupita = Zanr::vratiSvaImenaZanrovaRazlicito($link);
        while($zanr = mysqli_fetch_array($rezupita))
        {
          $imeZanra = $zanr['imeZanra'];
      ?>
          <option value="<?php echo $imeZanra ?>"><?php echo $imeZanra ?></option>
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
   //dodavanje nove knjige u bazu
   if(isset($_POST['dodavanjeKnjige']))
   {
      
      $imePisca;
      $prezimePisca;
      $zemljaPisca;
      $imeZanra;

      $povratniNiz = Citalac::iseciImePrezime($_POST['sviPisci']);
      $imePisca = $povratniNiz['ime'];
      $prezimePisca = $povratniNiz['prezime'];
      $imeZanra = $_POST['sviZanrovi'];

      //izmeni imePisca, prezimePisca i zemljaPisca ako je u pitanju novi pisac
      //dodaj novog pisca u bazu sa tim podacima
      if($_POST['imeNovogPisca'] != '' && $_POST['prezimeNovogPisca'] != '' &&  $_POST['zemljaPisca'] != '')
      {
         $imePisca = $_POST['imeNovogPisca'];
         $prezimePisca = $_POST['prezimeNovogPisca'];
         $zemljaPisca = $_POST['zemljaPisca'];
         $pisac = new Pisac($imePisca, $prezimePisca, $zemljaPisca);
         $pisac->unesiPiscaUBazu($link);
      }
      
      //izmeni imeZanra ako je u pitanju novi zanr
      //kreiraj novi zanr u bazi sa tim imenom
      if($_POST['noviZanr'] != "")
      {
         $imeZanra = $_POST['noviZanr'];
         $zanr = new Zanr($imeZanra);
         if(!$zanr->postojiZanr($link))
           $zanr->unesiZanrUBazu($link);
         else
           echo "Žanr postoji u bazi!".'<br>';
      }

      //uzmi ID pisca sa tim imenom i prezimenom
      $pisacID = Pisac::vratiIdPisca($link, $imePisca, $prezimePisca);
      //uzmi ID zanra sa tim imenom
      $zanrID = Zanr::vratiIdZanra($link, $imeZanra);
      $imeKnjige = $_POST['novaKnjiga'];
      if($imeKnjige == "")
        die();

      //dodavanje knjige
      $knjiga = new Knjiga($imeKnjige, $pisacID, $zanrID);
      if(!$knjiga->postojiKnjiga($link))
        $knjiga->dodajKnjiguUBazu($link);
      else
        echo "Knjiga već postoji u bazi!";     

   }

   //BrisanjeKnjige
   if(isset($_POST['brisanje']))
   {
     $imeKnjige = $_POST['novaKnjiga'];
     $povratniNiz = Citalac::iseciImePrezime($_POST['sviPisci']);
     $imePisca = $povratniNiz['ime'];
     $prezimePisca = $povratniNiz['prezime'];
     $imeZanra = $_POST['sviZanrovi'];

     if($_POST['imeNovogPisca'] != "" || $_POST['prezimeNovogPisca'] != "" ||
     $_POST['zemljaPisca'] != "" || $_POST['noviZanr'] != "")
      {
        die();
      }

     $pisacID = Pisac::vratiIdPisca($link, $imePisca, $prezimePisca);
     $zanrID = Zanr::vratiIdZanra($link, $imeZanra);
    
     $knjigaZaBrisanje = new Knjiga($imeKnjige, $pisacID, $zanrID);
     $knjigaZaBrisanje->izbaciKnjiguIzBaze($link);

     var_dump($_POST);

   }
   //ideje : izlistaj pisce po zemljama, izlistaj knjige po piscima, knjige po zanrovima ...
   
   //izlistaj knjige po piscima
   if(isset($_POST['proveriKnjige']))
   {
      $imePrezimePisca = $_POST['pisci'];
      $niz = Citalac::iseciImePrezime($imePrezimePisca);
      $idPisca = Pisac::vratiIdPisca($link, $niz['ime'], $niz['prezime']);

      echo "<table border=2>";
       echo "<tr>";
         echo "<th>"; echo "Pisac"; echo "</th>";
         echo "<th>"; echo "Naslov knjige"; echo "</th>";
         echo "<th>"; echo "Zanr"; echo "</th>";
       echo "</tr>";
         $rezUpita = Knjiga::vratiKnjigeSpojenoSaZanrom($link);
         while($knjiga = mysqli_fetch_array($rezUpita))
         {
           if($knjiga['pisacID'] == $idPisca)
           {
              echo "<tr>";
                echo "<td>"; echo $niz['ime'].' '.$niz['prezime']; echo "</td>";
                echo "<td>"; echo $knjiga['imeKnjige']; echo "</td>";
                echo "<td>"; echo $knjiga['imeZanra']; echo "</td>";
              echo "</tr>";
           }
         }

      echo "</table>";
   }

   //provera koji pisci dolaze iz koje zemlje
   if(isset($_POST['proveriZemlje']))
   {

      $zemlja = $_POST['zemlje'];
      $rezulUpita = Pisac::vratiSvePisce($link);

      echo "<table border=2>";
      echo "<tr>";
         echo "<th>"; echo "Pisac"; echo "</th>";
         echo "<th>"; echo "Zemlja"; echo "</th>";
       echo "</tr>";

      while($pisac = mysqli_fetch_array($rezulUpita))
      {
          if($pisac['zemljaPorekla'] == $zemlja)
          {
            echo "<tr>";
              echo "<td>"; echo $pisac['imePisca'].' '.$pisac['prezimePisca']; echo "</td>";
              echo "<td>"; echo $pisac['zemljaPorekla']; echo "</td>";
           echo "</tr>";
          }
      }

      echo "</table>";
   }

   //izlistaj knjige po zanru
   if(isset($_POST['proveriZanr']))
   {
     echo "<br>";
     $imeZanra = $_POST['zanrovi'];
     $tabela = Knjiga::vratiKnjigeSpojenoSaZanromSpojenoSaPiscem($link);

     echo "<table border=2>";
     echo "<tr>";
         echo "<th>"; echo "Naslov knjige"; echo "</th>";
         echo "<th>"; echo "Pisac"; echo "</th>";
         echo "<th>"; echo "Zanr"; echo "</th>";
     echo "</tr>";
     
     while($knjiga = mysqli_fetch_array($tabela))
     {
        if($knjiga['imeZanra'] == $imeZanra)
        {
          echo "<tr>";
           echo "<td>"; echo $knjiga['imeKnjige']; echo "</td>";
           echo "<td>"; echo $knjiga['imePisca'].' '.$knjiga['prezimePisca']; echo "</td>";
           echo "<td>"; echo $knjiga['imeZanra']; echo "</td>";
          echo "</tr>";
        }
     }

     echo "</table>";
   }
   

?>

