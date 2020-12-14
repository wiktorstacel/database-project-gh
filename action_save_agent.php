<?php

$a[1] = $_GET["a1"];//imie
$a[2] = $_GET["a2"];//nazwisko
$a[3] = $_GET["a3"];//stanowisko id

$a[1] = htmlentities($a[1], ENT_QUOTES, "UTF-8");
$a[2] = htmlentities($a[2], ENT_QUOTES, "UTF-8");
$a[3] = htmlentities($a[3], ENT_QUOTES, "UTF-8");
        
require_once 'config_db.php';

$a[1] = mysqli_real_escape_string($conn, $a[1]);
$a[2] = mysqli_real_escape_string($conn, $a[2]);
$a[3] = mysqli_real_escape_string($conn, $a[3]);
					
//zapis agenta do bd
echo'<div id="komunikat_field">';
$zapytanie = "INSERT INTO `agenci` (`agent_id`, `imie` , `nazwisko` , `stanowisko_id`, `status`) "
        . "VALUES (DEFAULT,'$a[1]','$a[2]','$a[3]','1')" ;

$result = mysqli_query($conn, $zapytanie);
print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
echo'</div>'; //end of komunikat_field

mysqli_free_result($result);
mysqli_close($conn);

?>