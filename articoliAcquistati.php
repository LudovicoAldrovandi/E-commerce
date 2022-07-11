<?php
$toEcho = "";
$acquistiVuoto = true;
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$dati = mysqli_query($mysqli, "SELECT * FROM acquisti, prodotti WHERE acquisti.ID_utente = " . $_GET["ID_utente"] . " AND acquisti.ID_prodotto = prodotti.ID_prodotto") or die("Impossibile eseguire la query");
while ($row = mysqli_fetch_assoc($dati)) {
    $acquistiVuoto = false;
    $toEcho .= "<div class='sezioneCarrello'>
            <img src='" . $row["immagine"] . "' class='immagineCarrello'>
            <div style='float:left; margin-left: 10px; margin-right: 10px;'><p>Nome: " . $row["nome"] . "</p><p>ID Prodotto: " . $row["ID_prodotto"] . "</p></div>
            <div style='float:left; margin-left: 10px; margin-right: 10px;'><p>Prezzo: " . $row["prezzo"] . "</p><p>Categoria: " . $row["categoria"] . "</p></div>
            <p class='dataAcquisti'>".$row["data"]."</P>
            <form method='POST'>
            </form>
        </div>";
}
if ($acquistiVuoto) {
    $toEcho = "<p style='color: rgb(208,208,208);'>Nessun acquisto recente</p>";
}

echo $toEcho;
mysqli_close($mysqli);
