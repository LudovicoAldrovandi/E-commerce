<?php
$mysqli = mysqli_connect("localhost", "root", "", "e-commerce") or die("Impossibile connettersi al database");
$toEcho = "";
$i = 0;
$result = mysqli_query($mysqli, "SELECT DISTINCT categoria FROM prodotti");
while ($row = mysqli_fetch_assoc($result)) {
    $i++;
    $toEcho .= "<button class='categorie' id='".$i."' value='".$row["categoria"]."' onclick='filtriCategoria(".$i.")'>- ".$row["categoria"]."</button>";
}
echo $toEcho;
mysqli_close($mysqli);
