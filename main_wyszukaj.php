<?php
 
echo'
    <h3>Wyszukaj ofertę: </h3></br>
    <table>
    <tr>
    <td>Rodzaj oferty:</td>
    <td><select id="p1" class="input1" name="kind" onchange="show_oferty()">'; 
    require 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Rodzaj ORDER BY rodzaj_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option>".$row[1]."</option>");
    }
    
    echo'<option selected="selected">-wszystkie-</option></select></td>';

    echo' <td style="width:150px;"></td>
    <td>Aktualne:</td>
    <td><input name="actual" id="p6" type="checkbox" value="0" onchange="show_oferty()" checked="checked" /></td>					    <td>Nieaktualne:</td>
    <td><input name="noactual" id="p7" type="checkbox" value="1" onchange="show_oferty()" /></td>
    </tr> ';

    echo'
    <tr>
    <td>Województwo:</td>';
    print("<td> <select name=\"state\" id=\"p2\" class=\"input1\" onchange=\"show_oferty(),intown()\">"); 
    require 'config_db.php';	//załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Wojewodztwo ORDER BY wojewodztwo_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option>".$row[1]."</option>");
    }
    echo'<option selected="selected">-wszystkie-</option></select></td>
    </tr>

    <tr>
    <td>Miejscowość:</td>
    <td> <select name="town" id="p3" class="input1" onchange="show_oferty()">'; 
    
    require 'config_db.php';	//załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Miejscowosc ORDER BY nazwa ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option>".$row[1]."</option>");
    }
    
    echo'<option selected="selected">-wszystkie-</option></select></td>
    </tr>';

    echo'<tr>
    <td>Cena min:</td>
    <td> <input name="pricemin" id="p4" type="text" value="" onchange="show_oferty()" style="width:90px;" /></td>
    </tr>

    <tr>
    <td>Cena max:</td>
    <td><input name="pricemax" id="p5" type="text" value="" onchange="show_oferty()" style="width:90px;" /></td>
    </tr>

    <tr>
    <td></td><td></td><td style="width:150px;"></td></td><td><td></td>
    <td><button id="searchsubmit" type="" onclick="show_oferty()">Pokaż</button></td>
    </tr>

    </table>
    
';

?>