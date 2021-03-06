<?php

$data = json_decode(file_get_contents("php://input"));
//print_r($data);

if(!isset($data->wp0) || !isset($data->wp1) || !isset($data->wp2) || !isset($data->wp5) || !isset($data->wp6) || !isset($data->wp7) || !isset($data->wp8))
{
    $msg['message']="Błąd danych - nieprawidłowy formularz"; print json_encode($msg);
}
else
{
    if(!isset($data->id))
    {
        $data->id = 0;
    }
    if(!isset($data->wp3))
    {
        $data->wp3 = "x";
    }
    if(!isset($data->wp4))
    {
        $data->wp4 = "x";
    } 

    $oferta_id = htmlentities($data->id, ENT_QUOTES, "UTF-8");//nazwa
    $p[0] = htmlentities($data->wp0, ENT_QUOTES, "UTF-8");//nazwa
    $p[1] = htmlentities($data->wp1, ENT_QUOTES, "UTF-8");//rodzaj_id
    $p[2] = htmlentities($data->wp2, ENT_QUOTES, "UTF-8");//wojewodztwo_id
    $p[3] = htmlentities($data->wp3, ENT_QUOTES, "UTF-8");//miejscowosc_id 
    $p[4] = htmlentities($data->wp4, ENT_QUOTES, "UTF-8");//miejscowosc_new
    $p[5] = htmlentities($data->wp5, ENT_QUOTES, "UTF-8");//ulica
    $p[6] = htmlentities($data->wp6, ENT_QUOTES, "UTF-8");//powierzchnia
    $p[7] = htmlentities($data->wp7, ENT_QUOTES, "UTF-8");//cena
    $p[8] = htmlentities($data->wp8, ENT_QUOTES, "UTF-8");//opis
    require_once '../config_db.php';
    $oferta_id = mysqli_real_escape_string($conn, $oferta_id);
    $p[0] = mysqli_real_escape_string($conn, $p[0]);
    $p[1] = mysqli_real_escape_string($conn, $p[1]);
    $p[2] = mysqli_real_escape_string($conn, $p[2]);
    $p[3] = mysqli_real_escape_string($conn, $p[3]);
    $p[4] = mysqli_real_escape_string($conn, $p[4]);
    $p[5] = mysqli_real_escape_string($conn, $p[5]);
    $p[6] = mysqli_real_escape_string($conn, $p[6]);
    $p[7] = mysqli_real_escape_string($conn, $p[7]);
    $p[8] = mysqli_real_escape_string($conn, $p[8]);


    $licznik = 0;					
    if($p[4] != 'x')//wstawiwanie nowej miejscowosci a potem wyciaganie jej nowego id
    {
        $zapytanie40="SELECT miejscowosc_id FROM miejscowosc WHERE nazwa='$p[4]'";
        $result = mysqli_query($conn, $zapytanie40);
        if($result != TRUE){echo 'Bład zapytania MySQL4.0, odpowiedź serwera: '.mysqli_error($conn);$licznik++;}
        $exist = mysqli_num_rows($result);
        //$exist = mysqli_fetch_array($result);

        if($exist == 0)
        {
            $zapytanie41="INSERT INTO `miejscowosc`(miejscowosc_id, nazwa, wojewodztwo_id) VALUES (DEFAULT,'$p[4]','$p[2]')";
            $result = mysqli_query($conn, $zapytanie41);//wstawienie nowej miejscowosci
            if($result != TRUE){/*echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);*/$licznik++;}
        //    print("<b>MySQL4.1: </b><div id=\"ekran1.4.1\">".$zapytanie41."</div>");

            $zapytanie42="SELECT miejscowosc_id FROM miejscowosc WHERE nazwa='".$p[4]."'";
            $result = mysqli_query($conn, $zapytanie42);
            if($result != TRUE){/*echo 'Bład zapytania MySQL4.2, odpowiedź serwera: '.mysqli_error($conn);*/$licznik++;}

            $row = mysqli_fetch_array($result);
            $p[3]=$row["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry' !zapisane w $p[3]
        //    print("<b>MySQL4.2: </b><div id=\"ekran1.4.2\">".$zapytanie42."</div><div>Odp:".$p[3]."</div>");
        }
        else
        {
          $p[3]=$exist["miejscowosc_id"]; //id miejscowosci do wstawienia w 'ofetry'
    //      print("<b>MySQL40: </b><div id=\"ekran1.4.0\">".$zapytanie40."</div><div>Odp:".$p[3]."</div>");
        }
    }


    if($licznik > 0) //sa bledy w zapisie miejscowosci
    {
        $msg['message']="Błąd zapisanu danych - miejscowość"; print json_encode($msg);
    }
    else //jak nie ma bledow to mozna zapisac oferte
    {
        if($oferta_id > 0) //aktualizacja po edycji
        {
            $zapytanie = "UPDATE `oferty` SET `nazwa`='$p[0]', `rodzaj_id`='$p[1]', `wojewodztwo_id`='$p[2]', `miejscowosc_id`='$p[3]', `ulica`='$p[5]',`powierzchnia`='$p[6]',`cena`='$p[7]',`opis`='$p[8]' WHERE `oferta_id`=$oferta_id" ; 
        }
        else //id == 0, czyli zapisywanie jako nowej
        {
            $zapytanie = "INSERT INTO `oferty` ( `nazwa` , `rodzaj_id` , `wojewodztwo_id` , `miejscowosc_id`, `ulica` ,`powierzchnia`,`cena`,`opis`,`oferta_id`) VALUES ( '$p[0]','$p[1]','$p[2]','$p[3]','$p[5]','$p[6]','$p[7]','$p[8]',DEFAULT)" ; 
        }
        $result = mysqli_query($conn, $zapytanie);
        //print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
        if($result != TRUE){$msg['message']="Błąd zapisanu danych oferty"; print json_encode($msg);}//Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        else {$msg['message']="Dane zapisane poprawnie"; print json_encode($msg);} 
    }	

    mysqli_close($conn);
}
?>