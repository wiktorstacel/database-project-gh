<?php

$a[1] = htmlentities($_POST["id"], ENT_QUOTES, "UTF-8");
//$a[2] = htmlentities($_GET["status"], ENT_QUOTES, "UTF-8");
require_once '../config_db.php';	
$a[1] = mysqli_real_escape_string($conn, $a[1]);
//$a[2] = mysqli_real_escape_string($conn, $a[2]);

//zapis agenta do bd - zmiana statusu na przeciwny do tego, w jakim przyszedł
$zapytanie =  "UPDATE `agenci` SET `status`= NOT status WHERE `agent_id`='$a[1]'";

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){$msg['message']="Błąd danych - usuwanie transakcji"; print json_encode($msg);exit();}//Bład zapytania MySQL, odpowiedź serwera: <br />'.mysqli_error($conn);}
else {$msg['message']="Status pracownika został zmieniony"; print json_encode($msg);}

//mysqli_free_result($result);
mysqli_close($conn);
?>