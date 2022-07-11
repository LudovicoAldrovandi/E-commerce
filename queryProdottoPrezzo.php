<?php
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$statusQuery = 1;
mysqli_query($mysqli, "UPDATE prodotti SET prezzo = ".$_GET["prezzoProdotto"]." WHERE ID_prodotto = ".$_GET["idProdotto"]."");
echo $statusQuery;
mysqli_close($mysqli);

