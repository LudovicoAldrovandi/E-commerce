<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stile.css" rel="stylesheet" type="text/css">
        <title>Area riservata</title>
    </head>
    <body>
        <div class="barraSuperiore">
            <div class="cont">
                <img src="img/ludzon.png" class="logoRicerca" alt="immagine non disponibile">
                <p class="didascaliaRiservata" >AREA RISERVATA</p>
                <div style="position: absolute;left: 100%;transform: translateX(-100%);"><a href="index.php" ><img src="img/back.png" alt="alt" class="backRow"/></a></div>
            </div>
        </div>


        <div style="float: left; width: 50%">
            <div style="border: 0px; height: 100px;">
                <h1 style='margin:0; text-align: center;'>Visualizzatore tabelle</h1>
                <div style="position: relative; margin: 10px;">
                    <div style="position: absolute; top: 50%; transform: translateY(50%);">
                        <p style="float: left; margin: 0; padding: 0; font-size: 20px;">Nome tabella: </p>
                        <select id="nomeTabella" style="width: 120px; height: 20px">
                            <?php
                            $mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
                            $result = mysqli_query($mysqli, "SHOW TABLES");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["Tables_in_e-commerce"] . "'>" . $row["Tables_in_e-commerce"] . "</option>";
                            }
                            mysqli_close($mysqli);
                            ?>
                        </select>
                        <button onclick="tabellaNome('nomeTabella')">visualizza</button>
                    </div>
                </div>
            </div>
            <div id="tabella" style="border: 1px solid; border-right: 0px; height: auto;"></div>
        </div>



        <div class="containerQuery" >
            <div class="centraTutto">
                <h1 class="testoQuery">Query rapide</h1>

                <div class="sezioneQuery">
                    <p class="ambitoQuery">bilancio</p>
                    <div class="query">
                        <div class="centro">
                            <input id="idBilancio" placeholder="ID" class="formQueryID">
                            <input id="nBilancio" type="number" step="0.01" placeholder="NUMERO" class="formQueryNumero">
                            <button class="bottoneQuery" type="submit" onclick="queryBilancio(0)">Aggiungi</button>
                            <button class="bottoneQuery" type="submit" onclick="queryBilancio(1)">Sottrai</button>
                        </div>
                    </div>
                </div>

                <div class="sezioneQuery">
                    <p class="ambitoQuery">Prodotto</p>
                    <div class="query">
                        <div class="centro">
                            <input id="idProdotto" placeholder="ID" class="formQueryID">
                            <input id="prezzoProdotto" type="number" step="0.01" placeholder="PREZZO" class="formQueryNumero">
                            <button class="bottoneQuery" type="submit" onclick="queryProdottoPrezzo()">Aggiorna</button>

                            <input id="idProdottoNome" placeholder="ID" class="formQueryID">
                            <input id="nomeProdotto" maxlength="10" type="text" placeholder="NOME" class="formQueryNumero">
                            <button class="bottoneQuery" type="submit" onclick="queryProdottoNome()">Aggiorna</button>
                        </div>
                    </div>
                </div>

                <div class="sezioneQuery">
                    <div class="query">
                        <div class="centro">
                            <input id="idProdottoDescrizione" placeholder="ID" class="formQueryID">
                            <input id="dsrcProdotto" maxlength="40" type="text" placeholder="DESCR." class="formQueryNumero">
                            <button class="bottoneQuery" type="submit" onclick="queryProdottoDescrizione()">Aggiorna</button>

                            <input id="idProdottoCategoria" placeholder="ID" class="formQueryID">
                            <input id="categoriaProdotto" maxlength="20" type="text" placeholder="CATEG." class="formQueryNumero">
                            <button class="bottoneQuery" type="submit" onclick="queryProdottoCategoria()">Aggiorna</button>
                        </div>
                    </div>
                </div>

                <div class="sezioneQuery">
                    <div class="query">
                        <div class="centro">
                            <input id="nomeProdottoNuovo" maxlength="10" type="text" placeholder="NOME" class="formQueryNumero">
                            <input id="dsrcProdottoNuovo" maxlength="40" type="text" placeholder="DSRC." class="formQueryNumero">
                            <input id="categoriaProdottoNuovo" maxlength="20" type="text" placeholder="CATEG." class="formQueryNumero">
                            <input id="imgProdottoNuovo" maxlength="50" type="text" placeholder="img/nome.png" class="formQueryNumero">
                            <input id="prezzoProdottoNuovo" type="number" step="0.01" placeholder="PREZZO" class="formQueryNumero">
                            <button class="bottoneQuery" type="submit" onclick="queryProdottoNuovo()">Aggiungi</button>
                        </div>
                    </div>
                </div>

                <div class="sezioneQuery">
                    <div class="query">
                        <div class="centro">
                            <input id="idProdottoElimina" placeholder="ID" class="formQueryID">
                            <button class="bottoneQuery" type="submit" onclick="queryProdottoElimina()">Rimuovi</button>
                        </div>
                    </div>
                </div>



            </div>
        </div>




        <div class="bannerNotifica" id="bannerNotifica" >
            <p id="testoNotifica" style="color: white; font-weight: bolder;"></p>
        </div>

        <div class="bannerErrore" id="bannerErrore" >
            <p style="color: black; font-weight: bolder;" id="testoErrore"></p>
        </div>

        <script>
            setInterval(aggiornaTabella, 250);
            nomeTabella = "";


            function tabellaNome(tabella) {
                nomeTabella = document.getElementById(tabella).value;
            }

            function aggiornaTabella() {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("tabella").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "visualizzatoreTabelle.php?tabella=" + nomeTabella, true);
                xmlhttp.send();
            }

            function queryProdottoNuovo() {
                nomeProdottoNuovo = document.getElementById("nomeProdottoNuovo").value;
                dsrcProdottoNuovo = document.getElementById("dsrcProdottoNuovo").value;
                categoriaProdottoNuovo = document.getElementById("categoriaProdottoNuovo").value;
                imgProdottoNuovo = document.getElementById("imgProdottoNuovo").value;
                prezzoProdottoNuovo = document.getElementById("prezzoProdottoNuovo").value;

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON("Query non andata a buon fine.")
                        }
                    }
                };
                xmlhttp.open("GET", "queryProdottoNuovo.php?nomeProdotto=" + nomeProdottoNuovo + "&dsrcProdotto=" + dsrcProdottoNuovo + "&categoriaProdotto=" + categoriaProdottoNuovo + "&imgProdotto=" + imgProdottoNuovo + "&prezzoProdotto=" + prezzoProdottoNuovo, true);
                xmlhttp.send();
            }

            function queryProdottoElimina() {

                idProdottoElimina = document.getElementById("idProdottoElimina").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON("Query non andata a buon fine.")
                        }
                    }
                };
                xmlhttp.open("GET", "queryProdottoElimina.php?idProdotto=" + idProdottoElimina, true);
                xmlhttp.send();
            }

            function queryBilancio(sceltaBilancio) {
                nBilancio = document.getElementById("nBilancio").value;
                idBilancio = document.getElementById("idBilancio").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON("Query non andata a buon fine.")
                        }
                    }
                };
                xmlhttp.open("GET", "queryBilancio.php?nBilancio=" + nBilancio + "&idBilancio=" + idBilancio + "&sceltaBilancio=" + sceltaBilancio, true);
                xmlhttp.send();
            }

            function queryProdottoPrezzo() {
                prezzoProdotto = document.getElementById("prezzoProdotto").value;
                idProdotto = document.getElementById("idProdotto").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON("Query non andata a buon fine.")
                        }
                    }
                };
                xmlhttp.open("GET", "queryProdottoPrezzo.php?prezzoProdotto=" + prezzoProdotto + "&idProdotto=" + idProdotto, true);
                xmlhttp.send();
            }

            function queryProdottoNome() {
                idProdottoNome = document.getElementById("idProdottoNome").value;
                nomeProdotto = document.getElementById("nomeProdotto").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON("Query non andata a buon fine.")
                        }
                    }
                };
                xmlhttp.open("GET", "queryProdottoNome.php?nomeProdotto=" + nomeProdotto + "&idProdotto=" + idProdottoNome, true);
                xmlhttp.send();
            }
            function queryProdottoDescrizione() {
                idProdottoDescrizione = document.getElementById("idProdottoDescrizione").value;
                dsrcProdotto = document.getElementById("dsrcProdotto").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON("Query non andata a buon fine.")
                        }
                    }
                };
                xmlhttp.open("GET", "queryProdottoDescrizione.php?dsrcProdotto=" + dsrcProdotto + "&idProdotto=" + idProdottoDescrizione, true);
                xmlhttp.send();
            }

            function queryProdottoCategoria() {
                idProdottoCategoria = document.getElementById("idProdottoCategoria").value;
                categoriaProdotto = document.getElementById("categoriaProdotto").value;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText) {
                            notificaON('Query eseguita correttamente.');
                        } else {
                            erroreON();
                        }
                    }
                };
                xmlhttp.open("GET", "queryProdottoCategoria.php?categoriaProdotto=" + categoriaProdotto + "&idProdotto=" + idProdottoCategoria, true);
                xmlhttp.send();
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
    </body>
</html>
