<?php
require_once '../config_db.php';

$zapytanie = "SELECT * FROM rodzaj";
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

$table = array();
while($row = mysqli_fetch_assoc($result))
{ 
    $row['rodzaj_id'] = (int) $row['rodzaj_id'];
    $table[] = $row;
}
print json_encode($table);	
			
mysqli_close($conn);							
?>