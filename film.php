<?php include "konekcija.php"?>
<?php include "klase.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Literatura</title>
 
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

  label{
    background-color: #FFFF99;
  }

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
<script>
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous">
</script>
<script src="skripta.js"></script>

</head>
<body>
   <!-- tabela svih knjiga koje postoje u biblioteci -->
   <div id="PrikazSvihKnjiga">
   <p>Ukoliko želite da vidite sve knjige u posedu naše biblioteke, kliknite na
   <a href="sveknjige.php" target="_blank">naše knjige</a>.</p>
   </div>

    <!-- div za prikazSvih -->
   <div id="divZaPrikazSvih" style="display:none">
    <label for="rbPrikaz">Prikaži sve: </label>
    <a href="literatura.php"><input type="submit" value="Potvrdi" name="rbPrikaz" id="rbPrikaz"></a>
   </div>
   <br>

   <!-- forma za dodavanje nove knjige -->
   <div id="FormaDodavanjeKnjige">
   <fieldset>
   <form action="" method="post">
   <label for="">Dodajte novu knjigu: </label><br><br>
   <!-- <p>Dodajte novu knjigu: </p> -->
     <label for="novaKnjiga">Knjiga: </label>
     <input type="text" name="novaKnjiga" id="novaKnjiga">
     <!-- padajuca lista svih pisaca -->
     <label for="sviPisci">Pisac: </label>
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
     <!-- padajuca lista svih zanrova -->
     <label for="sviZanrovi">Zanr: </label>
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
     <!-- dugme za brisanje knjige -->
     <!-- u slucaju da mora da se dodaju novi pisac ili zanr -->
     </label>
     <br><br>
     <label for="">Ukoliko pisac ne postoji u padajućoj listi, dodajte ga ovde: </label><br><br>
     <!-- <p>Ukoliko pisac ne postoji u padajućoj listi, dodajte ga ovde: </p> -->
     <label for="imeNovogPisca">Ime pisca: </label>
     <input type="text" name="imeNovogPisca" id="imeNovogPisca">
     <label for="prezimeNovogPisca">Prezime pisca: </label>
     <input type="text" name="prezimeNovogPisca" id="prezimeNovogPisca">
     <label for="zemljaPisca">Zemlja pisca: </label>
     <input type="text" name="zemljaPisca" id="zemljaPisca">
     <br><br>
     <label for="">Ukoliko žanr ne postoji u padajućoj listi, dodajte ga ovde: </label><br><br>
     <!-- <p>Ukoliko žanr ne postoji u padajućoj listi, dodajte ga ovde: </p> -->
     <label for="noviZanr">Žanr: </label>
     <input type="text" name="noviZanr" id="noviZanr">
     <br>
     <br>
     <!-- dugme za dodavanje knjige -->
     <button type="submit" name="dodavanjeKnjige" onclick="proveriFormuZaKnjige()">Dodaj knjigu</button>
     <button type="submit" name="brisanje" onclick="proveriFormuZaBrisanjeKnjige()">Obriši knjigu</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi1, 'divZaPrikazSvih')">
   </fieldset>
   </div>
   <br>
   
   <div id="FormaListanjeKnjigaPoPiscima">
   <!-- forma za proveru knjiga po piscima -->
   <fieldset>
   <form action="" method="post">
   <label for="">Pogledajte koje knjige imamo u ponudi od strane konkretnog pisca: </label><br><br>
   <!-- <p>Pogledajte koje knjige imamo u ponudi od strane konkretnog pisca: </p> -->
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
     <button type="submit" name="proveriKnjige">Proveri</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi2, 'divZaPrikazSvih')">
   </fieldset>
   </div>
   <br>

   <div id="FormaListanjePisacaPoZemljama">
   <!-- forma za proveru pisaca po zemljama -->
   <fieldset>
   <form action="" method="post">
   <label for="">Proverite koji sve pisci dolaze iz konkretne zemlje: </label><br><br>
   <!-- <p>Proverite koji sve pisci dolaze iz konkretne zemlje: </p> -->
     <label for="zemlje">Zemlja: </label>
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
     <button type="submit" name="proveriZemlje">Proveri</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi3, 'divZaPrikazSvih')">
   </fieldset>
   </div>
   <br>
   
   
   <div id="FormaListanjeKnjigaPoZanrovima">
   <!-- forma za proveru knjiga po zanrovima -->
   <fieldset>
   <form action="" method="post">
   <label for="">Proverite koje sve knjige spadaju u konkretni žanr: </label><br><br>
   <!-- <p>Proverite koje sve knjige spadaju u konkretni žanr: </p> -->
   <label for="zanrovi">Zanr: </label>
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
   <button type="submit" name="proveriZanr">Proveri</button>
   </form>
   <br>
   <input type="submit" value="Rezultat" onclick="skloniBlokove(blokovi4, 'divZaPrikazSvih')">
    </fieldset>
   </div>


   <!-- javascript -->
   <script>
      var blokovi1 = ["PrikazSvihKnjiga", "FormaListanjeKnjigaPoPiscima", 
      "FormaListanjePisacaPoZemljama", "FormaListanjeKnjigaPoZanrovima"];
      
      var blokovi2 = ["PrikazSvihKnjiga", "FormaDodavanjeKnjige", 
      "FormaListanjePisacaPoZemljama", "FormaListanjeKnjigaPoZanrovima"];

      var blokovi3 = ["PrikazSvihKnjiga", "FormaListanjeKnjigaPoPiscima", 
      "FormaDodavanjeKnjige", "FormaListanjeKnjigaPoZanrovima"];

      var blokovi4 = ["PrikazSvihKnjiga", "FormaListanjeKnjigaPoPiscima", 
      "FormaListanjePisacaPoZemljama", "FormaDodavanjeKnjige"];
      
      var sviBlokovi = ["PrikazSvihKnjiga", "FormaDodavanjeKnjige", "FormaListanjeKnjigaPoPiscima", 
      "FormaListanjePisacaPoZemljama", "FormaListanjeKnjigaPoZanrovima"];

   </script>

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

