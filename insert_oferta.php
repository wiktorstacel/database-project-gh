<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['id']))
{
    require_once 'config_db.php';
    $id = htmlentities($_POST["id"], ENT_QUOTES, "UTF-8");
    
    $result = mysqli_query($conn,
            sprintf("SELECT * FROM oferty WHERE oferta_id='%d'",
            mysqli_real_escape_string($conn, $id)
            ));
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
    else
    {
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            //echo json_encode($row);
            $data['nazwa'] = $row[0];
            $data['rodzaj_id'] = $row[1];
            $data['wojewodztwo_id'] = $row[2];
            $data['miejscowosc_id'] = $row[3];
            $data['ulica'] = $row[4];//uwaga przesunięcie indexu bo pominięte pole wpisania miejscowosci
            $data['powierzchnia'] = $row[5];
            $data['cena'] = $row[6];
            $data['opis'] = $row[7];
            $data['oferta_id'] = $row[8];
            
            echo json_encode($data);
        }
    }
    
}
