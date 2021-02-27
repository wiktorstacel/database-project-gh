<?php //header('Access-Control-Allow-Origin: *');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../config_db.php';

$result = mysqli_query($conn, "SELECT o.oferta_id, o.nazwa, m.nazwa, o.ulica, o.stan, o.powierzchnia, o.cena FROM oferty o, miejscowosc m WHERE o.miejscowosc_id=m.miejscowosc_id AND o.stan=1 ORDER BY o.oferta_id DESC");
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
else
{
    $table = array();
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    {
        $row1 = array();
        $row1['oferta_id'] = (int) $row[0];
        $row1['opis'] = $row[1]." - ".$row[5]."m2 - ".$row[2]." - ".$row[3];
        $row1['cena'] = (int) $row[6];
        $table[] = $row1;
    }
    echo json_encode($table);
}

