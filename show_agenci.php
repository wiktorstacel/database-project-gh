<?php

$status = $_GET['status']; // 0 - były pracownik; 1 - obecny pracownik

$zapytanie = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa 
FROM Agenci a, Stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id AND a.status = ".$status."
ORDER BY a.nazwisko ASC";

require 'config_db.php';

echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"agent\">id</td>");
print("<td class=\"name\">imie</td>");
print("<td class=\"kind\">nazwisko</td>");
print("<td class=\"state\">stanowisko</td>");
//print("<td class=\"town\">sprzedaż<br />(ogółem)</td>");
//print("<td class=\"count\">ilość<br />tranzakcji</td>");
//print("<td class=\"town\">średnia<br />sprzedaży</td>");
if($status == 0)
{
    echo '<td>przywróć</td>';
}
else
{
    echo '<td>usuń</td>';
}
echo '</tr>';

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
    if($status == 1){print("<tr>");}else{print("<tr class=\"linia_noactive\">");};

    print("<td class=\"id\">$row[0]</td>");
    print("<td class=\"name\">$row[1]</td>");
    print("<td class=\"kind\">$row[2]</td>");
    print("<td class=\"state\">$row[3]</td>");
    //        print("<td class=\"sprzedaz\">$row[6]</td>");
    //        print("<td class=\"count\">$row[5]</td>");
    //        $temp = round($row[4],2);
    //        print("<td class=\"srednia\">$temp</td>");

    print("<td><a href=\"javascript:action_status_agent($row[0],$status);\">+</a></td>");		

    echo '</tr>';
}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");

?>