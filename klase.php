<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
h2{
  position: relative;
background-color: purple;
  left: 60%;
 width: 400px;
 text-align: center;
}
h4{
  position: relative;
background-color: purple;
 top:-600px;
 width: 400px;
 text-align: center;
}
</style>
</head>
<body>
</body>
</html>
<?php
 class Korisnik
 {
   private $korisnikID;
   private $ime;
   private $prezime;
   private $vrstaClanstvaID;

   public function __construct($ime, $prezime, $vrstaClanstvaID)
   {
    $this->ime = $ime;
    $this->prezime = $prezime;
    if($vrstaClanstvaID == 1 || $vrstaClanstvaID == 2 || $vrstaClanstvaID == 3)
      $this->vrstaClanstvaID = $vrstaClanstvaID;
    else
      die();
   } 
   function upisiUBazu($baza)
   {
      $sqlUpit = "INSERT INTO korisnik(ime, prezime, vrstaClanstvaID) VALUES('$this->ime', '$this->prezime', '$this->vrstaClanstvaID')";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
         echo "<h2>Korisnik je dodat.</h2>";
      else
         echo "<h2>Greška, korisnik nije dodat.</h2>"; 
   }
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
     static function vratiSveCitaoce($baza)
     {
       $sql = "SELECT * FROM korisnik";
       $rez = mysqli_query($baza, $sql);
       return $rez;
     }
     static function vratiIDcitaoca($baza, $ime, $prezime)
     {
        $rez = self::vratiSveCitaoce($baza);
        while($korisnik = mysqli_fetch_array($rez))
        {
          if($korisnik['ime'] == $ime && $korisnik['prezime'] == $prezime)
              return $korisnik['korisnikID'];
        }
        return false;
     }
     static function iseciImePrezime($string)
     {
       $niz = explode(" ", $string);
       $povratniNiz = ['ime' => $niz[0], 'prezime' => $niz[1]];
       return $povratniNiz;
     }
     static function izbaciCitaoca($baza, $korisnikID)
     {
        $sqlUpit = "DELETE FROM korisnik WHERE korisnikID = $korisnikID";
        $rez = mysqli_query($baza, $sqlUpit);
        if($rez)
          echo "<h2>Korisnik je izbačen.</h2>";
        else
          echo "<h2>Greška, korisnik nije izbačen.</h2>";        
     }
 }
 class Film
 {
    private $filmID;
    private $nazivFilma;
    private $rediteljID;
    private $zanrID;
    public function __construct($nazivFilma, $rediteljID, $zanrID)
    {
      $this->nazivFilma = $nazivFilma;
      $this->rediteljID = $rediteljID;
      $this->zanrID = $zanrID;
    }
    static function vratiSveKnjige($baza)
    {
      $sqlUpit = "SELECT * FROM film";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }
    static function vratiIDKnjigeNaOsnovuImena($baza, $nazivFilma)
    {
      $rez = self::vratiSveKnjige($baza);
      while($film = mysqli_fetch_array($rez))
      {
        if($film['nazivFilma'] == $nazivFilma)
          return $film['filmID'];
      }
      return false;
    }
    function dodajKnjiguUBazu($baza)
    {
      $sqlUpit = "INSERT INTO film(nazivFilma, rediteljID, zanrID) VALUES('$this->nazivFilma', '$this->rediteljID', '$this->zanrID')";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
        echo "<h4>Film je dodat.</h4>";
      else
        echo "<h4>Greška, film nije dodat.</h4>";
    }
    function izbaciKnjiguIzBaze($baza)
    {
      $sqlUpit = "DELETE FROM film WHERE nazivFilma = '$this->nazivFilma' AND rediteljID = '$this->rediteljID' AND zanrID = '$this->zanrID'";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
        echo "<h4>Film je obrisan.</h4>";
      else  
        echo "<h4>Greška, film nije obrisan.</h4>";
    }
    function postojiKnjiga($baza)
    {
      $rez = self::vratiSveKnjige($baza);
      while($film = mysqli_fetch_array($rez))
      {
        if($film['nazivFilma'] == $this->nazivFilma)
        {
            return true;
        }
      }
      return false;
    }
    static function vratiKnjigeSpojenoSaZanrom($baza)
    {
      $sqlUpit = "SELECT * FROM film JOIN zanr USING(zanrID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }
    static function vratiKnjigeSpojenoSaZanromSpojenoSaPiscem($baza)
    {
      $sqlUpit = "SELECT * FROM film f JOIN zanr USING(zanrID) JOIN reditelj USING(rediteljID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }
 }
 class Iznajmljivanje
 {
   private $korisnikID;
   private  $filmID;
   public function __construct($korisnikID, $filmID)
   {
     $this->korisnikID = $korisnikID;
     $this->filmID = $filmID;
   }
   static function vratiSvaUzimanja($baza)
   {
     $sqlUpit = "SELECT * FROM iznajmljivanje";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   static function vratiSpojenoCitalacKnjiga($baza)
   {
      $sqlUpit = "SELECT * FROM iznajmljivanje i JOIN korisnik k USING(korisnikID) JOIN film f USING(filmID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }
   static function vratiSpojenoCitalacKnjigaPisac($baza)
   {
     $sqlUpit = "SELECT * FROM iznajmljivanje i JOIN korisnik k USING(korisnikID) JOIN film f USING(filmID) JOIN reditelj r USING(rediteljID)";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   static function postojiParCitalacKnjiga($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "SELECT * FROM iznajmljivanje";
     $rez = mysqli_query($baza, $sqlUpit);
     while($korisnik = mysqli_fetch_array($rez))
     {
       if($korisnik['korisnikID'] == $korisnikID && $korisnik['filmID'] == $filmID)
       {
          return true;
       }
     }
     return false;
   }
   static function ubaciParCitalacKnjigaUBazu($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "INSERT INTO iznajmljivanje(korisnikID, filmID) VALUES('$korisnikID', '$filmID')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h2>Korisnik je iznajmio film.</h2>";
     else
       echo "<h2>Greška, korisnik nije uspeo da iznajmi film.</h2>";
   }
   static function izbaciParCitalacKnjiga($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "DELETE FROM iznajmljivanje WHERE korisnikID = $korisnikID AND filmID = $filmID";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h2>Korisnik je vratio film.</h2>";
     else
       echo "<h2>Greška, korisnik nije uspeo da vrati film.</h2>";
   }
 }
 class Reditelj 
 {
   private $rediteljID;
   private $imeReditelja;
   private $prezimeReditelja;
   private $drzava;
   public function __construct($imeReditelja, $prezimeReditelja, $drzava)
   {
     $this->imeReditelja = $imeReditelja;
     $this->prezimeReditelja = $prezimeReditelja;
     $this->drzava = $drzava;
   }
   public static function vratiSvePisce($baza)
   {
      $sqlUpit = "SELECT * FROM reditelj";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }
   public static function vratiIdPisca($baza, $ime, $prezime)
   {
     $rezultatUpita = self::vratiSvePisce($baza);
     while($reditelj = mysqli_fetch_array($rezultatUpita))
     {
       if($reditelj['imeReditelja'] == $ime && $reditelj['prezimeReditelja'] == $prezime)
            return $reditelj['rediteljID'];
     }
     return false;
   }
   function unesiPiscaUBazu($baza)
   {
     $sqlUpit = "INSERT INTO reditelj(imeReditelja, prezimeReditelja, drzava) VALUE ('$this->imeReditelja', '$this->prezimeReditelja', '$this->drzava')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h4>Reditelj je dodat.</h4>";
     else
       echo "<h4>Greška, reditelj nije dodat.</h4>";
   }
   static function vratiSveZemljeRazlicito($baza)
   {
     $sqlUpit = "SELECT DISTINCT drzava FROM reditelj";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
 }
 class Zanr
 {
   private $zanrID;
   private $nazivZanra;

   public function __construct($nazivZanra)
   {
     $this->nazivZanra = $nazivZanra;
   }
   public static function vratiSveZanrove($baza)
   {
     $sqlUpit = "SELECT * FROM nazivZanra";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   public static function vratiSvaImenaZanrovaRazlicito($baza)
   {
     $sqlUpit = "SELECT DISTINCT nazivZanra FROM zanr";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   public static function vratiIdZanra($baza, $nazivZanra)
   {
     $rez = self::vratiSveZanrove($baza);
     while($zanr = mysqli_fetch_array($rez))
     {
       if($zanr['nazivZanra'] == $nazivZanra)
          return $zanr['zanrID'];
     }
     return false;
   }
   function postojiZanr($baza)
   {
     $rez = self::vratiSveZanrove($baza);
     while($zanr = mysqli_fetch_array($rez))
     {
       if($zanr['nazivZanra'] == $this->nazivZanra)
          return true;
     }
     return false;
   }
   function unesiZanrUBazu($baza)
   {
     $sqlUpit = "INSERT INTO zanr(nazivZanra) VALUES('$this->nazivZanra')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h4>Žanr je uspešno dodat.</h4>";
     else
       echo "<h4>Došlo je do greške, žanr nije dodat.</h4>";
   }
 }
?>