<?php

$data = json_decode(file_get_contents("php://input"));

if(!isset($data->id) || !isset($data->agent) || !isset($data->client))
{
    $msg['message']="Błąd danych - nieprawidłowy formularz"; print json_encode($msg);exit();
}

$t[1] = htmlentities($data->id);//oferta_id
$t[2] = htmlentities($data->agent);//agent_id
$t[3] = htmlentities($data->client);//klint - string
require_once '../config_db.php';
$t[1] = mysqli_real_escape_string($conn, $t[1]);
$t[2] = mysqli_real_escape_string($conn, $t[2]);
$t[3] = mysqli_real_escape_string($conn, $t[3]);
$flaga = false;	
                                        
//zapis transakci do bd
$zapytanie = "INSERT INTO tranzakcje (tranzakcja_id, oferta_id, agent_id, klient, data) VALUES (DEFAULT,'$t[1]','$t[2]','$t[3]',CURDATE())" ;
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){$msg['message']="Błąd zapisanu danych - transakcja"; print json_encode($msg);exit();}//Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
else {$flaga=true;}


//ustawienie oferty jako nieaktywnej jeśli wykonano poprawnie zapis transakcji
//UWAGA: jeśli nie udało by się zmienić statusu oferty, trzeba by anulować transakcje i zgłosić ogólny błąd z zapisem
//bo inaczej może być transakcja z ofertą, której status pozostał jako aktywny
if($flaga == true)
{
    $zapytanie = "UPDATE `oferty` SET `stan` = '0' WHERE `oferta_id` = '$t[1]'";
    $result = mysqli_query($conn, $zapytanie);
    if($result != TRUE){$msg['message']="Błąd zapisanu danych - oferta"; print json_encode($msg);}//echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysql_error($conn);}
    else{$msg['message']="Dane zapisane poprawnie"; print json_encode($msg);}
}


mysqli_close($conn);
