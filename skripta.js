var a = 1;

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

function proveriFormuZaKnjige() {
  if (document.getElementById("novaKnjiga").value == "") {
    confirm("Morate uneti naslov knjige!");
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
    alert("Popunite ispravno podatke pisca!");
  }
}

function proveriFormuZaBrisanjeKnjige() {
  if (
    document.getElementById("imeNovogPisca").value != "" ||
    document.getElementById("prezimeNovogPisca").value != "" ||
    document.getElementById("zemljaPisca").value != "" ||
    document.getElementById("noviZanr").value != ""
  ) {
    alert(
      "Ne smete popunjavati podatke o piscu ili knjizi ukoliko brišete postojeću knjigu!"
    );
  }
}

function proveriFormuZaUnosCitaoca() {
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
    alert("Popuni sva polja.");
    return;
  }
  if (
    document.getElementById("vrstaCl").value > 3 ||
    document.getElementById("vrstaCl").value == 0
  ) {
    alert("Vrsta članstva mora imati vrednost 1, 2 ili 3.");
  }
}

function skloniDiv(div) {
  document.getElementById(div).innerHTML = "";
}

function loadText() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "tekst.txt", true);

  xhr.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      document.getElementById("textHaled").innerHTML = this.responseText;
    }
  };

  xhr.send();
}
