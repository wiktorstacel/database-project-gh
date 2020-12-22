<?php
$woj = htmlentities($_GET["woj"], ENT_QUOTES, "UTF-8");
$m = htmlentities($_GET["m"], ENT_QUOTES, "UTF-8");//miejscowosc_id
require_once 'config_db.php';
$woj = mysqli_real_escape_string($conn, $woj);
$m = mysqli_real_escape_string($conn, $m);

if($woj == 'x' || $woj == '-wszystkie-' || $woj == '-wybierz-')
{
  $middle = "";
}
else
{
  $middle = " AND w.wojewodztwo_id='$woj'";	
}
$zapy = "SELECT * FROM miejscowosc m, wojewodztwo w WHERE m.wojewodztwo_id=w.wojewodztwo_id";

$tanie = " ORDER BY m.nazwa ASC";
$zapytanie = $zapy.$middle.$tanie;
					
//za�adowanie miejscowosci do listy rozwijanej formularza
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'B�ad zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}

while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{ 
    if($m != $row[0])
    {
        print("<option value=".$row[0].">".$row[1]."</option>");
    }
    else
    {
        print("<option selected=\"selected\" value=".$row[0].">".$row[1]."</option>");
    }
}
if($m == 0)
{
    echo'<option selected="selected">-wszystkie-</option>';
}
else
{
    echo'<option>-wszystkie-</option>';
}	
			
mysqli_close($conn);							
?>