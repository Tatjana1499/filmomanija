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
      $sqlUpit = "INSERT INTO citalac(ime, prezime, kategorijaClanstvaID) VALUES('$this->ime', '$this->prezime', '$this->vrstaClanstvaID')";
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
       $sql = "SELECT * FROM citalac";
       $rez = mysqli_query($baza, $sql);
       return $rez;
     }
     static function vratiIDcitaoca($baza, $ime, $prezime)
     {
        $rez = self::vratiSveCitaoce($baza);
        while($korisnik = mysqli_fetch_array($rez))
        {
          if($korisnik['ime'] == $ime && $korisnik['prezime'] == $prezime)
              return $korisnik['citalacID'];
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
        $sqlUpit = "DELETE FROM citalac WHERE citalacID = $korisnikID";
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
      $sqlUpit = "SELECT * FROM knjiga";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }
    static function vratiIDKnjigeNaOsnovuImena($baza, $nazivFilma)
    {
      $rez = self::vratiSveKnjige($baza);
      while($film = mysqli_fetch_array($rez))
      {
        if($film['imeKnjige'] == $nazivFilma)
          return $film['idKnjige'];
      }
      return false;
    }
    function dodajKnjiguUBazu($baza)
    {
      $sqlUpit = "INSERT INTO knjiga(imeKnjige, pisacID, zanrID) VALUES('$this->nazivFilma', '$this->rediteljID', '$this->zanrID')";
      $rez = mysqli_query($baza, $sqlUpit);
      if($rez)
        echo "<h4>Film je dodat.</h4>";
      else
        echo "<h4>Greška, film nije dodat.</h4>";
    }
    function izbaciKnjiguIzBaze($baza)
    {
      $sqlUpit = "DELETE FROM knjiga WHERE imeKnjige = '$this->nazivFilma' AND pisacID = '$this->rediteljID' AND zanrID = '$this->zanrID'";
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
        if($film['imeKnjige'] == $this->nazivFilma)
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
      $sqlUpit = "SELECT * FROM knjiga k JOIN zanr USING(zanrID) JOIN pisac USING(pisacID)";
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
     $sqlUpit = "SELECT * FROM uzeoknjigu";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   static function vratiSpojenoCitalacKnjiga($baza)
   {
      $sqlUpit = "SELECT * FROM uzeoknjigu u JOIN citalac c USING(citalacID) JOIN knjiga k USING(idKnjige)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }
   static function vratiSpojenoCitalacKnjigaPisac($baza)
   {
     $sqlUpit = "SELECT * FROM uzeoKnjigu u JOIN citalac c USING(citalacID) JOIN knjiga k USING(idKnjige) JOIN pisac p USING(pisacID)";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   static function postojiParCitalacKnjiga($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "SELECT * FROM uzeoknjigu";
     $rez = mysqli_query($baza, $sqlUpit);
     while($korisnik = mysqli_fetch_array($rez))
     {
       if($korisnik['citalacID'] == $korisnikID && $korisnik['idKnjige'] == $filmID)
       {
          return true;
       }
     }
     return false;
   }
   static function ubaciParCitalacKnjigaUBazu($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "INSERT INTO uzeoKnjigu(citalacID, idKnjige) VALUES('$korisnikID', '$filmID')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h2>Korisnik je iznajmio film.</h2>";
     else
       echo "<h2>Greška, korisnik nije uspeo da iznajmi film.</h2>";
   }
   static function izbaciParCitalacKnjiga($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "DELETE FROM uzeoKnjigu WHERE citalacID = $korisnikID AND idKnjige = $filmID";
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
      $sqlUpit = "SELECT * FROM pisac";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }
   public static function vratiIdPisca($baza, $ime, $prezime)
   {
     $rezultatUpita = self::vratiSvePisce($baza);
     while($reditelj = mysqli_fetch_array($rezultatUpita))
     {
       if($reditelj['imePisca'] == $ime && $reditelj['prezimePisca'] == $prezime)
            return $reditelj['pisacID'];
     }
     return false;
   }
   function unesiPiscaUBazu($baza)
   {
     $sqlUpit = "INSERT INTO pisac(imePisca, prezimePisca, zemljaPorekla)
     VALUE ('$this->imeReditelja', '$this->prezimeReditelja', '$this->drzava')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h4>Reditelj je dodat.</h4>";
     else
       echo "<h4>Greška, reditelj nije dodat.</h4>";
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
   private $nazivZanra;

   public function __construct($nazivZanra)
   {
     $this->nazivZanra = $nazivZanra;
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
   public static function vratiIdZanra($baza, $nazivZanra)
   {
     $rez = self::vratiSveZanrove($baza);
     while($zanr = mysqli_fetch_array($rez))
     {
       if($zanr['imeZanra'] == $nazivZanra)
          return $zanr['zanrID'];
     }
     return false;
   }
   function postojiZanr($baza)
   {
     $rez = self::vratiSveZanrove($baza);
     while($zanr = mysqli_fetch_array($rez))
     {
       if($zanr['imeZanra'] == $this->nazivZanra)
          return true;
     }
     return false;
   }
   function unesiZanrUBazu($baza)
   {
     $sqlUpit = "INSERT INTO zanr(imeZanra) VALUES('$this->nazivZanra')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h4>Žanr je uspešno dodat.</h4>";
     else
       echo "<h4>Došlo je do greške, žanr nije dodat.</h4>";
   }
 }
?>