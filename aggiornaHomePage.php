<?php

$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$vuoto = true;

if ($_GET["filtroProdotto"] != "") {
    $result = mysqli_query($mysqli, "SELECT * FROM prodotti WHERE nome='" . $_GET["filtroProdotto"] . "'") or die("Impossibile eseguire la query");
} else if ($_GET["filtroCategoria"] != "") {
    $result = mysqli_query($mysqli, "SELECT * FROM prodotti WHERE categoria='" . $_GET["filtroCategoria"] . "'") or die("Impossibile eseguire la query");
} else {
    $result = mysqli_query($mysqli, "SELECT * FROM prodotti") or die("Impossibile eseguire la query");
}



$toEcho = "";

while ($prodotto = mysqli_fetch_assoc($result)) {
    $vuoto = false;

    $toEcho .= "<div class='prodotto'>
                    <img src='" . $prodotto["immagine"] . "' alt='alt' class='imgProdotto'/>
                    <p class='nomeProdotto'>" . $prodotto["nome"] . "</p>
                    <p class='descrizioneProdotto'>" . $prodotto["descrizione"] . "</p>
                    <p class='prezzoProdotto'>" . $prodotto["prezzo"] . "€</p>
                    <form method='POST'><button class='addCart' type='submit' name='addToCart' value='" . $prodotto["ID_prodotto"] . "'>add</button></form>
                  </div>";
}
if ($vuoto) {
    $toEcho = "<p style='color: rgb(208,208,208);'>La ricerca non ha prodotto risultati</p>";
}

echo $toEcho;
mysqli_close($mysqli);
