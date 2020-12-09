<?php

$zapytanie = "SELECT t.tranzakcja_id, o.nazwa, a.nazwisko, a.agent_id, t.klient, t.data, o.cena, m.nazwa, o.ulica FROM  Oferty o, Agenci a, Tranzakcje t, Miejscowosc m
WHERE t.oferta_id=o.oferta_id AND t.agent_id=a.agent_id AND m.miejscowosc_id=o.miejscowosc_id ORDER BY t.data DESC";

require 'config_db.php';

echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"agent\">numer</td>");
print("<td class=\"name\">nazwa</td>");
print("<td class=\"address\">adres</td>");
print("<td class=\"kind\">agent sprzedający</td>");
print("<td class=\"state\">klient</td>");
print("<td class=\"price\">suma</td>");
print("<td class=\"town\">data</td>");
echo '<td>anuluj</td>';
echo '</tr>';

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
            		
	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
	{
		
        print("<tr>");

		print("<td class=\"id\">$row[0]</td>");
		print("<td class=\"name\">$row[1]</td>");
		print("<td class=\"address\">$row[7], $row[8]</td>");
		print("<td class=\"kind\">$row[2] id: $row[3]</td>");
		print("<td class=\"state\">$row[4]</td>");
		print("<td class=\"price\">$row[6]</td>");
		print("<td class=\"town\">$row[5]</td>");

        print("<td><a href=\"javascript:getData('anuluj_tranz.php?m=$row[0]','field');\">+</a></td>");
		
		
		echo '</tr>';
	}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
?>