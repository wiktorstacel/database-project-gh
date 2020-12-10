<?php

$a[1] = $_GET["m"];//id

require 'config_db.php';				
//zapis agenta do bd - zmiana statusu na zwolniony/nieaktywny

$zapytanie =  "UPDATE `agenci` SET `status`='1' WHERE `agent_id`='".$a[1]."'";
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}


?>