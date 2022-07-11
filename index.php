<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
if (isset($_SESSION["ID_utente"])) {
    $dati = mysqli_query($mysqli, "SELECT * FROM utenti WHERE ID_utente = " . $_SESSION["ID_utente"] . "") or die("Impossibile eseguire la query");
    $row = mysqli_fetch_assoc($dati);
    $_SESSION["bilancio"] = $row["bilancio"];
}
?>
<html>
    <head>
        <title>Home page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stile.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="barraSuperiore">
            <div class="cont">
                <img src="img/ludzon.png" class="logoRicerca" alt="immagine non disponibile">
                <div class="infoUser" id="infoUser"><p id="username" style="margin: 0;"></p><p id="bilancio" style="margin: 0;"></p></div>
                <textarea class="barraRicera" placeholder="Cerca qualcosa in ludzon!" rows="1" cols="50" name="ricerca" id="ricerca"></textarea>
                    <button class="inviaRicerca"  onclick="filtriProdotto()"></button>
                <button class="bottoneStandard" id="logIn" onclick="location.href = 'logIn.php'">LogIn</button>
                <button class="bottoneStandard" id="signUp" onclick="location.href = 'singUp.php'">SignUp</button>
                <button class="bottoneStandard" id="riservata" onclick="location.href = 'loginRiservata.php'">Area riservata</button>
                <a href="carrello.php" ><img src="img/carrello.png" class="carrello" id="carrello"></a>
                <button class="bottoneStandard" id="logOut" onclick="location.href = 'logOut.php'">LogOut</button>
                <p class="gitHub">GitHub: https://github.com/LudovicoAldrovandi</p>
            </div>
        </div>
        
        <div id="categoria" style="height: 500px; width: 200px; background-color: black; float: left; color: white">
            
            
        </div>
        
        <div id="aggiornaHomePage" style="position: absolute; left: 10%;"></div>

        <div class="bannerErrore" id="bannerErrore" >
            <p style="color: black; font-weight: bolder;" id="testoErrore"></p>
        </div>

        <div class="bannerNotifica" id="bannerNotifica" >
            <p id="testoNotifica" style="color: white; font-weight: bolder;"></p>
        </div>



        <script>
            var logID = <?php
if (isset($_SESSION["ID_utente"])) {
    echo ($_SESSION["ID_utente"]);
} else {
    echo (0);
}
?>;
            setInterval(aggiornaHomePage, 250);
            setInterval(aggiornaCategoria, 250);
            var button_riservata = document.getElementById("riservata");
            var button_logOut = document.getElementById("logOut");
            var button_signUp = document.getElementById("signUp");
            var button_logIn = document.getElementById("logIn");
            var infoUser = document.getElementById("infoUser");
            var username = document.getElementById("username");
            var bilancio = document.getElementById("bilancio");
            var carrello = document.getElementById("carrello");
            filtroProdotto = "";
            filtroCategoria = "";
            
            function filtriCategoria(id){
                filtroCategoria = document.getElementById(id).value;
            }
            
            function filtriProdotto(){
                filtroProdotto = document.getElementById("ricerca").value;
            }
            
            if (logID === 0)
            {
                button_logOut.style.display = "none";
                button_logIn.style.display = "block";
                button_signUp.style.display = "block";
                button_riservata.style.display = "block";
            } else {
                button_riservata.style.display = "none";
                button_logOut.style.display = "block";
                button_logIn.style.display = "none";
                button_signUp.style.display = "none";
                infoUser.style.display = "block";
                carrello.style.display = "block";
                username.innerHTML = "Ciao, <?php if (isset($_SESSION["username"])){echo ($_SESSION["username"]);} else {echo (0);}?>";
                bilancio.innerHTML = "Conto: <?php if (isset($_SESSION["bilancio"])){echo ($_SESSION["bilancio"]);} else {echo (0);}?>€";


            }
            

                
            
            
            function aggiornaHomePage() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("aggiornaHomePage").innerHTML =  this.responseText;
                    }
                };
                xmlhttp.open("GET", "aggiornaHomePage.php?filtroProdotto="+filtroProdotto+"&filtroCategoria="+filtroCategoria, true);
                xmlhttp.send();
            }
            
            function aggiornaCategoria() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("categoria").innerHTML = "<p style='text-align: center'>FILTRO CATEGORIA</p><button class='categorie' id='0' value='' onclick='filtriCategoria(0)'>- Azzera filtri</button>"+  this.responseText;
                    }
                };
                xmlhttp.open("GET", "aggiornaCategoria.php", true);
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
        if (isset($_POST["addToCart"])) {
            if (isset($_SESSION["ID_utente"]) AND $_SESSION["ID_utente"] != 0) {
                mysqli_query($mysqli, "INSERT INTO carrello VALUES(null, " . $_POST["addToCart"] . ", " . $_SESSION["ID_utente"] . ")");
                echo "<script>notificaON('Prodotto aggiunto al carrello con successo!');</script>";
            } else {
                echo "<script>erroreON('Effettuare prima il LogIn o registrarsi per aggiungere un prodotto al carrello!');</script>";
            }
        }
        mysqli_close($mysqli);
        ?>




    </body>
</html>
