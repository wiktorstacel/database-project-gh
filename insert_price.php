<?php

$oferta_id = htmlentities($_GET["oferta_id"]);

if($oferta_id == 'x' || $oferta_id == '-wszystkie-' || $oferta_id == '-wybierz-' || $oferta_id == '')
{
  return 0;
}

$zapytanie = "SELECT * FROM oferty WHERE oferta_id='".$oferta_id."'";			
require 'config_db.php';
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

$row = mysqli_fetch_array($result,MYSQLI_NUM);

$price=$row[6]; 
         
echo $price;
					
?>