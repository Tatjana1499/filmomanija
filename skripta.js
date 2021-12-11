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
      document.getElementById("vrstaCl").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("vrstaCl").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("vrstaCl").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("vrstaCl").value != "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("vrstaCl").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("vrstaCl").value != "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value !== "" &&
      document.getElementById("vrstaCl").value != "")
  ) {
    alert("Popuni sva polja za unos korisnika.");
    return;
  }
  if (
    document.getElementById("vrstaCl").value > 3 ||
    document.getElementById("vrstaCl").value == 0
  ) {
    alert("Vrsta članstva mora biti broj:\n 1 (nedeljno)\n 2 (mesečno)\n 3 (godišnje)");
  }
}