var a = 1;
/*
function skloniBlokove(nizBlokova, div) {
  for (const blok of nizBlokova) {
    document.getElementById(blok).style.display = "none";
  }
  document.getElementById(div).style.display = "inline";
}

function prikaziBlokove(nizBlokova, div) {
  for (const blok of nizBlokova) {
    document.getElementById(blok).style.display = "inline";
  }
  document.getElementById(div).style.display = "none";
}
*/
function proveriFormuZaKnjige() {
  if (document.getElementById("novaKnjiga").value == "") {
    confirm("Unesi naziv filma.");
    return;
  }

  if (
    (document.getElementById("imeNovogPisca").value != "" &&
      document.getElementById("prezimeNovogPisca").value == "" &&
      document.getElementById("zemljaPisca").value == "") ||
    (document.getElementById("imeNovogPisca").value == "" &&
      document.getElementById("prezimeNovogPisca").value != "" &&
      document.getElementById("zemljaPisca").value == "") ||
    (document.getElementById("imeNovogPisca").value == "" &&
      document.getElementById("prezimeNovogPisca").value == "" &&
      document.getElementById("zemljaPisca").value != "") ||
    (document.getElementById("imeNovogPisca").value != "" &&
      document.getElementById("prezimeNovogPisca").value != "" &&
      document.getElementById("zemljaPisca").value == "") ||
    (document.getElementById("imeNovogPisca").value != "" &&
      document.getElementById("prezimeNovogPisca").value == "" &&
      document.getElementById("zemljaPisca").value != "") ||
    (document.getElementById("imeNovogPisca").value == "" &&
      document.getElementById("prezimeNovogPisca").value != "" &&
      document.getElementById("zemljaPisca").value != "")
  ) {
    alert("Popunite podatke o reditelju.");
  }
}

function proveriFormuZaBrisanjeKnjige() {
  if (
    document.getElementById("imeNovogPisca").value != "" ||
    document.getElementById("prezimeNovogPisca").value != "" ||
    document.getElementById("zemljaPisca").value != "" ||
    document.getElementById("noviZanr").value != ""
  ) {
    alert("Ne možete popunjavati podatke o reditelju ili filmu ako brišete postojeći film.");
  }
}

function proveriFormuZaUnosCitaoca() {
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
/*
function skloniDiv(div) {
  document.getElementById(div).innerHTML = "";
}
*/
/*
function loadText() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "oNama.txt", true);

  xhr.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      document.getElementById("textHaled").innerHTML = this.responseText;
    }
  };

  xhr.send();
}
*/