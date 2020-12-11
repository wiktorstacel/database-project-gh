<?php

$p[0] = $_GET["p0"];//nazwa
$p[1] = $_GET["p1"];//rodzaj
$p[2] = $_GET["p2"];//wojewodztwo
$p[3] = $_GET["p3"];//miejscowosc 
$p[4] = $_GET["p4"];//miejscowoscnew
$p[5] = $_GET["p5"];//ulica
$p[6] = $_GET["p6"];//powierzchnia
$p[7] = $_GET["p7"];//cena
$p[8] = $_GET["p8"];//opis



//sprawdzenie nazwy



require 'config_db.php';
//wstawienie rodzaj_id - nie można dodać nowego rodzaju
$zapytanie1 = "SELECT rodzaj_id FROM Rodzaj WHERE nazwa='".$p[1]."'";
$result = mysqli_query($conn, $zapytanie1);
if($result != TRUE){echo 'Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
            		$row = mysqli_fetch_array($result);
					
					$p[1]=$row["rodzaj_id"];  //id rodzaju do wstawienia w 'oferty'
					print("<b>MySQL1: </b><div id=\"ekran1.1\">".$zapytanie1."</div><div>Odp:".$p[1]."</div>");
					

					
					
					
					
					
//wstawienie wojewodztwo_id - nie można dodać nowego wojewodztwa
$zapytanie2="SELECT wojewodztwo_id FROM Wojewodztwo WHERE nazwa='".$p[2]."'";
$result = mysqli_query($conn, $zapytanie2);
if($result != TRUE){echo 'Bład zapytania MySQL2, odpowiedź serwera: '.mysqli_error($conn);}
            		$row = mysqli_fetch_array($result);
					$p[2]=$row["wojewodztwo_id"]; //id wojewodztwa do wstawienia w 'ofetry'
					print("<b>MySQL2: </b><div id=\"ekran1.2\">".$zapytanie2."</div><div>Odp:".$p[2]."</div>");
					
					
//wstawienie miejscowosc_id
if($p[3] != 'x') //to znaczy że wyboru miejscowosci dokonano  listy, czyli z bd
{
	$zapytanie3="SELECT miejscowosc_id FROM Miejscowosc WHERE nazwa='".$p[3]."'";
	$result = mysqli_query($conn, $zapytanie3);
	if($result != TRUE){echo 'Bład zapytania MySQL3, odpowiedź serwera: '.mysqli_error($conn);}
            		$row = mysqli_fetch_array($result);
					$p[3]=$row["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry'
					print("<b>MySQL3: </b><div id=\"ekran1.3\">".$zapytanie3."</div><div>Odp:".$p[3]."</div>");					
}

//wstawienie nowej miejscowosc a potem miejscowosc_id 
//trzeba sprawdzic, czy podana miejscowosc jest juz w bazie
if($p[4] != 'x')
{
    $zapytanie40="SELECT miejscowosc_id FROM Miejscowosc WHERE nazwa='".$p[4]."'";
    $result = mysqli_query($conn, $zapytanie40);
    if($result != TRUE){echo 'Bład zapytania MySQL4.0, odpowiedź serwera: '.mysqli_error($conn);}
    $exist = mysqli_fetch_array($result);

    if($exist == "")
    {
    $zapytanie41="INSERT INTO `Miejscowosc` VALUES ('','$p[4]','$p[2]')";
    $result = mysqli_query($conn, $zapytanie41);//wstawienie nowej miejscowosci
    if($result != TRUE){echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);}
    print("<b>MySQL4.1: </b><div id=\"ekran1.4.1\">".$zapytanie41."</div>");

    $zapytanie42="SELECT miejscowosc_id FROM Miejscowosc WHERE nazwa='".$p[4]."'";
    $result = mysqli_query($conn, $zapytanie42);
    if($result != TRUE){echo 'Bład zapytania MySQL4.2, odpowiedź serwera: '.mysqli_error($conn);}

    $row = mysqli_fetch_array($result);
    $p[3]=$row["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry' !zapisane w $p[3]
    print("<b>MySQL4.2: </b><div id=\"ekran1.4.2\">".$zapytanie42."</div><div>Odp:".$p[3]."</div>");
    }

    else
    {
      $p[3]=$exist["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry'
      print("<b>MySQL40: </b><div id=\"ekran1.4.0\">".$zapytanie40."</div><div>Odp:".$p[3]."</div>");
    }
}
					
//teraz $p jest tablicą gotowymi danymi do wstawienia
//!tylko p[3] bedzie zapisywane do oferty! patrz: wstawienie id miejscowosci

require 'config_db.php';
$zapytanie = "INSERT INTO `Oferty` ( `nazwa` , `rodzaj_id` , `wojewodztwo_id` , `miejscowosc_id`, `ulica` ,`powierzchnia`,`cena`,`opis`,`oferta_id`) VALUES ( '$p[0]','$p[1]','$p[2]','$p[3]','$p[5]','$p[6]','$p[7]','$p[8]','')" ;

$result = mysqli_query($conn, $zapytanie);

print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
else{echo "<div>Oferta Zapisana</div>";}
	


?>