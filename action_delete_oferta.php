<?php

$id = htmlentities($_GET["id"], ENT_QUOTES, "UTF-8");//oferta_id
require_once 'config_db.php';
$id = mysqli_real_escape_string($conn, $id);

//sprawdzenie czy nie ma transakcji z taką ofertą - jeśli tak usunięcie nie jest możliwe
$result = mysqli_query($conn, "SELECT tranzakcja_id FROM tranzakcje WHERE oferta_id='$id'");
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
//$row = mysqli_fetch_array($result, MYSQLI_NUM);
					 

if(mysqli_fetch_array($result, MYSQLI_NUM)) //ustawienie oferty jako nieaktywnej
{
    echo'<div id="komunikat_field">';
    echo '<br /><h3>NIE MOŻNA USUNĄĆ OFERTY SPRZEDANEJ</h3>';
    echo'</div>'; //end of komunikat_field
}
else //usunięcie oferty, ale tylko wtedy jeśli nie była przedmiotem transakcji
{
    echo'<div id="komunikat_field">';
    $zapytanie = "DELETE FROM oferty WHERE oferta_id = '$id'" ;
    print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
    $result = mysqli_query($conn, $zapytanie);
    if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
    else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
    echo'</div>'; //end of komunikat_field
}

mysqli_close($conn);
?>