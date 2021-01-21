<?php
//jeśli nie przychychodzi zmienna POST to wyświetl 10, jeśli przychodzi to wyświetl tę liczbę wpisów
if(!isset($_POST['transSum']))
{
    $zapytanie = "SELECT t.tranzakcja_id, o.nazwa, a.nazwisko, a.imie, t.klient, t.data, o.cena, m.nazwa, o.ulica, a.status FROM  oferty o, agenci a, tranzakcje t, miejscowosc m
    WHERE t.oferta_id=o.oferta_id AND t.agent_id=a.agent_id AND m.miejscowosc_id=o.miejscowosc_id ORDER BY t.tranzakcja_id DESC LIMIT 10";
}
else
{
    $transSum = $_POST['transSum'];
    $zapytanie = "SELECT t.tranzakcja_id, o.nazwa, a.nazwisko, a.imie, t.klient, t.data, o.cena, m.nazwa, o.ulica, a.status FROM  oferty o, agenci a, tranzakcje t, miejscowosc m
    WHERE t.oferta_id=o.oferta_id AND t.agent_id=a.agent_id AND m.miejscowosc_id=o.miejscowosc_id ORDER BY t.tranzakcja_id DESC LIMIT $transSum";
}

require_once 'config_db.php';
echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"\">numer</td>");
print("<td class=\"\">nazwa</td>");
print("<td class=\"\">adres</td>");
print("<td class=\"\">pracownik</td>");
print("<td class=\"\">klient</td>");
print("<td class=\"\">suma</td>");
print("<td class=\"\">data</td>");
echo '<td>anuluj</td>';
echo '</tr>';

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
            		
	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
	{
		
        echo"<tr>";

            print("<td class=\"\">$row[0]</td>");
            print("<td class=\"\">$row[1]</td>");
            print("<td class=\"\">$row[7], $row[8]</td>");
            if($row[9]==1){print("<td class=\"\">$row[3] $row[2]</td>");}else{print("<td class=\"linia_noactive\">$row[3] $row[2]</td>");}
            print("<td class=\"\">$row[4]</td>");
            print("<td class=\"\">$row[6]</td>");
            print("<td class=\"\">$row[5]</td>");
            print("<td><a href=\"javascript:getData('confirm_delete_trans.php?id=$row[0]','field'),czysc_ekran();\">+</a></td>");
		
        echo '</tr>';
	}
	

echo '</table>';
echo '<button id="button_more_trans">Pokaż Więcej</button>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");

mysqli_close($conn);
?>

