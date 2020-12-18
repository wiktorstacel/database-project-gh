<?php
$tek = htmlentities($_GET["tek"], ENT_QUOTES, "UTF-8");
require_once 'config_db.php';
$tek = mysqli_real_escape_string($conn, $tek);
//$tek = $_POST["suggestion"];

if($tek)
{
    $i=0;
    $tek = mysqli_real_escape_string($conn, $tek);
    $q=mysqli_query($conn, "SELECT nazwa FROM miejscowosc WHERE nazwa like '$tek%'");
    if($q != TRUE){echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);}
    while($rekord=mysqli_fetch_array($q))
    {
        $i++;
        echo "<span id=sug$i onclick='wstaw($i)'>".$rekord["nazwa"]. " </span>";
    }
    mysqli_free_result($q);
    if($i>0)
    {
        if($i==1)
        {
                echo "<span> istnieje</span>";
        }
        else
        {
                echo "<span> istnieją</span>";	
        }
    }   
}
mysqli_close($conn);
?>
