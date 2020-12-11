<?php

$a[1] = $_GET["m"];//id
$a[2] = $_GET["status"];//status

require 'config_db.php';				
//zapis agenta do bd - zmiana statusu na przeciwny do tego, w jakim przyszedł

if($a[2] == 0) //status
{
    $zapytanie =  "UPDATE `agenci` SET `status`='1' WHERE `agent_id`='".$a[1]."'";
}
else if($a[2] == 1)
{
    $zapytanie =  "UPDATE `agenci` SET `status`='0' WHERE `agent_id`='".$a[1]."'";
}
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}


?>