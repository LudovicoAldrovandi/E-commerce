<?php
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$statusQuery = 1;
mysqli_query($mysqli, "INSERT INTO prodotti VALUES(null,'".$_GET["nomeProdotto"]."','".$_GET["dsrcProdotto"]."','".$_GET["categoriaProdotto"]."','".$_GET["imgProdotto"]."', ".$_GET["prezzoProdotto"].")");
echo $statusQuery;
mysqli_close($mysqli);
