<?php
$id = $_GET["m"];
$temp = "";
echo'
    <h3>Zawarcie transakcji: </h3></br>

    <table onmouseover="inprice()">

    <tr>
    <td>Oferta:</td>';

    require 'config_db.php';
    echo '<td><select id="t1" class="input2" name="t1" onchange="inprice()">';
    //załadowanie ofert do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Oferty ORDER BY nazwa DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            if($row[9] != 0)
            {	
                    if($id != $row[8])
                    { 
                      print("<option>".$row[0]." - ".$row[4]." - idoferty:".$row[8]."</option>");
                    }
                    else
                    {
                      print("<option selected=\"selected\">".$row[0]." - ".$row[4]." - idoferty:".$row[8]."</option>");
                    }
            }
        }
        echo'</select>';
//	print("<span> Id ofery:</span><span id=\"of_id\" class=\"of_id\">".$temp."</span>");

        echo'
        </td>
        </tr>

        <tr>
        <td>Agent sprzedający:</td>
        <td> <select name="agent" id="t2" class="input2" onchange="inprice()">'; 
        
        require 'config_db.php';	//załadowanie agentów do listy rozwijanej formularza
        $result = mysqli_query($conn, "SELECT * FROM Agenci WHERE status='1' ORDER BY agent_id ASC");
        if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]." ".$row[2]." - id:".$row[0]."</option>");
        }
        
        echo'<option selected="selected">-wybierz-</option></select><span id="alert2" class="alert"></span></td>
        </tr>

        <tr>
        <td>Suma tranzakcji:</td><td><span id="alertprice" class="price">0</span> zł</td>
        </tr>

        <tr>
        <td>Klient:</td><td><input id="t3" class="input1" /><span id="alert3" class="alert"></span></td>
        </tr>
        
        <tr>
        <td></td>
        
        <td>
        <button id="searchsubmit" type="" onclick="inprice(),insert_tranzakcja()">Potwierdź</button>
        </td>
        <td>';
        print("<button id=\"searchsubmit\" onclick=\"getData('pokaz_tranzakcje.php','ekran3')\">Pokaż stare</button>");
        echo'</td>
        </tr>
        
        </table>';

?>