<?php
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
if ($_GET["tabella"] != "") {
    $toEcho = "";
    $vuoto = true;
    $dati = mysqli_query($mysqli, "SELECT * FROM " . $_GET["tabella"] . "") or die("Impossibile eseguire la query");
    while ($tabella = mysqli_fetch_array($dati, MYSQLI_NUM)) {
        $vuoto = false;
        $toEcho .= "<p style='font-size: 15px;'>";
        for ($i = 0; $i < count($tabella); $i++) {
            $toEcho .= $tabella[$i] . " | ";
        }
        $toEcho .= "</p>";
    }
    if ($vuoto) {
        $toEcho = "<p style='color: rgb(208,208,208);'>Tabella Vuota</p>";
    }
} else {
    $toEcho = "No TAB";
}
echo $toEcho;
mysqli_close($mysqli);
