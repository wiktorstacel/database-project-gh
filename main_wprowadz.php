<?php

echo'    
    <div style="float: left;"><h3>Wprowadź ofertę: </h3></div>
    <div style="float: left; margin:7px 0 0 60px;">Do edycji: </div>
        <div style="float: left;">';

            require_once 'config_db.php'; //załadowanie ofert do selecta w celu wybrania do edycji
            echo '<select id="edycja_oferty" class="input2" name="edycja_oferty">';
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
    

        echo'
        <br><label class="label_form_wprowadz" for="wp0">Nazwa: </label>
        <input type="text" name="nazwa" id="wp0" class="input1"/><span id="alert0" class="alert"></span>
        

        <br><label class="label_form_wprowadz" for="wp1">Rodzaj oferty: </label>
        <select id="wp1" class="input1" name="kind">';
        //załadowanie rodzajów oferty do listy rozwijanej formularza
        require_once 'config_db.php';	
        $result = mysqli_query($conn, "SELECT * FROM rodzaj ORDER BY rodzaj_id DESC");
        if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]."</option>");
        }        
        echo'<option selected="selected">-wszystkie-</option></select><span id="alert1" class="alert"></span>       
        

        <br><label class="label_form_wprowadz" for="wp2">Województwo: </label>
        <select name="state" id="wp2" class="input1" onchange="insert_miasto(2,0,0)">';     
        //załadowanie województw do listy rozwijanej formularza
        $result = mysqli_query($conn, "SELECT * FROM wojewodztwo ORDER BY wojewodztwo_id DESC");
        if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        { 
            print("<option value=".$row[0].">".$row[1]."</option>");
        }    
        echo'<option selected="selected">-wszystkie-</option></select><span id="alert2" class="alert"></span>
 

        <br><form id="searchform" method="post">
        <fieldset>
        <label class="label_form_wprowadz" for="wp3">Miejscowość: </label>
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
        <span id="alert3" class="alert"></span><span id="alert4" class="alert"></span>
        </fieldset>
        </form>
        

        <br><label class="label_form_wprowadz" for="wp5">Adres: </label>
        <input type="text" name="street" id="wp5" class="input1"/><span id="alert5" class="alert"></span>
        

        <br><label class="label_form_wprowadz" for="wp6">Powierzchnia: </label>
        <input type="text" name="mm" style="width:50px;" id="wp6" class="input1"/> m<sup>2</sup><span id="alert6" class="alert"></span>


        <br><label class="label_form_wprowadz" for="wp7">Cena: </label>
        <input name="price" type="text" value="" style="width:50px;" id="wp7" class="input1"" /> zł<span id="alert7" class="alert"></span>
    

        <br><label class="label_form_wprowadz" for="wp8">Opis: </label>
        <textarea name="description" cols="44" rows="5" type="text" value="" id="wp8" class="input1"></textarea><span id="alert8" class="alert"></span>


        <br><button style="margin-left:618px;" type="" onclick="action_save_oferta()">Zapisz</button>
';
    
 
    mysqli_close($conn);
?>