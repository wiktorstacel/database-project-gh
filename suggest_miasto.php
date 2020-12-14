<?php
require_once 'config_db.php';
$tek = htmlentities($_GET["tek"]);
if($tek)
{
    $i=0;
    $q=mysqli_query($conn, "SELECT nazwa FROM miejscowosc WHERE nazwa like '$tek'");
    if($q != TRUE){echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);}
        while($rekord=mysqli_fetch_array($q))
        {
            $i++;
            echo "<span id=sug$i onclick='wstaw($i)'>".$rekord["nazwa"]. " </span>";
        }
        
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
?>
