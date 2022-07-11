<?php
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$toEcho = "";
$result = mysqli_query($mysqli, "SELECT * FROM carrello, prodotti WHERE carrello.ID_utente = " . $_GET["ID_utente"] . " AND carrello.ID_prodotto = prodotti.ID_prodotto");
$carrelloVuoto = true;
while ($row = mysqli_fetch_assoc($result)) {
    $carrelloVuoto = false;
    $buy = "img/buy.png";
    $remove = "img/remove.png";
    $toEcho .= "      
        <div id='" . $row["ID_prodotto"] . "' class='sezioneCarrello'>
            <img src='" . $row["immagine"] . "' class='immagineCarrello'>
            <div style='float:left; margin-left: 10px; margin-right: 10px;'><p>Nome: " . $row["nome"] . "</p><p>ID Prodotto: " . $row["ID_prodotto"] . "</p></div>
            <div style='float:left; margin-left: 10px; margin-right: 10px;'><p>Prezzo: " . $row["prezzo"] . "</p><p>Categoria: " . $row["categoria"] . "</p></div>
            <form method='POST'>
                <input type='hidden' name='id' value='" . $row["ID_prodotto"] . "' />
                <input type='hidden' name='prezzo' value='" . $row["prezzo"] . "'/>
                <input type='hidden' name='IDordine' value='" . $row["ID_carrello"] . "'/>
                <div class='containerBottoniCarrello'>
                    <button type='submit' name='bottone' value='0' style='background-image: url(" . $buy . "); border-color: yellowgreen;' class='bottoneCarrello'></button>
                    <button type='submit' name='bottone' value='1' style='background-image: url(" . $remove . "); border-color: red;' class='bottoneCarrello'></button>
                </div>
            </form>
        </div>
        ";
}
if ($carrelloVuoto) {
    $toEcho = "<p style='color: rgb(208,208,208);'>Carrello vuoto</p>";
}
echo $toEcho;
mysqli_close($mysqli);
