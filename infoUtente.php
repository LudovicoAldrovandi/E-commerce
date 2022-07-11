<?php
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$dati = mysqli_query($mysqli, "SELECT * FROM utenti WHERE ID_utente = " . $_GET["ID_utente"] . "") or die("Impossibile eseguire la query");
$row = mysqli_fetch_assoc($dati);
echo "<p style='font-weight: bold; margin: 0; margin-top: 20px;'>Indirizzo di spedizione</p><p style='margin:0;'>".$row["indirizzo"]."</p>
      <p style='font-weight: bold; margin: 0; margin-top: 20px;'>ID Utente</p><p style='margin:0;'>".$row["ID_utente"]."</p>
      <p style='font-weight: bold; margin: 0; margin-top: 20px;'>Nome</p><p style='margin:0;'>".$row["nome"]."</p>
      <p style='font-weight: bold; margin: 0; margin-top: 20px;'>Cognome</p><p style='margin:0;'>".$row["cognome"]."</p>
      <p style='font-weight: bold; margin: 0; margin-top: 20px;'>Username</p><p style='margin:0;'>".$row["username"]."</p>
      <p style='font-weight: bold; margin: 0; margin-top: 20px;'>Password</p><p style='margin:0;'>".$row["password"]."</p>
      <p style='font-weight: bold; margin: 0; margin-top: 20px;'>Bilancio</p><p style='margin:0; color:red;'>".$row["bilancio"]."</p>
";
mysqli_close($mysqli);
