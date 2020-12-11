<?php

$a[1] = $_GET["a1"];//imie
$a[2] = $_GET["a2"];//nazwisko
$a[3] = $_GET["a3"];//stanowisko



require 'config_db.php';
//wstawienie stanowisko_id
$zapytanie1 = "SELECT stanowisko_id FROM Stanowisko WHERE nazwa='".$a[3]."'";
$result = mysqli_query($conn, $zapytanie1);
if($result != TRUE){echo 'Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
    $row = mysqli_fetch_array($result);
					
    $a[3]=$row["stanowisko_id"];  //id stanowiska do wstawienia w 'oferty'
    print("<b>MySQL1: </b><div id=\"ekran1.1\">".$zapytanie1."</div><div>Odp:".$a[3]."</div>");
					
//zapis agenta do bd

$zapytanie = "INSERT INTO `Agenci` (`agent_id`, `imie` , `nazwisko` , `stanowisko_id`, `status`) VALUES ('','$a[1]','$a[2]','$a[3]','1')" ;
print("<b>MySQL1: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}


?>