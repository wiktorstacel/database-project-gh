<?php
$id = htmlentities($_GET["id"]);

echo'
    <div id="komunikat_field">
    <h3>Czy jesteś pewien, że chcesz usunąć transakcję?</br>Jej przedmiot wróci do aktywnych ofert.</h3></br></br>';

$zapytanie = "SELECT t.tranzakcja_id, o.nazwa, a.nazwisko, a.imie, t.klient, t.data, o.cena, m.nazwa, o.ulica, a.status, o.powierzchnia FROM  oferty o, agenci a, tranzakcje t, miejscowosc m
WHERE t.oferta_id=o.oferta_id AND t.agent_id=a.agent_id AND m.miejscowosc_id=o.miejscowosc_id AND t.tranzakcja_id='$id'";

require_once 'config_db.php';

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
$row = mysqli_fetch_array($result, MYSQLI_NUM);

    print("<label>T".$row[0].": ".$row[1]." - ".$row[10]."m<sup>2</sup> - ".$row[7]." - ".$row[8]."zł</label></br></br>");
    print("<label>Pracownik sprzedający: ".$row[2]." ".$row[3].". Klient:".$row[4]."</br>Data zawarcia: ".$row[5].". Cena: ".$row[6]."zł</label></br></br></br>");
    
    print("<button id=\"delete_submit\" onclick=\"getData('action_delete_trans.php?id=$id','field')\">Usuń</button>");
    print("<button id=\"delete_submit\" onclick=\"getData('main_transakcje.php?id=0','field')\">Anuluj</button>");
echo'</div>'; //end of komunikat_field

?>