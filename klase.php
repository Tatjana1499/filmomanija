<?php

 class Citalac
 {
   private $citalacID;
   private $ime;
   private $prezime;
   private $kategorijaClanstvaID;

   public function __construct($ime, $prezime, $kategorijaClanstvaID)
   {
    $this->ime = $ime;
    $this->prezime = $prezime;
    if($kategorijaClanstvaID == 1 || $kategorijaClanstvaID == 2 || $kategorijaClanstvaID == 3)
      $this->kategorijaClanstvaID = $kategorijaClanstvaID;
    else
      die();
   } 

   //upisivanje citaoca u bazu
   function upisiUBazu($baza)
   {
      $sqlUpit = "INSERT INTO citalac(ime, prezime, kategorijaClanstvaID)
      VALUES('$this->ime', '$this->prezime', '$this->kategorijaClanstvaID')";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
         echo "Čitalac je uspešno ubačen u bazu!".'<br>';
      else
         echo "Došlo je do greške prilikom ubacivanja čitaoca!".'<br>'; 
   }

    //da li citalac postoji u bazi
    function postojiUBazi($baza)
    {
       $rez = self::vratiSveCitaoce($baza);
       while($korisnik = mysqli_fetch_array($rez))
       {
         if($korisnik['ime'] == $this->ime &&  $korisnik['prezime'] == $this->prezime)
            return true;
       }
      
       return false;
     } 

    //vracam rezultat select * upita, jer ga imam na dosta mesta
     static function vratiSveCitaoce($baza)
     {
       $sql = "SELECT * FROM citalac";
       $rez = mysqli_query($baza, $sql);
       return $rez;
     }

     //vracam ID citaoca na osnovu imena i prezimena
     static function vratiIDcitaoca($baza, $ime, $prezime)
     {
        $rez = self::vratiSveCitaoce($baza);
        while($citalac = mysqli_fetch_array($rez))
        {
          if($citalac['ime'] == $ime && $citalac['prezime'] == $prezime)
              return $citalac['citalacID'];
        }

        return false;
     }

     //secem ime i prezime na osnovu spojenog imena i prezimena
     static function iseciImePrezime($string)
     {
       $niz = explode(" ", $string);
       $povratniNiz = ['ime' => $niz[0], 'prezime' => $niz[1]];
       return $povratniNiz;
     }

     //izbacivanje citaoca 
     static function izbaciCitaoca($baza, $citalacID)
     {
        $sqlUpit = "DELETE FROM citalac WHERE citalacID = $citalacID";
        $rez = mysqli_query($baza, $sqlUpit);
        if($rez)
          echo "Čitalac je uspešno izbačen!".'<br>';
        else
          echo "Došlo je do greške prilikom izbacivanja!".'<br>';        
     }

 }

 class Knjiga
 {
    private $idKnjige;
    private $imeKnjige;
    private $pisacID;
    private $zanrID;

    public function __construct($imeKnjige, $pisacID, $zanrID)
    {
      $this->imeKnjige = $imeKnjige;
      $this->pisacID = $pisacID;
      $this->zanrID = $zanrID;
    }

    //pravim select * upit jer ce mi cesto trebati
    static function vratiSveKnjige($baza)
    {
      $sqlUpit = "SELECT * FROM knjiga";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }

    static function vratiIDKnjigeNaOsnovuImena($baza, $imeKnjige)
    {
      $rezultatUpita = self::vratiSveKnjige($baza);
      while($knjiga = mysqli_fetch_array($rezultatUpita))
      {
        if($knjiga['imeKnjige'] == $imeKnjige)
          return $knjiga['idKnjige'];
      }

      return false;
    }

    //dodavanje knjige u bazu
    function dodajKnjiguUBazu($baza)
    {
      $sqlUpit = "INSERT INTO knjiga(imeKnjige, pisacID, zanrID)
      VALUES('$this->imeKnjige', '$this->pisacID', '$this->zanrID')";
      $rezultatUpita = mysqli_query($baza, $sqlUpit);
      if($rezultatUpita)
        echo "Knjiga je uspešno dodata u bazu!".'<br>';
      else
        echo "Došlo je do greške prilikom dodavanja knjige!".'<br>';
    }

    //izbacivanje knjige iz baze
    function izbaciKnjiguIzBaze($baza)
    {
      $sqlUpit = "DELETE FROM knjiga WHERE imeKnjige = '$this->imeKnjige'
      AND pisacID = '$this->pisacID' AND zanrID = '$this->zanrID'";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
        echo "Knjiga je uspešno obrisana iz baze!".'<br>';
      else  
        echo "Došlo je do greške prilikom brisanja knjige iz baze!".'<br>';
    }

    function postojiKnjiga($baza)
    {
      $rez = self::vratiSveKnjige($baza);
      while($knjiga = mysqli_fetch_array($rez))
      {
        if($knjiga['imeKnjige'] == $this->imeKnjige)
        {
            return true;
        }
      }
      return false;
    }

    static function vratiKnjigeSpojenoSaZanrom($baza)
    {
      $sqlUpit = "SELECT * FROM knjiga JOIN zanr USING(zanrID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }

    static function vratiKnjigeSpojenoSaZanromSpojenoSaPiscem($baza)
    {
      $sqlUpit = "SELECT * FROM knjiga k JOIN zanr USING(zanrID)
      JOIN pisac USING(pisacID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }

 }

 class UzeoKnjigu
 {
   private $citalacID;
   private  $idKnjige;

   public function __construct($citalacID, $idKnjige)
   {
     $this->citalacID = $citalacID;
     $this->idKnjige = $idKnjige;
   }

   //vracam rezultat select * upita jer mi se dosta puta ponavlja
   static function vratiSvaUzimanja($baza)
   {
     $sqlUpit = "SELECT * FROM uzeoknjigu";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   //vracam rezultat upita spajanja tabele uzeoKnjigu sa tabelama Citalac i Knjiga (tabele na koje ona referise)
   static function vratiSpojenoCitalacKnjiga($baza)
   {
      $sqlUpit = "SELECT * FROM uzeoknjigu u JOIN citalac c USING(citalacID)
      JOIN knjiga k USING(idKnjige)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }

   static function vratiSpojenoCitalacKnjigaPisac($baza)
   {
     $sqlUpit = "SELECT * FROM uzeoKnjigu u JOIN citalac c USING(citalacID)
     JOIN knjiga k USING(idKnjige) JOIN pisac p USING(pisacID)";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   static function postojiParCitalacKnjiga($baza, $citalacID, $idKnjige)
   {
     $sqlUpit = "SELECT * FROM uzeoknjigu";
     $rez = mysqli_query($baza, $sqlUpit);
     while($korisnik = mysqli_fetch_array($rez))
     {
       if($korisnik['citalacID'] == $citalacID && $korisnik['idKnjige'] == $idKnjige)
       {
          return true;
       }
     }
     return false;
   }

   static function ubaciParCitalacKnjigaUBazu($baza, $citalacID, $idKnjige)
   {
     $sqlUpit = "INSERT INTO uzeoKnjigu(citalacID, idKnjige) VALUES('$citalacID', '$idKnjige')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Čitalac je uspešno zadužio knjigu.".'<br>';
     else
       echo "Došlo je do greške prilikom zaduživanja knjiga.".'<br>';
   }

   static function izbaciParCitalacKnjiga($baza, $citalacID, $idKnjige)
   {
     $sqlUpit = "DELETE FROM uzeoKnjigu WHERE citalacID = $citalacID AND idKnjige = $idKnjige";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Čitalac je uspešno razdužio knjigu.".'<br>';
     else
       echo "Došlo je do greške prilikom razduživanja knjige.".'<br>';
   }

 }

 class Pisac 
 {
   private $pisacID;
   private $imePisca;
   private $prezimePisca;
   private $zemljaPorekla;

   public function __construct($imePisca, $prezimePisca, $zemljaPorekla)
   {
     $this->imePisca = $imePisca;
     $this->prezimePisca = $prezimePisca;
     $this->zemljaPorekla = $zemljaPorekla;
   }

   //funkcija koja vraca select * upit iz tabele pisci
   public static function vratiSvePisce($baza)
   {
      $sqlUpit = "SELECT * FROM pisac";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }

   public static function vratiIdPisca($baza, $ime, $prezime)
   {
     $rezultatUpita = self::vratiSvePisce($baza);
     while($pisac = mysqli_fetch_array($rezultatUpita))
     {
       if($pisac['imePisca'] == $ime && $pisac['prezimePisca'] == $prezime)
            return $pisac['pisacID'];
     }
     return false;
   }

   function unesiPiscaUBazu($baza)
   {
     $sqlUpit = "INSERT INTO pisac(imePisca, prezimePisca, zemljaPorekla)
     VALUE ('$this->imePisca', '$this->prezimePisca', '$this->zemljaPorekla')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Pisac je uspešno ubačen u bazu!".'<br>';
     else
       echo "Greška prilikom izvršavanja ubacivanja!".'<br>';
   }

   static function vratiSveZemljeRazlicito($baza)
   {
     $sqlUpit = "SELECT DISTINCT zemljaPorekla FROM pisac";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
 }

 class Zanr
 {
   private $zanrID;
   private $imeZanra;

   public function __construct($imeZanra)
   {
     $this->imeZanra = $imeZanra;
   }

   public static function vratiSveZanrove($baza)
   {
     $sqlUpit = "SELECT * FROM zanr";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   public static function vratiSvaImenaZanrovaRazlicito($baza)
   {
     $sqlUpit = "SELECT DISTINCT imeZanra FROM zanr";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }

   public static function vratiIdZanra($baza, $imeZanra)
   {
     $rezultatUpita = self::vratiSveZanrove($baza);
     while($zanr = mysqli_fetch_array($rezultatUpita))
     {
       if($zanr['imeZanra'] == $imeZanra)
          return $zanr['zanrID'];
     }
     return false;
   }

   function postojiZanr($baza)
   {
     $rez = self::vratiSveZanrove($baza);
     while($zanr = mysqli_fetch_array($rez))
     {
       if($zanr['imeZanra'] == $this->imeZanra)
          return true;
     }

     return false;
   }

   function unesiZanrUBazu($baza)
   {
     $sqlUpit = "INSERT INTO zanr(imeZanra) VALUES('$this->imeZanra')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "Žanr je uspešno unet!".'<br>';
     else
       echo "Došlo je do greške prilikom unosa žanra!".'<br>';
   }
 }
?>


