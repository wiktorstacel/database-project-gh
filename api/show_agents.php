<?php

//$data = json_decode(file_get_contents("php://input"));

$status = htmlentities($_POST['status'], ENT_QUOTES, "UTF-8");// 0 - były pracownik; 1 - obecny pracownik
require_once '../config_db.php';
$status = mysqli_real_escape_string($conn, $status);

$zapytanie = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa 
FROM agenci a, stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id AND a.status = '$status'
ORDER BY a.agent_id ASC";

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
$table = array(); 
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{//a.agent_id, a.imie, a.nazwisko, s.nazwa
    $row_send = array();
    $row_send['agent_id'] = (int) $row[0];
    $row_send['agentImie'] = $row[1];
    $row_send['agentNazwisko'] = $row[2];
    $row_send['stanowiskoNazwa'] = $row[3];
    $table[] = $row_send;
}
print json_encode($table);	

mysqli_close($conn);
?>