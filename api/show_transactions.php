<?php

$zapytanie = "SELECT t.tranzakcja_id, o.nazwa, a.nazwisko, a.imie, t.klient, t.data, o.cena, m.nazwa, o.ulica, a.status FROM  oferty o, agenci a, tranzakcje t, miejscowosc m
    WHERE t.oferta_id=o.oferta_id AND t.agent_id=a.agent_id AND m.miejscowosc_id=o.miejscowosc_id ORDER BY t.tranzakcja_id DESC";

require_once '../config_db.php';

$result = mysqli_query($conn, $zapytanie);
$row_number = mysqli_num_rows($result);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
$table = array();            		
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{//t.tranzakcja_id, o.nazwa, a.nazwisko, a.imie, t.klient, t.data, o.cena, m.nazwa, o.ulica, a.status
    $row_send = array();
    $row_send['tranzakcja_id'] = (int) $row[0];
    $row_send['ofertaNazwa'] = $row[1];
    $row_send['agentNazwisko'] = $row[2];
    $row_send['agentImie'] = $row[3];
    $row_send['transakcjaKlient'] = $row[4];
    $row_send['transakcjaData'] = $row[5];
    $row_send['ofertaCena'] = (int) $row[6];
    $row_send['miejscowoscNazwa'] = $row[7];
    $row_send['ofertaUlica'] = $row[8];
    $row_send['agentStatus'] = $row[9];
    $table[] = $row_send;
}

print json_encode($table);	

mysqli_close($conn);
?>

