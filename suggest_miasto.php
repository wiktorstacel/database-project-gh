<?php
require 'config_db.php';
//$woj = $_GET["woj"]; 
if($_GET["tek"])
{
    $i=0;
    $q=mysqli_query($conn, 'select nazwa from miejscowosc where nazwa like "'.$_GET["tek"].'%"');
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
