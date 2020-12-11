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
    $result = mysqli_query($conn, "SELECT o.oferta_id, o.nazwa, m.nazwa, o.ulica, o.stan FROM Oferty o, miejscowosc m WHERE o.miejscowosc_id=m.miejscowosc_id AND o.stan=1 ORDER BY o.oferta_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            if($row[4] != 0)
            {	
                    if($id != $row[0])
                    { 
                      print("<option value=".$row[0].">".$row[1]." - ".$row[2]." - ".$row[3]."</option>");
                    }
                    else
                    {
                      print("<option value=".$row[0]." selected=\"selected\">".$row[1]." - ".$row[2]." - ".$row[3]."</option>");
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
        <td> <select name="agent" id="t2" class="input2" onchange="insert_price()">'; 
        
        require 'config_db.php';	//załadowanie agentów do listy rozwijanej formularza
        $result = mysqli_query($conn, "SELECT * FROM Agenci WHERE status='1' ORDER BY agent_id ASC");
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