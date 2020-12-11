<?php

    //pole dowania agenta po lewej na stronie "Agenci"
    echo'<div id="add_agent">';
    
    echo'<h3>Dodaj pracownika: </h3></br>
    <label for="a1">Imię: </label>
    <input name="aname" id="a1" type="text" value="" onchange="" class="input1" />
    <div id="alert1" class="alert"></div>

    <label for="a2">Nazwisko: </label>
    <input name="asurname" id="a2" type="text" value="" onchange="" class="input1" />
    <div id="alert2" class="alert"></div>
    
    </br><label for="a3">Stanowisko: </label>
    <select id="a3" class="input1" name="akind" onchange="">'; 
    require 'config_db.php';	//załadowanie rodzajów rodzajów stanowisk do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Stanowisko ORDER BY stanowisko_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]."</option>");
        }
    echo'<option selected="selected">-wybierz-</option></select>
         <div id="alert3" class="alert"></div>';
    print("<button id=\"searchsubmit\" onclick=\"action_save_agent()\">Dodaj</button>");
    
    echo'</div>'; //end of add_agent

    
    //pole statystyk po prawej na stronie "Agenci"
    echo '<div id="stat_agent">
  
    <h3>Wyniki sprzedaży: </h3></br>
 
    <span>Sortuj wg </span><br />

    <label for="w1">Pracownik: </label>
    <select name="agent" id="w1" class="input1" onchange="show_wyniki_agenci()">'; 
    require 'config_db.php';	//załadowanie agentów do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Agenci WHERE status='1' ORDER BY agent_id ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]." ".$row[2]."</option>");
        }  
    echo'<option selected="selected">-wszyscy-</option></select>
        <div id="alertw1" class="alert"></div>

    <span>lub</span><br />

    <label for="w2">Stanowisko: </label>
    <select id="w2" class="input1" name="akind" onchange="show_wyniki_agenci()">'; 
    require 'config_db.php';	//załadowanie rodzajów stanowisk do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Stanowisko ORDER BY stanowisko_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]."</option>");
        }   
    echo'<option selected="selected">-wszystkie-</option></select>
        <div id="alertw2" class="alert"></div>
 
    <br /><label for="w1">Wyniki od: </label>'; 
    $result = mysqli_query($conn, "SELECT CURDATE()"); //pobranie daty dzisiejszej Mysql
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    
    echo'<input name="date_low" id="w3" type="text" value="2010-01-01" onchange="show_wyniki_agenci()" class="data"  /> do: <input name="date_high" id="w4" type="text" value="'.$row[0].'" onchange="ask_wyniki()" class="data" />
        <div id="alertw3" class="alert"></div>
        <div id="alertw4" class="alert"></div>

    <br />
    <label for="w5">Średnia sprzedaż: </label>
    <input name="sortuj" id="w5" type="radio" value="1" onchange="show_wyniki_agenci()" checked="checked" />
    <br />
    <label for="w6">Sprzedaż ogółem: </label>
    <input name="sortuj" id="w6" type="radio" value="1" onchange="show_wyniki_agenci()" />
    <br />
    <label for="w7">Liczba tranzakcji: </label>
    <input name="sortuj" id="w7" type="radio" value="1" onchange="show_wyniki_agenci()" />';
    
    print("<button id=\"searchsubmit\" onclick=\"show_wyniki_agenci()\">Wyniki</button>");
    
    echo'</div>'; //end of stat_agent
    echo '<div style="clear: both;"></div>';
    
    print("<div id=\"agenci_submit1\"><button onclick=\"getData('show_agenci.php?status=1','ekran2')\">Lista Pracowników</button></div>");
    print("<div id=\"agenci_submit2\"><button onclick=\"getData('show_agenci.php?status=0','ekran2')\">Byli Pracownicy</button></div>");
    print("<div style=\"clear: both;\"></div>");

?>