<?php

$t[1] = htmlentities($_GET["t1"]);//oferta_id
$t[2] = htmlentities($_GET["t2"]);//agent_id
$t[3] = htmlentities($_GET["t3"]);//klint - string
$flaga = false;

require_once 'config_db.php';	
                                        
//zapis transakci do bd
echo'<div id="komunikat_field">';
$zapytanie = "INSERT INTO tranzakcje (tranzakcja_id, oferta_id, agent_id, klient, data) VALUES (DEFAULT,'$t[1]','$t[2]','$t[3]',CURDATE())" ;
print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';$flaga=true;}
echo'</div>'; //end of komunikat_field

//ustawienie oferty jako nieaktywnej jeśli wykonano poprawnie zapis transakcji
if($flaga == true)
{
$zapytanie = "UPDATE `oferty` SET `stan` = '0' WHERE `oferta_id` = '$t[1]'";
//print("<b>MySQ2: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysql_error($conn);}
}

mysqli_close($conn);
?>