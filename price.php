<?php

$name = $_GET["name"];

if($name == 'x' || $name == '-wszystkie-' || $name == '-wybierz-' || $name == '')
{
  return 0;
}
//else
//{
//  $middle = " WHERE nazwa='".$name."'";	
//}
$zapytanie = "SELECT * FROM Oferty";

//$zapytanie = $zapy.$middle;

					
    require 'config_db.php';	//załadowanie miejscowosci do listy rozwijanej formularza
    $result = mysqli_query($conn, $zapytanie);
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}


    while($row = mysqli_fetch_array($result,MYSQLI_NUM))
        {
            if(preg_match(sprintf("/%s/", "idoferty:".$row[8]), sprintf("/%s/", $name))) //if "id oferty:nr" jest w ciągu znaków przekazanych z pola 'nazwa'
            {
                $price=$row[6]; //id agenta do wstawienia w 'ofetry'
                }
        }
        echo $price;
					

?>