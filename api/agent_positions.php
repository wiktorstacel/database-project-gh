<?php
require_once '../config_db.php';

$zapytanie = "SELECT * FROM stanowisko";
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

$table = array();
while($row = mysqli_fetch_assoc($result))
{ 
    $row['stanowisko_id'] = (int) $row['stanowisko_id'];
    $row['placa'] = (int) $row['placa'];
    $table[] = $row;
}
print json_encode($table);	
			
mysqli_close($conn);							
?>