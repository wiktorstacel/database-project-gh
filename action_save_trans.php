<?php

$t[1] = $_GET["t1"];//nazwa adres mix
$t[2] = $_GET["t2"];//agent mix
$t[3] = $_GET["t3"];//klint - string




//filtracja oferty_id z przeslanej nazwy

  $zapytanie = "SELECT * FROM Oferty";
  require 'config_db.php';	//załadowanie miejscowosci do listy rozwijanej formularza
  $result = mysqli_query($conn, $zapytanie);
  if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
            		
            		while($row = mysqli_fetch_array($result,MYSQLI_NUM))
					{
					    if(preg_match(sprintf("/%s/", "idoferty:".$row[8]), sprintf("/%s/", $t[1]))) //if "id oferty:nr" jest w ciągu znaków przekazanych z pola 'nazwa'
					    {
						$t[1]=$row[8]; //id oferta po odfiltrowaniu
						}
					}
					
//filtracja agent_id z przesłanego mixu: imie nazwisko id

  $zapytanie2 = "SELECT * FROM Agenci a";
  $result = mysqli_query($conn, $zapytanie2);
  if($result != TRUE){echo 'Bład zapytania MySQL5, odpowiedź serwera: '.mysqli_error($conn);}


            		while($row = mysqli_fetch_array($result,MYSQLI_NUM))
					{
					    if(preg_match(sprintf("/%s/", $row[0]), sprintf("/%s/", $t[2]))) //if id agenta jest w ciągu znaków przekazanych z pola 'agent sprzedajacy'
					    {
						$t[2]=$row[0]; //id agenta do wstawienia w 'tranzakcje'
						}
					} 
//ustawienie oferty jako nieaktywnej
$zapytanie = "UPDATE `Oferty` SET `stan` = '0' WHERE `oferta_id` = '$t[1]'";
//print("<b>MySQ2: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL2, odpowiedź serwera: '.mysql_error($conn);}
                                        
//zapis tranzakci do bd
echo'<div id="komunikat_field">';
$zapytanie = "INSERT INTO `Tranzakcje` ( `tranzakcja_id` , `oferta_id` , `agent_id` , `klient`, `data`) VALUES ( '','$t[1]','$t[2]','$t[3]',CURDATE())" ;
print("<b>MySQL1: </b><div id=\"ekran3\">".$zapytanie."</div>");
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';}
echo'</div>'; //end of komunikat_field


?>