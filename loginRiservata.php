<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>LogIn riservata</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="stile.css" rel="stylesheet" type="text/css">
    </head>
    <body>

        <img src="img/ludzon.png" class="logoLogIn" alt="immagine non disponibile">


        <form class="logIn" method="POST"> 
            <div class="textLogIn"><label>Username</label><br><input class="inputLogIn" type="text" name="user"></div>
            <div class="textLogIn"><label>Password</label><br><input class="inputLogIn" type="password" name="pass"></div>
            <button type="submit" class="bottoneStandardCentro">LogIn</button><br>
        </form>
        <hr style="margin-top: 100px"><a href="index.php">Home page</a>
        <div class="bannerErrore" id="bannerErrore" >
            <p style="color: black; font-weight: bolder;" id="testoErrore"></p>
        </div>
        <script>
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
        </script>
        <?php
        if ($_POST) {
            $mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
            $result = mysqli_query($mysqli, "SELECT * FROM admin WHERE username ='" . $_POST["user"] . "' AND password = '" . crypt($_POST["pass"],"cryptString") . "'") or die("Impossibile eseguire la query");
            if (($id = mysqli_fetch_assoc($result)) != null) {
                header("location: areaRiservata.php");
            } else {
                echo "<script>erroreON('Inserire tutti i dati correttamente.')</script>";
            }
            mysqli_close($mysqli);
        }
        ?>
    </body>
</html>
