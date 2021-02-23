<?php
require_once '../config_db.php';

$zapytanie = "SELECT * FROM wojewodztwo";
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

$table = array();
while($row = mysqli_fetch_assoc($result))
{
    $row['wojewodztwo_id'] = (int) $row['wojewodztwo_id'];
    $table[] = $row;
}
//print json_encode($table, JSON_NUMERIC_CHECK); //ou can force json_encode to use actual numbers for values that look like numbers...	
print json_encode($table);			
mysqli_close($conn);							