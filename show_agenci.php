<?php
$status = htmlentities($_GET['status'], ENT_QUOTES, "UTF-8");// 0 - były pracownik; 1 - obecny pracownik
require_once 'config_db.php';
$status = mysqli_real_escape_string($conn, $status);

$zapytanie = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa 
FROM agenci a, stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id AND a.status = '$status'
ORDER BY a.agent_id ASC";

echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"\">id</td>");
print("<td class=\"\">imie</td>");
print("<td class=\"\">nazwisko</td>");
print("<td class=\"\">stanowisko</td>");
//print("<td class=\"\">sprzedaż<br />(ogółem)</td>");
//print("<td class=\"\">ilość<br />tranzakcji</td>");
//print("<td class=\"\">średnia<br />sprzedaży</td>");
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

    print("<td class=\"\">$row[0]</td>");
    print("<td class=\"\">$row[1]</td>");
    print("<td class=\"\">$row[2]</td>");
    print("<td class=\"\">$row[3]</td>");
    //        print("<td class=\"\">$row[6]</td>");
    //        print("<td class=\"\">$row[5]</td>");
    //        $temp = round($row[4],2);
    //        print("<td class=\"\">$temp</td>");

    print("<td><a href=\"javascript:action_status_agent($row[0],$status);\">+</a></td>");		

    echo '</tr>';
}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");

mysqli_close($conn);
?>