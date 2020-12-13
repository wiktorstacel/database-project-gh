<?php

$id = htmlentities($_GET["id"]);//transakcja_id
$flaga = 0;

require 'config_db.php';

//select transakcji
$result = mysqli_query($conn, "SELECT tranzakcja_id, oferta_id FROM tranzakcje WHERE tranzakcja_id='".$id."'");
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
$row = mysqli_fetch_array($result, MYSQLI_NUM);
					
                                        
//delete transakci z bd
echo'<div id="komunikat_field">';
$zapytanie = "DELETE FROM `tranzakcje` WHERE `tranzakcja_id` = '$id'" ;
print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';$flaga = 1;}
echo'</div>'; //end of komunikat_field

//ustawienie oferty jako aktywnej jeśli wykonano popranie anulowanie transakcji
if($flaga == 1)
{
$zapytanie = "UPDATE `oferty` SET `stan` = '1' WHERE `oferta_id` = '$row[1]'";
//print("<b>MySQ2: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysql_error($conn);}
}
?>