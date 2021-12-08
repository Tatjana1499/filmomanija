<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
.obavestenja{
  position: relative;
background-color: purple;
  left: 60%;
 height: 400px;
 text-align: center;
}
.obavestenjeFilm{
  position: fixed;;
   bottom: 450px;
    width: 400px;
    text-align: center;
    background-color: purple;
     color: white;
}
.obavestenjeReditelj{
  position: fixed;;
   bottom: 400px;
    width: 400px;
    text-align: center;
    background-color: purple;
     color: white;
}
.obavestenjeZanr{
  position: fixed;;
   bottom: 350px;
    width: 400px;
    text-align: center;
    background-color: purple;
     color: white;
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
         echo "<h2 class='obavestenja'>Korisnik je dodat.</h2>";
      else
         echo "<h2 class='obavestenja'>Greška, korisnik nije dodat.</h2>"; 
   }
    function postojiUBazi($baza)
    {
       $rez = self::vratiSveKorisnike($baza);
       while($korisnik = mysqli_fetch_array($rez))
       {
         if($korisnik['ime'] == $this->ime &&  $korisnik['prezime'] == $this->prezime)
            return true;
       }
       return false;
     } 
     static function vratiSveKorisnike($baza)
     {
       $sql = "SELECT * FROM korisnik";
       $rez = mysqli_query($baza, $sql);
       return $rez;
     }
     static function vratiIDKorisnika($baza, $ime, $prezime)
     {
        $rez = self::vratiSveKorisnike($baza);
        while($korisnik = mysqli_fetch_array($rez))
        {
          if($korisnik['ime'] == $ime && $korisnik['prezime'] == $prezime)
              return $korisnik['korisnikID'];
        }
        return false;
     }
     static function odvojImePrezime($string)
     {
       $niz = explode(" ", $string);
       $povratniNiz = ['ime' => $niz[0], 'prezime' => $niz[1]];
       return $povratniNiz;
     }
     static function izbaciKorisnika($baza, $korisnikID)
     {
        $sqlUpit = "DELETE FROM korisnik WHERE korisnikID = $korisnikID";
        $rez = mysqli_query($baza, $sqlUpit);
        if($rez)
          echo "<h2 class='obavestenja'>Korisnik je izbačen.</h2>";
        else
          echo "<h2 class='obavestenja'>Greška, korisnik nije izbačen.</h2>";        
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
    static function vratiSveFilmove($baza)
    {
      $sqlUpit = "SELECT * FROM film";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }
    static function vratiIDFilma($baza, $nazivFilma)
    {
      $rez = self::vratiSveFilmove($baza);
      while($film = mysqli_fetch_array($rez))
      {
        if($film['nazivFilma'] == $nazivFilma)
          return $film['filmID'];
      }
      return false;
    }
    function dodajFilm($baza)
    {
      $sqlUpit = "INSERT INTO film(nazivFilma, rediteljID, zanrID) VALUES('$this->nazivFilma', '$this->rediteljID', '$this->zanrID')";
      $rez = mysqli_query($baza, $sqlUpit);
      echo "<div class='obavestenjeFilm'>";
      if($rez)
        echo "<h4>Film je dodat.</h4>";
      else
        echo "<h4>Greška, film nije dodat.</h4>";
      echo "</div>";
    }
    function izbaciFilm($baza)
    {
      $sqlUpit = "DELETE FROM film WHERE nazivFilma = '$this->nazivFilma' AND rediteljID = '$this->rediteljID' AND zanrID = '$this->zanrID'";
      $rez = mysqli_query($baza, $sqlUpit);
      echo "<div class='obavestenjeFilm'>";
      if($rez)
        echo "<h4>Film je obrisan.</h4>";
      else  
        echo "<h4>Greška, film nije obrisan.</h4>";
      echo "</div>";
    }
    function postojiFilm($baza)
    {
      $rez = self::vratiSveFilmove($baza);
      while($film = mysqli_fetch_array($rez))
      {
        if($film['nazivFilma'] == $this->nazivFilma)
        {
            return true;
        }
      }
      return false;
    }
    static function vratiFilmIZanr($baza)
    {
      $sqlUpit = "SELECT * FROM film JOIN zanr USING(zanrID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
    }
    static function vratiFilmIZanrIReditelja($baza)
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
   static function vratiIznajmljivanja($baza)
   {
     $sqlUpit = "SELECT * FROM iznajmljivanje";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   static function vratiKorisnikFilm($baza)
   {
      $sqlUpit = "SELECT * FROM iznajmljivanje i JOIN korisnik k USING(korisnikID) JOIN film f USING(filmID)";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }
   static function vratiKorisnikFilmReditelj($baza)
   {
     $sqlUpit = "SELECT * FROM iznajmljivanje i JOIN korisnik k USING(korisnikID) JOIN film f USING(filmID) JOIN reditelj r USING(rediteljID)";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   static function parKorisnikFilm($baza, $korisnikID, $filmID)
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
   static function ubaciKorisnikaIFilm($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "INSERT INTO iznajmljivanje(korisnikID, filmID) VALUES('$korisnikID', '$filmID')";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h2 class='obavestenja'>Korisnik je iznajmio film.</h2>";
     else
       echo "<h2 class='obavestenja'>Greška, korisnik nije uspeo da iznajmi film.</h2>";
   }
   static function izbaciKorisnikaIFilm($baza, $korisnikID, $filmID)
   {
     $sqlUpit = "DELETE FROM iznajmljivanje WHERE korisnikID = $korisnikID AND filmID = $filmID";
     $rez = mysqli_query($baza, $sqlUpit);
     if($rez)
       echo "<h2 class='obavestenja'>Korisnik je vratio film.</h2>";
     else
       echo "<h2 class='obavestenja'>Greška, korisnik nije uspeo da vrati film.</h2>";
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
   public static function vratiSveReditelje($baza)
   {
      $sqlUpit = "SELECT * FROM reditelj";
      $rez = mysqli_query($baza, $sqlUpit);
      return $rez;
   }
   public static function vratiIDReditelja($baza, $ime, $prezime)
   {
     $rezultatUpita = self::vratiSveReditelje($baza);
     while($reditelj = mysqli_fetch_array($rezultatUpita))
     {
       if($reditelj['imeReditelja'] == $ime && $reditelj['prezimeReditelja'] == $prezime)
            return $reditelj['rediteljID'];
     }
     return false;
   }
   function dodajReditelja($baza)
   {
     $sqlUpit = "INSERT INTO reditelj(imeReditelja, prezimeReditelja, drzava) VALUE ('$this->imeReditelja', '$this->prezimeReditelja', '$this->drzava')";
     $rez = mysqli_query($baza, $sqlUpit);
     echo "<div class='obavestenjeReditelj'>";
     if($rez)
       echo "<h4>Reditelj je dodat.</h4>";
     else
       echo "<h4>Greška, reditelj nije dodat.</h4>";
      echo "</div>";
   }
   static function vratiRazlicitoSveDrzave($baza)
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
     $sqlUpit = "SELECT * FROM zanr";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   public static function vratiRazlicitoSveZanrove($baza)
   {
     $sqlUpit = "SELECT DISTINCT nazivZanra FROM zanr";
     $rez = mysqli_query($baza, $sqlUpit);
     return $rez;
   }
   public static function vratiIDZanra($baza, $nazivZanra)
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
   function dodajZanr($baza)
   {
     $sqlUpit = "INSERT INTO zanr(nazivZanra) VALUES('$this->nazivZanra')";
     $rez = mysqli_query($baza, $sqlUpit);
     echo "<div class='obavestenjeZanr'>";
     if($rez)
       echo "<h4>Žanr je uspešno dodat.</h4>";
     else
       echo "<h4>Došlo je do greške, žanr nije dodat.</h4>";
      echo "</div>";
   }
 }
?>