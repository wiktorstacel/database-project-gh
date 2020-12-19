<?php
 
echo'
    <h3>Wyszukaj ofertę: </h3></br>
    <table>
    <tr>
    <td>Rodzaj oferty:</td>
    <td><select id="p1" class="input1" name="kind" onchange="">'; 
    require_once 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM rodzaj ORDER BY rodzaj_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option value=".$row[0].">".$row[1]."</option>");
    }
    
    echo'<option selected="selected">-wszystkie-</option></select></td>';

    echo' <td style="width:150px;"></td>
    <td>Aktualne:</td>
    <td><input name="actual" id="p6" type="checkbox" value="0" onchange="" checked="checked" /></td>					    <td>Nieaktualne:</td>
    <td><input name="noactual" id="p7" type="checkbox" value="1" onchange="" /></td>
    </tr> ';

    echo'
    <tr>
    <td>Województwo:</td>';
    print("<td> <select name=\"state\" id=\"p2\" class=\"input1\" onchange=\"insert_miasto()\">"); 
    //załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM wojewodztwo ORDER BY wojewodztwo_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option value=".$row[0].">".$row[1]."</option>");
    }
    echo'<option selected="selected">-wszystkie-</option></select></td>
    </tr>

    <tr>
    <td>Miejscowość:</td>
    <td> <select name="town" id="p3" class="input1" onchange="">'; 
    
    //załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM miejscowosc ORDER BY nazwa ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option value=".$row[0].">".$row[1]."</option>");
    }
    
    echo'<option selected="selected">-wszystkie-</option></select></td>
    </tr>';

    echo'<tr>
    <td>Cena min:</td>
    <td> <input name="pricemin" id="p4" type="text" onchange="" style="width:90px;" />
    <div id="alert4" class="alert"></div></td>
    </tr>

    <tr>
    <td>Cena max:</td>
    <td><input name="pricemax" id="p5" type="text" onchange="" style="width:90px;" />
    <div id="alert5" class="alert"></div></td>
    </tr>

    <tr>
    <td></td><td></td><td style="width:150px;"></td></td><td><td></td>
    <td><button id="button_show_ofert" type="" onclick="">Pokaż</button></td>
    </tr>

    </table>
    
';
mysqli_close($conn);
?>