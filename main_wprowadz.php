<?php

echo'    
    <div style="float: left;"><h3>Wprowadź ofertę: </h3></div>
    <div style="float: left; margin:7px 0 0 60px;">Do edycji: </div>
        <div style="float: left;">';

            require_once 'config_db.php'; //załadowanie ofert do selecta w celu wybrania do edycji
            echo '<td><select id="edycja_oferty" class="input2" name="edycja_oferty">';
            $result = mysqli_query($conn, "SELECT o.oferta_id, o.nazwa, m.nazwa, o.ulica, o.stan, o.powierzchnia FROM oferty o, miejscowosc m WHERE o.miejscowosc_id=m.miejscowosc_id AND o.stan=1 ORDER BY o.oferta_id DESC");
            if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);} 
            while($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                if($row[4] != 0)//stan oferty musi mieć stan 1
                {	
                    print("<option value=".$row[0].">".$row[1]." - ".$row[5]."m<sup>2</sup> - ".$row[2]." - ".$row[3]."</option>");
                }
            }
            echo'<option value="0" selected="selected">-wybierz- (nowa oferta do zapisu tylko z tą wybraną opcją)</option></select>';

        echo'</div>
        <div style="clear: both; margin-bottom: 4px;"></div>';
    
        /*echo'<div class="wprowadz_label">
            <div class="wprowadz_label_cell">
                Nazwa: 
            </div>
        </div>
        <div class="wprowadz_input">
            <div class="wprowadz_input_cell">
                <input type="text" name="nazwa" id="wp0" class="input1"/>
                <span id="alert0" class="alert"></span>
            </div>
        </div>
        <div style="clear: both; margin-bottom: 8px;"></div>';*/

    echo'
    <table>
    <tr>
    <td>Nazwa: </td><td><input type="text" name="nazwa" id="wp0" class="input1"/><span id="alert0" class="alert"></span></td>
    </tr>
    <tr>
    <td>Rodzaj oferty:</td>
    <td><select id="wp1" class="input1" name="kind">'; 

    require_once 'config_db.php';	//załadowanie rodzajów oferty do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM rodzaj ORDER BY rodzaj_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]."</option>");
        }
        
    echo'<option selected="selected">-wszystkie-</option></select><span id="alert1" class="alert"></span></div></td>
    </tr>

    <tr>
    <td>Województwo:</td>
    <td> <select name="state" id="wp2" class="input1" onchange="insert_miasto(2,0,0)">'; 
    
    //załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM wojewodztwo ORDER BY wojewodztwo_id DESC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]."</option>");
        }
    
    echo'<option selected="selected">-wszystkie-</option></select><span id="alert2" class="alert"></span></div></td>
    </tr>

    <tr>';
    echo '<td>Miejscowość:</td>
    <td>        
    <form id="searchform" method="post">
    <fieldset style="border: 1px groove;">
     <select  name="town" id="wp3" class="input1">'; 
    
    //załadowanie województw do listy rozwijanej formularza
    $result = mysqli_query($conn, "SELECT * FROM miejscowosc ORDER BY nazwa ASC");
    if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]."</option>");
        }       
    echo'<option selected="selected">-wszystkie-</option></select>';
    
    print("<input type=\"checkbox\" name=\"checktown\" value=\"wartość\" onclick=\"this.form.elements['newtown'].disabled = !this.checked, this.form.elements['town'].disabled = this.checked\" />Nowa: ");
    echo'<input type="text" name="newtown" disabled="disabled" id="wp4" style="width:62px;" onkeyup="suggest_miasto(event)"/>
    <span id="alert3" class="alert"></span><span id="alert4" class="alert"></span></div>
    </fieldset>
    </form>
    </td>
    </tr>


    <tr>
    <td>Adres: </td><td><input type="text" name="street" id="wp5" class="input1"/><span id="alert5" class="alert"></span></td>
    </tr>

    <tr>
    <td>Powierzchnia: </td><td><input type="text" name="mm" style="width:50px;" id="wp6" class="input1"/> m<sup>2</sup><span id="alert6" class="alert"></span></td>
    </tr>

    <tr>
    <td>Cena: </td>
    <td> <input name="price" type="text" value="" style="width:50px;" id="wp7" class="input1"" /> zł<span id="alert7" class="alert"></span></td>
    </tr>

    <tr>
    <td>Opis:</td>
    <td><textarea name="description" cols="44" rows="5" type="text" value="" id="wp8" class="input1"></textarea><span id="alert8" class="alert"></span></td>
    </tr>

    <tr>
    <td></td><td style="width: 521px;"></td><td><button id="searchsubmit" type="" onclick="action_save_oferta()">Zapisz</button></td>
    </tr>
    
    </table>';
    
 
    mysqli_close($conn);
?>