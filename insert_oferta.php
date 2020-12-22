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
        while($row = mysqli_fetch_assoc($result))
        {
            $data['nazwa'] = $row['nazwa'];
            $data['ulica'] = $row['ulica'];
            $data['powierzchnia'] = $row['powierzchnia'];
            echo json_encode($data);
        }
    }
    
}
