<?php
$id = $_GET["id"];

echo'
    <div id="komunikat_field">
    <h3>Czy jesteś pewien, że chcesz usunąć ofertę na trwałe z bazy danych? </h3></br></br>';

    require 'config_db.php';
    $result = mysqli_query($conn, "SELECT o.oferta_id, o.nazwa, m.nazwa, o.ulica, o.stan, o.cena, o.powierzchnia FROM oferty o, miejscowosc m WHERE o.miejscowosc_id=m.miejscowosc_id AND o.oferta_id='".$id."'");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
    $row = mysqli_fetch_array($result, MYSQLI_NUM);

    print("<label>Nr".$row[0].": ".$row[1]." - ".$row[6]."m<sup>2</sup> - ".$row[2]." - ".$row[3]." - ".$row[5]."zł</label></br></br></br>");
    
    print("<button id=\"delete_submit\" onclick=\"getData('action_delete_oferta.php?id=$id','field')\">Usuń</button>");
    print("<button id=\"delete_submit\" onclick=\"getData('main_wyszukaj.php','field')\">Anuluj</button>");
echo'</div>'; //end of komunikat_field

?>