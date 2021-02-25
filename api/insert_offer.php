<?php //header('Access-Control-Allow-Origin: *');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['id']))
{
    require_once '../config_db.php';
    $id = htmlentities($_POST["id"], ENT_QUOTES, "UTF-8");
    
    $result = mysqli_query($conn,
            sprintf("SELECT * FROM oferty WHERE oferta_id='%d'",
            mysqli_real_escape_string($conn, $id)
            ));
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
    else
    {
        $table = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $row['rodzaj_id'] = (int) $row['rodzaj_id'];
            $row['wojewodztwo_id'] = (int) $row['wojewodztwo_id'];
            $row['miejscowosc_id'] = (int) $row['miejscowosc_id'];
            $row['powierzchnia'] = (int) $row['powierzchnia'];
            $row['cena'] = (int) $row['cena'];
            $row['oferta_id'] = (int) $row['oferta_id'];
            $row['stan'] = (int) $row['stan'];
            $table[] = $row;
        }
        echo json_encode($table);
    }
    
}
else
{
    echo 'Błąd przetwarzania danych';
}
