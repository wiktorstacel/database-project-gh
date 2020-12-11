<?php

$id = $_GET["id"];//transakcja_id


require 'config_db.php';

//select transakcji
$result = mysqli_query($conn, "SELECT tranzakcja_id, oferta_id FROM Tranzakcje WHERE tranzakcja_id='".$id."'");
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
$row = mysqli_fetch_array($result, MYSQLI_NUM);
					 
//ustawienie oferty jako aktywnej
$zapytanie = "UPDATE `Oferty` SET `stan` = '1' WHERE `oferta_id` = '$row[1]'";
//print("<b>MySQ2: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL2, odpowiedź serwera: '.mysql_error($conn);}
                                        
//zapis transakci do bd
echo'<div id="komunikat_field">';
$zapytanie = "DELETE FROM `tranzakcje` WHERE `tranzakcje`.`tranzakcja_id` = '$id'" ;
print("<b>MySQL1: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
echo'</div>'; //end of komunikat_field


?>