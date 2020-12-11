<?php

$woj = $_GET["woj"];

if($woj == 'x' || $woj == '-wszystkie-' || $woj == '-wybierz-')
{
  $middle = "";
}
else
{
  $middle = " AND w.nazwa='".$woj."'";	
}
$zapy = "SELECT * FROM Miejscowosc m, Wojewodztwo w WHERE m.wojewodztwo_id=w.wojewodztwo_id";

$tanie = " ORDER BY m.nazwa ASC";
$zapytanie = $zapy.$middle.$tanie;
					
require 'config_db.php';	//za�adowanie miejscowosci do listy rozwijanej formularza
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'B�ad zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{ 
    print("<option>".$row[1]."</option>");
}
echo'<option selected="selected">-wszystkie-</option>';	
			
					
					
?>