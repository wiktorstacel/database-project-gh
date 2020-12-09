<?php

$zapytanie = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa, AVG( o.cena ) , COUNT( * ), SUM(o.cena) 
FROM Oferty o, Agenci a, Tranzakcje t, Stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id
AND t.agent_id = a.agent_id
AND o.oferta_id = t.oferta_id
GROUP BY a.nazwisko
ORDER BY AVG( o.cena ) DESC";

require 'config_db.php';

echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"agent\">id</td>");
print("<td class=\"name\">imie</td>");
print("<td class=\"kind\">nazwisko</td>");
print("<td class=\"state\">stanowisko</td>");
print("<td class=\"town\">sprzedaż<br />(ogółem)</td>");
print("<td class=\"count\">ilość<br />tranzakcji</td>");
print("<td class=\"town\">średnia<br />sprzedaży</td>");

echo '<td>usuń</td>';
echo '</tr>';

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
            		
	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
	{
		
        print("<tr>");

		print("<td class=\"id\">$row[0]</td>");
		print("<td class=\"name\">$row[1]</td>");
		print("<td class=\"kind\">$row[2]</td>");
		print("<td class=\"state\">$row[3]</td>");
		print("<td class=\"sprzedaz\">$row[6]</td>");
		print("<td class=\"count\">$row[5]</td>");
		print("<td class=\"srednia\">$row[4]</td>");
		

        print("<td><a href=\"javascript:getData('usun_agent.php?m=$row[0]','field');\">+</a></td>");
		
		
		echo '</tr>';
	}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");

?>