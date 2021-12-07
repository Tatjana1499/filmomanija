function proveriUnosFilma() {
  if (document.getElementById("nazivFilma").value == "") {
    confirm("Unesi naziv filma.");
    return;
  }
  if (
    (document.getElementById("imeNovogRed").value != "" &&
      document.getElementById("prezimeNovogRed").value == "" &&
      document.getElementById("drzavaRed").value == "") ||
    (document.getElementById("imeNovogRed").value == "" &&
      document.getElementById("prezimeNovogRed").value != "" &&
      document.getElementById("drzavaRed").value == "") ||
    (document.getElementById("imeNovogRed").value == "" &&
      document.getElementById("prezimeNovogRed").value == "" &&
      document.getElementById("drzavaRed").value != "") ||
    (document.getElementById("imeNovogRed").value != "" &&
      document.getElementById("prezimeNovogRed").value != "" &&
      document.getElementById("drzavaRed").value == "") ||
    (document.getElementById("imeNovogRed").value != "" &&
      document.getElementById("prezimeNovogRed").value == "" &&
      document.getElementById("drzavaRed").value != "") ||
    (document.getElementById("imeNovogRed").value == "" &&
      document.getElementById("prezimeNovogRed").value != "" &&
      document.getElementById("drzavaRed").value != "")
  ) {
    alert("Popunite podatke o reditelju.");
  }
}
function proveriBrisanjeFilma() {
  if (
    document.getElementById("imeNovogRed").value != "" ||
    document.getElementById("prezimeNovogRed").value != "" ||
    document.getElementById("drzavaRed").value != "" ||
    document.getElementById("noviZanr").value != ""
  ) {
    alert("Ne možete popunjavati podatke o reditelju ili filmu ako brišete postojeći film.");
  }
}
function proveriUnosKorisnika() {
  if (
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value != "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value != "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value !== "" &&
      document.getElementById("kategorija").value != "")
  ) {
    alert("Popuni sva polja za unos korisnika.");
    return;
  }
  if (
    document.getElementById("kategorija").value > 3 ||
    document.getElementById("kategorija").value == 0
  ) {
    alert("Vrsta članstva mora biti 1, 2 ili 3.");
  }
}