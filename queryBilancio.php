<?php

$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$statusQuery = 1;

if ($_GET["sceltaBilancio"] == 0) {
    $result = mysqli_query($mysqli, "SELECT bilancio FROM utenti WHERE ID_utente =" . $_GET["idBilancio"]);
    $bilancio = mysqli_fetch_assoc($result)["bilancio"];
    mysqli_query($mysqli, "UPDATE utenti SET bilancio = " . ($_GET["nBilancio"] + $bilancio) . " WHERE ID_utente = " . $_GET["idBilancio"] . "");
} else {
    $result = mysqli_query($mysqli, "SELECT bilancio FROM utenti WHERE ID_utente =" . $_GET["idBilancio"]);
    $bilancio = mysqli_fetch_assoc($result)["bilancio"];
    if ($bilancio <= $_GET["nBilancio"]) {
        mysqli_query($mysqli, "UPDATE utenti SET bilancio = 0 WHERE ID_utente = " . $_GET["idBilancio"] . "");
    } else {
        mysqli_query($mysqli, "UPDATE utenti SET bilancio = " . ($bilancio - $_GET["nBilancio"]) . " WHERE ID_utente = " . $_GET["idBilancio"] . "");
    }
}



echo $statusQuery;
mysqli_close($mysqli);