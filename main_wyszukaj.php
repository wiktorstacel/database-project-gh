<?php
 
echo'
    <h3>Wyszukaj ofertę: </h3></br>
    

    <br><label class="label_form_wyszukaj" for="p1">Rodzaj oferty: </label>
    <select id="p1" class="input1" name="kind" onchange="">'; 
    require_once 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM rodzaj ORDER BY rodzaj_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option value=".$row[0].">".$row[1]."</option>");
    }
    
    echo'<option selected="selected">-wszystkie-</option></select>
        

    <label style="margin-left: 132px;" for="p6">Aktualne: </label>
    <input name="actual" id="p6" type="checkbox" value="0" onchange="" checked="checked" />	
    

    <label for="p7">Nieaktualne: </label>
    <input name="noactual" id="p7" type="checkbox" value="1" onchange="" />


    <br><label class="label_form_wyszukaj" for="p2">Województwo: </label>
    <select name="state" id="p2" class="input1" onchange="insert_miasto(1,0,0)">'; 
    //załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM wojewodztwo ORDER BY wojewodztwo_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option value=".$row[0].">".$row[1]."</option>");
    }
    echo'<option selected="selected">-wszystkie-</option></select>
        

    <br><label class="label_form_wyszukaj" for="p3">Miejscowość: </label>
    <select name="town" id="p3" class="input1" onchange="">'; 
    //załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM miejscowosc ORDER BY nazwa ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
    while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    { 
        print("<option value=".$row[0].">".$row[1]."</option>");
    }    
    echo'<option selected="selected">-wszystkie-</option></select>
        

    <br><label class="label_form_wyszukaj" for="p4">Cena min: </label>
    <input name="pricemin" id="p4" type="text" onchange="" style="width:90px;" />
    <span id="alert4" class="alert"></span>
    

    <br><label class="label_form_wyszukaj" for="p5">Cena max: </label>
    <input name="pricemax" id="p5" type="text" onchange="" style="width:90px;" />
    <span id="alert5" class="alert"></span>
    

    <br><button style="margin-left:620px;" id="button_show_ofert" type="" onclick="">Pokaż</button>';
    
    
mysqli_close($conn);
?>