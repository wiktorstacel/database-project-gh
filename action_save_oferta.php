<?php

$p[0] = $_GET["p0"];//nazwa
$p[1] = $_GET["p1"];//rodzaj_id
$p[2] = $_GET["p2"];//wojewodztwo_id
$p[3] = $_GET["p3"];//miejscowosc_id 
$p[4] = $_GET["p4"];//miejscowosc_new
$p[5] = $_GET["p5"];//ulica
$p[6] = $_GET["p6"];//powierzchnia
$p[7] = $_GET["p7"];//cena
$p[8] = $_GET["p8"];//opis

					

//wstawienie nowej miejscowosc a potem miejscowosc_id 
//trzeba sprawdzic, czy podana miejscowosc jest juz w bazie

if($p[4] != 'x')
{
    require 'config_db.php';
    $zapytanie40="SELECT miejscowosc_id FROM Miejscowosc WHERE nazwa='".$p[4]."'";
    $result = mysqli_query($conn, $zapytanie40);
    if($result != TRUE){echo 'Bład zapytania MySQL4.0, odpowiedź serwera: '.mysqli_error($conn);}
    $exist = mysqli_fetch_array($result);

    if($exist == "")
    {
    $zapytanie41="INSERT INTO `Miejscowosc` VALUES ('','$p[4]','$p[2]')";
    $result = mysqli_query($conn, $zapytanie41);//wstawienie nowej miejscowosci
    if($result != TRUE){echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);}
//    print("<b>MySQL4.1: </b><div id=\"ekran1.4.1\">".$zapytanie41."</div>");

    $zapytanie42="SELECT miejscowosc_id FROM Miejscowosc WHERE nazwa='".$p[4]."'";
    $result = mysqli_query($conn, $zapytanie42);
    if($result != TRUE){echo 'Bład zapytania MySQL4.2, odpowiedź serwera: '.mysqli_error($conn);}

    $row = mysqli_fetch_array($result);
    $p[3]=$row["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry' !zapisane w $p[3]
//    print("<b>MySQL4.2: </b><div id=\"ekran1.4.2\">".$zapytanie42."</div><div>Odp:".$p[3]."</div>");
    }

    else
    {
      $p[3]=$exist["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry'
//      print("<b>MySQL40: </b><div id=\"ekran1.4.0\">".$zapytanie40."</div><div>Odp:".$p[3]."</div>");
    }
}
					
//teraz $p jest tablicą gotowymi danymi do wstawienia
//!tylko p[3] bedzie zapisywane do oferty! patrz: wstawienie id miejscowosci

require 'config_db.php';
$zapytanie = "INSERT INTO `Oferty` ( `nazwa` , `rodzaj_id` , `wojewodztwo_id` , `miejscowosc_id`, `ulica` ,`powierzchnia`,`cena`,`opis`,`oferta_id`) VALUES ( '$p[0]','$p[1]','$p[2]','$p[3]','$p[5]','$p[6]','$p[7]','$p[8]','')" ;

echo'<div id="komunikat_field">';
$result = mysqli_query($conn, $zapytanie);
print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
echo'</div>'; //end of komunikat_field
	


?>