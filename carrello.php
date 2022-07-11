<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$dati = mysqli_query($mysqli, "SELECT * FROM utenti WHERE ID_utente = " . $_SESSION["ID_utente"] . "") or die("Impossibile eseguire la query");
$row = mysqli_fetch_assoc($dati);
$_SESSION["bilancio"] = $row["bilancio"];
?>
<html>
    <head>
        <title>Carrello</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stile.css" rel="stylesheet" type="text/css">

    </head>
    <body>


        <div class="barraSuperiore">
            <div class="cont">
                <img src="img/ludzon.png" class="logoRicerca" alt="immagine non disponibile">
                <a href="index.php" ><img src="img/back.png" alt="alt" class="backRow"/></a>
                <form method="POST"><button name="clearCart" value="1" class="bottoneStandard" type="submit">Pulisci Carrello</button></form>
                <form method="POST"><button name="clearAcquisti" value="1" class="bottoneStandard" type="submit">Pulisci Acquisti</button></form>
                <form method="POST"><button name="compraTutto" value="1" class="bottoneStandard" type="submit">Compra Tutto</button></form>
                <div class="destraBottoneCarrello"><button class="bottoneStandard" id="logOut" onclick="location.href = 'logOut.php'">LogOut</button></div>

            </div>
        </div>






        <div id="prodottiAcquistati" class="containerCarrello"></div>
        <div id="infoUtente" class="containerCarrelloCentrale"></div>
        <div id="carrello" class="containerCarrello"></div>

        <div class="bannerErrore" id="bannerErrore" >
            <p style="color: black; font-weight: bolder;" id="testoErrore"></p>
        </div>

        <div class="bannerNotifica" id="bannerNotifica" >
            <p id="testoNotifica" style="color: white; font-weight: bolder;"></p>
        </div>
        <script>

            setInterval(aggiornaAcquisti, 250);
            setInterval(aggiornaInfoUtente, 250);
            setInterval(aggiornaCarrello, 250);
            function aggiornaAcquisti() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("prodottiAcquistati").innerHTML = "<h1 style='margin:0;'>ACQUISTI</h1>" + this.responseText;
                    }
                };
                xmlhttp.open("GET", "articoliAcquistati.php?ID_utente=" +<?php echo $_SESSION["ID_utente"]; ?>, true);
                xmlhttp.send();
            }

            function aggiornaInfoUtente() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("infoUtente").innerHTML = "<h1 style='margin:0;'>INFO UTENTE</h1>" + this.responseText;
                    }
                };
                xmlhttp.open("GET", "infoUtente.php?ID_utente=" +<?php echo $_SESSION["ID_utente"]; ?>, true);
                xmlhttp.send();
            }

            function aggiornaCarrello() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("carrello").innerHTML = "<h1 style='margin:0;'>CARRELLO</h1>" + this.responseText;
                    }
                };
                xmlhttp.open("GET", "aggiornaCarrello.php?ID_utente=" +<?php echo $_SESSION["ID_utente"]; ?>, true);
                xmlhttp.send();
            }


            function erroreON(messaggio) {
                var banner = document.getElementById("bannerErrore");
                document.getElementById("testoErrore").innerHTML = messaggio;
                banner.style.display = "block";
                setTimeout(erroreOFF, 3000);
            }
            function erroreOFF() {
                var banner = document.getElementById("bannerErrore");
                banner.style.display = "none";
            }

            function notificaON(messaggio) {
                var banner = document.getElementById("bannerNotifica");
                document.getElementById("testoNotifica").innerHTML = messaggio;
                banner.style.display = "block";
                setTimeout(notificaOFF, 3000);
            }
            function notificaOFF() {
                var banner = document.getElementById("bannerNotifica");
                banner.style.display = "none";
            }

        </script>

        <?php

        if (isset($_POST["bottone"])) {
            if ($_POST["bottone"] == 0) {
                if ($_POST["prezzo"] <= $_SESSION["bilancio"]) {
                    mysqli_query($mysqli, "UPDATE utenti SET bilancio = " . ($_SESSION["bilancio"] - $_POST["prezzo"]) . " WHERE ID_utente = " . $_SESSION["ID_utente"] . ";");
                    echo "<script>document.getElementById(" . $_POST["id"] . ").style.display = 'none';</script>";
                    echo "<script>notificaON('Aquisto andato a buon fine.')</script>";
                    mysqli_query($mysqli, "DELETE FROM carrello WHERE ID_carrello = " . $_POST["IDordine"] . " AND ID_utente =" . $_SESSION["ID_utente"] . "");
                    mysqli_query($mysqli, "INSERT INTO acquisti VALUES(null, " . $_POST["id"] . ", " . $_SESSION["ID_utente"] . ", '" . date('Y-m-d h:i:s a', time()) . "')");
                } else {
                    echo "<script>erroreON('Non hai abbastanza soldi.')</script>";
                }
            } else {
                mysqli_query($mysqli, "DELETE FROM carrello WHERE ID_carrello = " . $_POST["IDordine"] . " AND ID_utente =" . $_SESSION["ID_utente"] . "");
                echo "<script>document.getElementById(" . $_POST["id"] . ").style.display = 'none';</script>";
                echo "<script>erroreON('Prodotto rimosso dal carrello.')</script>";
            }
        }

        if (isset($_POST["clearCart"])) {
            mysqli_query($mysqli, "DELETE FROM carrello WHERE ID_utente =" . $_SESSION["ID_utente"] . "");
            echo "<script>erroreON('Carrello pulito.')</script>";
        }

        if (isset($_POST["clearAcquisti"])) {
            mysqli_query($mysqli, "DELETE FROM acquisti WHERE ID_utente =" . $_SESSION["ID_utente"] . "");
            echo "<script>erroreON('Acquisti puliti.')</script>";
        }

        if (isset($_POST["compraTutto"])) {
            $result = mysqli_query($mysqli, "SELECT SUM(prodotti.prezzo) AS tot FROM carrello, prodotti WHERE carrello.ID_utente = ".$_SESSION["ID_utente"]." AND carrello.ID_prodotto = prodotti.ID_prodotto");
            $prezzoTOT = mysqli_fetch_assoc($result)["tot"];
            if($prezzoTOT <= $_SESSION["bilancio"]){
                $result = mysqli_query($mysqli, "SELECT ID_prodotto, ID_utente FROM carrello WHERE ID_utente =".$_SESSION["ID_utente"]."");
                while ($prodotto = mysqli_fetch_assoc($result)) {
                    mysqli_query($mysqli, "INSERT INTO acquisti VALUES(null, " . $prodotto["ID_prodotto"] . ", " . $_SESSION["ID_utente"] . ", '" . date('Y-m-d h:i:s a', time()) . "')");
                }
                mysqli_query($mysqli, "DELETE FROM carrello WHERE ID_utente = ".$_SESSION["ID_utente"]."");
                mysqli_query($mysqli, "UPDATE utenti SET bilancio = " . ($_SESSION["bilancio"] - $prezzoTOT) . " WHERE ID_utente = " . $_SESSION["ID_utente"] . ";");
                echo "<script>notificaON('Tutto il carrello è stato acquistato correttamente.')</script>";
            }else{
                echo "<script>erroreON('Non hai abbastanza denaro per comprare tutto il carrello.')</script>";
                
            }
            
            
        }
        mysqli_close($mysqli);
        ?>


    </body>
</html>
