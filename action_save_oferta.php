<?php

$p[0] = htmlentities($_GET["p0"]);//nazwa
$p[1] = htmlentities($_GET["p1"]);//rodzaj_id
$p[2] = htmlentities($_GET["p2"]);//wojewodztwo_id
$p[3] = htmlentities($_GET["p3"]);//miejscowosc_id 
$p[4] = htmlentities($_GET["p4"]);//miejscowosc_new
$p[5] = htmlentities($_GET["p5"]);//ulica
$p[6] = htmlentities($_GET["p6"]);//powierzchnia
$p[7] = htmlentities($_GET["p7"]);//cena
$p[8] = htmlentities($_GET["p8"]);//opis

$licznik = 0;
					

if($p[4] != 'x')//wstawiwanie nowej miejscowosci a potem wyciaganie jej nowego id
{
    require_once 'config_db.php';
    $zapytanie40="SELECT miejscowosc_id FROM miejscowosc WHERE nazwa='".$p[4]."'";
    $result = mysqli_query($conn, $zapytanie40);
    if($result != TRUE){echo 'Bład zapytania MySQL4.0, odpowiedź serwera: '.mysqli_error($conn);$licznik++;}
    $exist = mysqli_fetch_array($result);

    if($exist == "")
    {
        $zapytanie41="INSERT INTO `miejscowosc`(miejscowosc_id, nazwa, wojewodztwo_id) VALUES (DEFAULT,'$p[4]','$p[2]')";
        $result = mysqli_query($conn, $zapytanie41);//wstawienie nowej miejscowosci
        if($result != TRUE){echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);$licznik++;}
    //    print("<b>MySQL4.1: </b><div id=\"ekran1.4.1\">".$zapytanie41."</div>");

        $zapytanie42="SELECT miejscowosc_id FROM miejscowosc WHERE nazwa='".$p[4]."'";
        $result = mysqli_query($conn, $zapytanie42);
        if($result != TRUE){echo 'Bład zapytania MySQL4.2, odpowiedź serwera: '.mysqli_error($conn);$licznik++;}

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
					

echo'<div id="komunikat_field">';
if($licznik > 0) //sa bledy w zapisie miejscowosci
{
    echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />';
}
else //jak nie ma bledow to mozna zapisac oferte
{
    require_once 'config_db.php';
    $zapytanie = "INSERT INTO `oferty` ( `nazwa` , `rodzaj_id` , `wojewodztwo_id` , `miejscowosc_id`, `ulica` ,`powierzchnia`,`cena`,`opis`,`oferta_id`) VALUES ( '$p[0]','$p[1]','$p[2]','$p[3]','$p[5]','$p[6]','$p[7]','$p[8]',DEFAULT)" ; 
    $result = mysqli_query($conn, $zapytanie);
    print("<b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
    if($result != TRUE){echo '<br /><h3>BŁĄD ZAPISU DANYCH!</h3><br />Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    else {echo'<br /><h3>DANE ZAPISANE POPRAWNIE</h3>';} 
}
echo'</div>'; //end of komunikat_field 
	


?>