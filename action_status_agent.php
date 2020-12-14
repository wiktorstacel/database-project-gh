<?php

$a[1] = htmlentities($_GET["m"]);//id
$a[2] = htmlentities($_GET["status"]);//status

require_once 'config_db.php';				
//zapis agenta do bd - zmiana statusu na przeciwny do tego, w jakim przyszedł

if($a[2] == 0) //status
{
    $zapytanie =  "UPDATE `agencik` SET `status`='1' WHERE `agent_id`='$a[1]'";
}
else if($a[2] == 1)
{
    $zapytanie =  "UPDATE `agencik` SET `status`='0' WHERE `agent_id`='$a[1]'";
}
echo'<div id="komunikat_field">';
print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL, odpowiedź serwera: <br />'.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
echo'</div>'; //end of komunikat_field

?>