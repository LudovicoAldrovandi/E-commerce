<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>SignUp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stile.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <img src="img/ludzon.png" class="logoLogIn" alt="immagine non disponibile">


        <form class="signUp" method="POST">
            <div class="textLogIn"><label>Nome</label><br><input class="inputLogIn" type="text" name="nome" required="Compilami"></div>
            <div class="textLogIn"><label>Cognome</label><br><input class="inputLogIn" type="text" name="cognome" required="Compilami"></div>
            <div class="textLogIn"><label>Via</label><br><input class="inputLogIn" type="text" name="via" required="Compilami"></div>
            <div class="textLogIn"><label>Username</label><br><input class="inputLogIn" type="text" name="user" required="Compilami"></div>
            <div class="textLogIn"><label>Password</label><br><input class="inputLogIn" type="password" name="pass" required="Compilami"></div>
            <button type="submit" class="bottoneStandardCentro">SignUp</button><br>
            <div class="gia"><label>Già registrato?</label> <a href="logIn.php">LogIn</a></div>
        </form>
        <hr style="margin-top: 100px"><a href="index.php">Home page</a>
        
        <div class="bannerNotifica" id="bannerNotifica" >
            <p id="testoNotifica" style="color: white; font-weight: bolder;"></p>
        </div>

        <script>
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
        if ($_POST) {
            $mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
            mysqli_query($mysqli, "INSERT INTO utenti VALUES(null, '" . $_POST["user"] . "', '" . crypt($_POST["pass"],"cryptString") . "', '" . $_POST["via"] . "', '" . $_POST["nome"] . "', '" . $_POST["cognome"] . "', 0);") or die("Impossibile eseguire la query");
            echo "<script>notificaON('Utente registrato.');</script>";
            mysqli_close($mysqli);
        }
        ?>
    </body>
</html>