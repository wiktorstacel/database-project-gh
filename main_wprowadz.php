<?php

echo'
    <form id="searchform" method="post">
    <fieldset>    
    <h3>Wprowadź ofertę: </h3></br>
    <table>
    <tr>
    <td>Nazwa: </td><td><input type="text" name="nazwa" id="p0" class="input1"/><span id="alert0" class="alert"></span></td>
    </tr>
    <tr>
    <td>Rodzaj oferty:</td>
    <td><select id="p1" class="input1" name="kind">'; 

    require 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Rodzaj ORDER BY rodzaj_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]."</option>");
        }
        
    echo'<option selected="selected">-wszystkie-</option></select><span id="alert1" class="alert"></span></div></td>
    </tr>

    <tr>
    <td>Województwo:</td>
    <td> <select name="state" id="p2" class="input1" onchange="intown()">'; 
    
    require 'config_db.php';	//załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Wojewodztwo ORDER BY wojewodztwo_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]."</option>");
        }
    
    echo'<option selected="selected">-wszystkie-</option></select><span id="alert2" class="alert"></span></div></td>
    </tr>

    <tr>
    <td>Miejscowość:</td>
    <td> <select  name="town" id="p3" class="input1">'; 
    
    require 'config_db.php';	//załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM Miejscowosc ORDER BY nazwa ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option>".$row[1]."</option>");
        }       
    echo'<option selected="selected">-wszystkie-</option></select>';
    
    print("<input type=\"checkbox\" name=\"checktown\" value=\"wartość\" onclick=\"this.form.elements['newtown'].disabled = !this.checked, this.form.elements['town'].disabled = this.checked\" />Nowa: ");
    echo'<input type="text" name="newtown" disabled="disabled" id="p4" style="width:62px;" onkeyup="podpowiedz_miasto(event)"/>
    <span id="alert3" class="alert"></span><span id="alert4" class="alert"></span></div>
    </td>
    </tr>

    <tr>
    <td>Adres: </td><td><input type="text" name="street" id="p5" class="input1"/><span id="alert5" class="alert"></span></td>
    </tr>

    <tr>
    <td>Powierzchnia: </td><td><input type="text" name="mm" style="width:50px;" id="p6" class="input1"/> m<sup>2</sup><span id="alert6" class="alert"></span></td>
    </tr>

    <tr>
    <td>Cena: </td>
    <td> <input name="price" type="text" value="" style="width:50px;" id="p7" class="input1"" /> zł<span id="alert7" class="alert"></span></td>
    </tr>

    <tr>
    <td>Opis:</td>
    <td><textarea name="description" cols="44" rows="5" type="text" value="" id="p8" class="input1"></textarea><span id="alert8" class="alert"></span></td>
    </tr>

    <tr>
    <td></td><td></td><td></td><td></td><td><button id="searchsubmit" type="" onclick="action_save_oferta()">Zapisz</button></td>
    </tr>


    </table>
        </fieldset>
    </form>
';

?>