<?php

//$data = json_decode(file_get_contents("php://input"));
//print_r($data);

if(!isset($_POST['id']))
{
    $msg['message']="Błąd danych - nieprawidłowy formularz"; print json_encode($msg);
    exit();
}

$id = htmlentities($_POST['id'], ENT_QUOTES, "UTF-8");//oferta_id
require_once '../config_db.php';
$id = mysqli_real_escape_string($conn, $id);

//sprawdzenie czy nie ma transakcji z taką ofertą - jeśli tak usunięcie nie jest możliwe
$result = mysqli_query($conn, "SELECT tranzakcja_id FROM tranzakcje WHERE oferta_id='$id'");
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
//$row = mysqli_fetch_array($result, MYSQLI_NUM);
					 

if(mysqli_fetch_array($result, MYSQLI_NUM)) //ustawienie oferty jako nieaktywnej
{
    $msg['message']="Błąd danych - nie można usunąć oferty sprzedanej"; print json_encode($msg);
    exit();
}
else //usunięcie oferty, ale tylko wtedy jeśli nie była przedmiotem transakcji
{
    $zapytanie = "DELETE FROM oferty WHERE oferta_id = '$id'" ;
    $result = mysqli_query($conn, $zapytanie);
    if($result != TRUE){$msg['message']="Błąd danych - usuwanie oferty"; print json_encode($msg);}//Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
    else {$msg['message']="Oferta została usunięta"; print json_encode($msg);}
}

mysqli_close($conn);
?>