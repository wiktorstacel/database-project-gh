<?php

$t[1] = $_GET["t1"];//oferta_id
$t[2] = $_GET["t2"];//agent_id
$t[3] = $_GET["t3"];//klint - string


  require 'config_db.php';	
					 
//ustawienie oferty jako nieaktywnej
$zapytanie = "UPDATE `Oferty` SET `stan` = '0' WHERE `oferta_id` = '$t[1]'";
//print("<b>MySQ2: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL2, odpowiedź serwera: '.mysql_error($conn);}
                                        
//zapis transakci do bd
echo'<div id="komunikat_field">';
$zapytanie = "INSERT INTO `Tranzakcje` ( `tranzakcja_id` , `oferta_id` , `agent_id` , `klient`, `data`) VALUES ( '','$t[1]','$t[2]','$t[3]',CURDATE())" ;
print("<b>MySQL1: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
echo'</div>'; //end of komunikat_field


?>