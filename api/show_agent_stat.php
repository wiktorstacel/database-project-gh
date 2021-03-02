<?php

$data = json_decode(file_get_contents("php://input"));
//print_r($data);

if(!isset($data->employee_stat) || !isset($data->position_stat) || !isset($data->type_stat) || !isset($data->start_date) || !isset($data->end_date))
{
    $msg['message']="Błąd danych - nieprawidłowy formularz"; print json_encode($msg);
    exit();
}

$w[1] = htmlentities($data->employee_stat, ENT_QUOTES, "UTF-8");//id 
$w[2] = htmlentities($data->position_stat, ENT_QUOTES, "UTF-8");//id stanowiska
$w[3] = htmlentities($data->start_date, ENT_QUOTES, "UTF-8");//data od 
$w[4] = htmlentities($data->end_date, ENT_QUOTES, "UTF-8");//data do
$w[5] = "z";//miejsce na group by
$w[9] = htmlentities($data->type_stat, ENT_QUOTES, "UTF-8");//sortuj sredia
/*$w[6] = htmlentities($_GET["w5"], ENT_QUOTES, "UTF-8");//sortuj sredia
$w[7] = htmlentities($_GET["w6"], ENT_QUOTES, "UTF-8");//sortuj ogólem
$w[8] = htmlentities($_GET["w7"], ENT_QUOTES, "UTF-8");//sortuj liczba*/
require_once '../config_db.php';
$w[1] = mysqli_real_escape_string($conn, $w[1]);
$w[2] = mysqli_real_escape_string($conn, $w[2]);
$w[3] = mysqli_real_escape_string($conn, $w[3]);
$w[4] = mysqli_real_escape_string($conn, $w[4]);
//$w[5] = mysqli_real_escape_string($conn, $w[5]);
$w[9] = mysqli_real_escape_string($conn, $w[9]);

/*$w[6] = mysqli_real_escape_string($conn, $w[6]);
$w[7] = mysqli_real_escape_string($conn, $w[7]);
$w[8] = mysqli_real_escape_string($conn, $w[8]);*/

if($w[1] == 0) $w[1] = 'x';
if($w[2] == 0) $w[2] = 'x';
$w[3] = substr($w[3], 0, 10);
$w[4] = substr($w[4], 0, 10);
if($w[9] == 0) {$w[6] = 'x';$w[7] = 1;$w[8] = 1;}
elseif($w[9] == 1) {$w[6] = 1;$w[7] = 'x';$w[8] = 1;}
elseif($w[9] == 2) {$w[6] = 1;$w[7] = 1;$w[8] = 'x';}
//echo '<br><br>|w_6: '.$w[6].' |w7: '.$w[7].' |w8: '.$w[8].'<br><br>';

//filtracja agent_id z przesłanego mixu: imie nazwisko id
  $zapytanie2 = "SELECT * FROM agenci a WHERE status='1'";
  $result = mysqli_query($conn, $zapytanie2);
  if($result != TRUE){echo 'Bład zapytania MySQL5, odpowiedź serwera: '.mysqli_error($conn);} 


$zapytanieA = "SELECT * FROM (SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa, AVG( o.cena ) avg_cena, COUNT( * ) count_rows, SUM(o.cena) suma_cena, 1 sortby 
FROM oferty o, agenci a, tranzakcje t, stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id
AND a.status = '1'
AND t.agent_id = a.agent_id
AND o.oferta_id = t.oferta_id
";

$add[1] = " AND a.agent_id='$w[1]'";
$add[2] = " AND s.stanowisko_id='$w[2]'";
$add[3] = " AND t.data>='$w[3]'";
$add[4] = " AND t.data<='$w[4]'";
$add[5] = " GROUP BY a.agent_id UNION ALL ";
/*$add[6] = " ORDER BY AVG( o.cena ) DESC, COUNT( * ) DESC";
$add[7] = " ORDER BY SUM(o.cena) DESC";
$add[8] = " ORDER BY COUNT( * ) DESC, SUM(o.cena) DESC";
*/

for($i=1;$i<=5;$i++)
{
  if($w[$i] != 'x')
  {
  	$zapytanieA = $zapytanieA.$add[$i];
  }
}

/*for($i=6;$i<=8;$i++)
{
  if($w[$i] == 'x')
  {
  	$zapytanieA = $zapytanieA.$add[$i];
  }
}*/


$zapytanieB = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa, 0 avg_cena, 0 count_rows, 0 suma_cena, 2 sortby
FROM oferty o, agenci a, tranzakcje t, stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id
AND a.status = '1'
AND o.oferta_id = t.oferta_id
AND a.agent_id NOT IN (SELECT t.agent_id FROM tranzakcje t)
";

$add[1] = " AND a.agent_id='$w[1]'";
$add[2] = " AND s.stanowisko_id='$w[2]'";
$add[3] = " AND t.data>='$w[3]'";
$add[4] = " AND t.data<='$w[4]'";
$add[5] = " GROUP BY a.agent_id) AS i ORDER BY sortby,";
$add[6] = " i.avg_cena DESC, i.count_rows DESC";
$add[7] = " i.suma_cena DESC";
$add[8] = " i.count_rows DESC, i.suma_cena DESC";


for($i=1;$i<=5;$i++)
{
  if($w[$i] != 'x')
  {
  	$zapytanieB = $zapytanieB.$add[$i];
  }
}

for($i=6;$i<=8;$i++)
{
  if($w[$i] == 'x')
  {
  	$zapytanieB = $zapytanieB.$add[$i];
  }
}

//CONNECTION of A & B
$zapytanie = $zapytanieA.$zapytanieB;

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

$table = array();           		
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{//a.agent_id, a.imie, a.nazwisko, s.nazwa, AVG( o.cena ) avg_cena, COUNT( * ) count_rows, SUM(o.cena) suma_cena, 1 sortby
    $row_send = array();
    $row_send['agent_id'] = (int) $row[0];
    $row_send['agentImie'] = $row[1];
    $row_send['agentNazwisko'] = $row[2];
    $row_send['stanowiskoNazwa'] = $row[3];
    $row_send['sredniaSprzedaz'] = (int)  $row[4];
    $row_send['liczbaTransakcji'] = (int)  $row[5];
    $row_send['sumaSprzedazy'] = (int) $row[6];
    $table[] = $row_send;
}
print json_encode($table);

mysqli_close($conn);
?>