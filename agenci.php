<?php

echo'
    <form id="searchform" method="post">
    <fieldset>
    <div id="add_agent">

    <table>

    <tr>
    <td><b>Dodaj</b></td>
    </tr>

    <td>Imie:</td>
    <td> <input name="aname" id="a1" type="text" value="" onchange="" class="input1" /><div id="alert1" class="alert"></div></td>
    </tr>

    <td>Nazwisko:</td>
    <td> <input name="asurname" id="a2" type="text" value="" onchange="" class="input1" /><div id="alert2" class="alert"></div></td>
    </tr>

    <td>Stanowisko:</td>
    <td><select id="a3" class="input1" name="akind" onchange="">'; 
    require 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Stanowisko ORDER BY stanowisko_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]."</option>");
        }
    echo'<option selected="selected">-wybierz-</option></select><div id="alert3" class="alert"></div></td>

    <tr>';

    echo'</tr>';

    echo'</table>';

    echo'</div>


    <div id="stat_agent">
    <table>

    <tr>
    <b>Wyniki</b>
    </tr>

    <tr>
    <td>Pracownik:</td>
    <td> <select name="agent" id="w1" class="input1" onchange="">'; 
    require 'config_db.php';	//załadowanie agentów do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Agenci ORDER BY agent_id ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]." ".$row[2]." - id:".$row[0]."</option>");
        }
    
    echo'<option selected="selected">-wszyscy-</option></select><div id="alertw1" class="alert"></div></td>
    </tr>

    <tr>
    <td>Stanowiska:</td>
    <td><select id="w2" class="input1" name="akind" onchange="">'; 
    require 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Stanowisko ORDER BY stanowisko_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]."</option>");
        }
    
    echo'<option selected="selected">-wszystkie-</option></select><div id="alertw2" class="alert"></div></td>
    </tr>

    <tr></tr>

    <tr>
    <td>Wyniki od:</td>';
    //pobranie daty dzisiejszej Mysql
    $result = mysqli_query($conn, "SELECT CURDATE()");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    
    echo'
    <td><input name="date_low" id="w3" type="text" value="2010-01-01" onchange="" maxlength="10" class="data" /> do:<input name="date_high" id="w4" type="text" maxlength="10" value="'.$row[0].'" onchange="insert()" class="data" /><div id="alertw3" class="alert"></div><div id="alertw4" class="alert"></div></td>
    </tr>


    <tr>Sortuj wg:</tr>

    <tr>
    <td></td>
    <td>
    <div>Średnia sprzedaż: <input name="sortuj" id="w5" type="radio" value="1" onchange="" checked="checked" /></div>
    <div>Sprzedaż ogółem: <input name="sortuj" id="w6" type="radio" value="1" onchange="" /></div>
    <div>Liczba tranzakcji: <input name="sortuj" id="w7" type="radio" value="1" onchange="" /></div>
    </td>					    
    </tr>

    <tr>';

    echo'</tr>';

    echo'</table>';


    echo'</div>
    </fieldset>
    </form>';

    print("<button id=\"searchsubmit\" onclick=\"getData('pokaz_agenci.php','ekran3')\">Lista</button>");
    print("<td></td><td><button id=\"searchsubmit\" onclick=\"ask_wyniki()\">Wyniki</button></td>");
print("<td></td><td><button id=\"searchsubmit\" onclick=\"insert_agent()\">Dodaj</button></td>");

?>