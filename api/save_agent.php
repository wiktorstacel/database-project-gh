<?php

$data = json_decode(file_get_contents("php://input"));
//print_r($data);

if(!isset($data->name) || !isset($data->surname) || !isset($data->position))
{
    $msg['message']="Błąd danych - nieprawidłowy formularz"; print json_encode($msg);
    exit();
}

$a[1] = htmlentities($data->name, ENT_QUOTES, "UTF-8");//imie
$a[2] = htmlentities($data->surname, ENT_QUOTES, "UTF-8");//nazwisko
$a[3] = htmlentities($data->position, ENT_QUOTES, "UTF-8");//stanowisko id
require_once '../config_db.php';
$a[1] = mysqli_real_escape_string($conn, $a[1]);
$a[2] = mysqli_real_escape_string($conn, $a[2]);
$a[3] = mysqli_real_escape_string($conn, $a[3]);
					
//zapis agenta do bd
$zapytanie = "INSERT INTO `agenci` (`agent_id`, `imie` , `nazwisko` , `stanowisko_id`, `status`) "
        . "VALUES (DEFAULT,'$a[1]','$a[2]','$a[3]','1')" ;

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){$msg['message']="Błąd zapisu danych - agent"; print json_encode($msg);}//Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
else {$msg['message']="Dane zapisane poprawnie"; print json_encode($msg);}

mysqli_close($conn);

?>