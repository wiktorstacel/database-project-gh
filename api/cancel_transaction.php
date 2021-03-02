<?php

if(!isset($_POST['id']))
{
    $msg['message']="Błąd danych - nieprawidłowy formularz"; print json_encode($msg);
    exit();
}

$id = htmlentities($_POST["id"], ENT_QUOTES, "UTF-8");//transakcja_id
require_once '../config_db.php';
$id = mysqli_real_escape_string($conn, $id);

$flaga = false;
//select transakcji
$result = mysqli_query($conn, "SELECT tranzakcja_id, oferta_id FROM tranzakcje WHERE tranzakcja_id='$id'");
if($result != TRUE){$msg['message']="Błąd danych - transakcje"; print json_encode($msg);exit();}//echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
$row = mysqli_fetch_array($result, MYSQLI_NUM);
					

$zapytanie = "DELETE FROM `tranzakcje` WHERE `tranzakcja_id` = '$id'" ;
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){$msg['message']="Błąd danych - usuwanie transakcji"; print json_encode($msg);exit();}//echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
else {$msg['message']="Transakcja została usunięta"; print json_encode($msg);$flaga = true;}

//ustawienie oferty jako aktywnej jeśli wykonano popranie anulowanie transakcji
if($flaga == true)
{
$zapytanie = "UPDATE `oferty` SET `stan` = '1' WHERE `oferta_id` = '$row[1]'";
//print("<b>MySQ2: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){$msg['message']="Błąd danych - przywracanie oferty"; print json_encode($msg);}//echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysql_error($conn);}
}

mysqli_close($conn);
?>