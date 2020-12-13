<?php
$id = $_GET["id"];
$temp = "";
echo'
    <h3>Zawarcie transakcji: </h3></br>

    <table>

    <tr>
    <td>Oferta:</td>';

    require 'config_db.php';
    echo '<td><select id="t1" class="input2" name="t1" onchange="insert_price()">';
    //załadowanie ofert do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT o.oferta_id, o.nazwa, m.nazwa, o.ulica, o.stan, o.powierzchnia FROM oferty o, miejscowosc m WHERE o.miejscowosc_id=m.miejscowosc_id AND o.stan=1 ORDER BY o.oferta_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            if($row[4] != 0)//stan oferty musi mieć stan 1
            {	
                if($id != $row[0])//id_oferta różne od id_oferta przesłane z GET
                { 
                    print("<option value=".$row[0].">".$row[1]." - ".$row[5]."m<sup>2</sup> - ".$row[2]." - ".$row[3]."</option>");
                }
                else//id oferta z BD równe przesłanemu z GET
                {
                    print("<option value=".$row[0]." selected=\"selected\">".$row[1]." - ".$row[5]."m<sup>2</sup> - ".$row[2]." - ".$row[3]."</option>");
                }
            }
        }
        if($id == 0)
        {
            echo'<option selected="selected">-wybierz-</option>';
        }
        else
        {
            echo'<option>-wybierz-</option>';
        }  
        echo'</select><span id="alert1" class="alert"></span>';
//	print("<span> Id ofery:</span><span id=\"of_id\" class=\"of_id\">".$temp."</span>");

        echo'
        </td>
        </tr>

        <tr>
        <td>Agent sprzedający:</td>
        <td> <select name="agent" id="t2" class="input2" onchange="insert_price()">'; 
        
        require 'config_db.php';	//załadowanie agentów do listy rozwijanej formularza
        $result = mysqli_query($conn, "SELECT * FROM agenci WHERE status='1' ORDER BY agent_id ASC");
        if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]." ".$row[2]."</option>");
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
        <button id="searchsubmit" type="" onclick="action_save_trans()">Zrealizuj</button>
        </td>
        <td>';
        print("<button id=\"searchsubmit\" onclick=\"getData('show_transakcje.php','ekran2')\">Pokaż zrealizowane</button>");
        echo'</td>
        </tr>
        
        </table>';

?>