<?php

  $data = json_decode(file_get_contents("php://input"));
  //print_r($data);
  //echo $data->p6;
  
  //UWAGA: Jak wyrzucać błędy MySQL jako np connection error, gdzie api dostanie to jako error a nie wyswieli myslerror

if(!isset($data->p1) || !$data->p1 || $data->p1 === 0)
{
    $data->p1 = "x";
}  
if(!isset($data->p2) || !$data->p2 || $data->p2 === 0)
{
    $data->p2 = "x";
}  
if(!isset($data->p3) || !$data->p3 || $data->p3 === 0)
{
    $data->p3 = "x";
}  
if(!isset($data->p4) || !$data->p4 || $data->p4 === 0)
{
    $data->p4 = "x";
}  
if(!isset($data->p5) || !$data->p5 || $data->p5 === 0)
{
    $data->p5 = "x";
}
if(!isset($data->p6) || $data->p6)//true - pokaz te ze stanem 1
{
    $data->p6 = "x";
}
if(!isset($data->p7) || $data->p7)//true - pokaz te ze stanem 
{
    $data->p7 = "x";
}
if(!isset($data->p8) || !$data->p8 || $data->p8 === 0)
{
    $data->p8 = "x";
}

if($data)
{

    $p[1] = htmlentities($data->p1, ENT_QUOTES, "UTF-8");//nazwa
    $p[2] = htmlentities($data->p2, ENT_QUOTES, "UTF-8");//wojewodztwo
    $p[3] = htmlentities($data->p3, ENT_QUOTES, "UTF-8");//miasto
    $p[4] = htmlentities($data->p4, ENT_QUOTES, "UTF-8");//cena min
    $p[5] = htmlentities($data->p5, ENT_QUOTES, "UTF-8");//cena max
    $p[6] = htmlentities($data->p6, ENT_QUOTES, "UTF-8");//aktualne
    $p[7] = htmlentities($data->p7, ENT_QUOTES, "UTF-8");//nieaktualne
    $p[8] = htmlentities($data->p8, ENT_QUOTES, "UTF-8");//LIMIT
    require_once '../config_db.php';
    $p[1] = mysqli_real_escape_string($conn, $p[1]);
    $p[2] = mysqli_real_escape_string($conn, $p[2]);
    $p[3] = mysqli_real_escape_string($conn, $p[3]);
    $p[4] = mysqli_real_escape_string($conn, $p[4]);
    $p[5] = mysqli_real_escape_string($conn, $p[5]);
    $p[6] = mysqli_real_escape_string($conn, $p[6]);
    $p[7] = mysqli_real_escape_string($conn, $p[7]);
    $p[8] = mysqli_real_escape_string($conn, $p[8]);

    $add[1] = " AND r.rodzaj_id='$p[1]'";
    $add[2] = " AND w.wojewodztwo_id='$p[2]'";
    $add[3] = " AND m.miejscowosc_id='$p[3]'";
    $add[4] = " AND o.cena>='$p[4]'";
    $add[5] = " AND o.cena<='$p[5]'";
    $add[6] = " AND o.stan=0";//'$p[6]' //p6 przychodzi true, daje x i nie dokleja tego warunku
    $add[7] = " AND o.stan=1";//'$p[7]'
    $add[8] = " ORDER BY o.oferta_id DESC LIMIT $p[8]";

    $zapytanie = "SELECT o.nazwa, r.nazwa, w.nazwa, m.nazwa, o.ulica, o.powierzchnia, o.cena, o.opis, o.oferta_id, o.stan FROM  oferty o, rodzaj r, wojewodztwo w, miejscowosc m 
    WHERE o.rodzaj_id=r.rodzaj_id
    AND o.wojewodztwo_id=w.wojewodztwo_id
    AND o.miejscowosc_id=m.miejscowosc_id";
    $zapytanie_pom = $zapytanie;

    for($i=1;$i<=8;$i++)
    {
      if($p[$i] != 'x')
      {
            $zapytanie = $zapytanie.$add[$i];
      }
    }

    $add[8] = " ORDER BY o.oferta_id DESC";
    for($i=1;$i<=8;$i++)
    {
      if($p[$i] != 'x')
      {
            $zapytanie_pom = $zapytanie_pom.$add[$i];
      }
    }

    $result = mysqli_query($conn, $zapytanie);
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
    $table = array();
    while($row = mysqli_fetch_assoc($result))
    {
        $table[] = $row;
    }
    print json_encode($table);
    
    mysqli_close($conn);

}
else
{
    echo 'Data processing error';
}
?>