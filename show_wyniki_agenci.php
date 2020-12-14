<?php

$w[1] = htmlentities($_GET["w1"]);//id jako atrybut value elementu option
$w[2] = htmlentities($_GET["w2"]);//id stanowiska
$w[3] = htmlentities($_GET["w3"]);//data od 
$w[4] = htmlentities($_GET["w4"]);//data do
$w[5] = "z";//miejsce na group by
$w[6] = htmlentities($_GET["w5"]);//sortuj sredia
$w[7] = htmlentities($_GET["w6"]);//sortuj ogólem
$w[8] = htmlentities($_GET["w7"]);//sortuj liczba



//filtracja agent_id z przesłanego mixu: imie nazwisko id
  require_once 'config_db.php';
  $zapytanie2 = "SELECT * FROM agenci a WHERE status='1'";
  $result = mysqli_query($conn, $zapytanie2);
  if($result != TRUE){echo 'Bład zapytania MySQL5, odpowiedź serwera: '.mysqli_error($conn);} 


$zapytanie = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa, AVG( o.cena ) , COUNT( * ), SUM(o.cena) 
FROM oferty o, agenci a, tranzakcje t, stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id
AND a.status = '1'
AND t.agent_id = a.agent_id
AND o.oferta_id = t.oferta_id
";

$add[1] = " AND a.agent_id='".$w[1]."'";
$add[2] = " AND s.stanowisko_id='".$w[2]."'";
$add[3] = " AND t.data>='".$w[3]."'";
$add[4] = " AND t.data<='".$w[4]."'";
$add[5] = " GROUP BY a.nazwisko";
$add[6] = " ORDER BY AVG( o.cena ) DESC";
$add[7] = " ORDER BY SUM(o.cena) DESC";
$add[8] = " ORDER BY COUNT( * ) DESC";

for($i=1;$i<=5;$i++)
{
  if($w[$i] != 'x')
  {
  	$zapytanie = $zapytanie.$add[$i];
  }
}

for($i=6;$i<=8;$i++)
{
  if($w[$i] == 'x')
  {
  	$zapytanie = $zapytanie.$add[$i];
  }
}					


echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"\">id</td>");
print("<td class=\"\">imie</td>");
print("<td class=\"\">nazwisko</td>");
print("<td class=\"\">stanowisko</td>");
print("<td class=\"\">sprzedaż<br />(ogółem)</td>");
print("<td class=\"\">ilość<br />tranzakcji</td>");
print("<td class=\"\">średnia<br />sprzedaży</td>");

//echo '<td>usuń</td>';
echo '</tr>';

$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
            		
	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
	{
		
        print("<tr>");

        print("<td class=\"\">$row[0]</td>");
        print("<td class=\"\">$row[1]</td>");
        print("<td class=\"\">$row[2]</td>");
        print("<td class=\"\">$row[3]</td>");
        print("<td class=\"\">$row[6]</td>");
        print("<td class=\"\">$row[5]</td>");
        $temp = round($row[4],0);
        print("<td class=\"\">$temp</td>");
		
//        print("<td><a href=\"javascript:getData('usun_agent.php?m=$row[0]','field');\">+</a></td>");
				
        echo '</tr>';
	}

/*        
//agenci, którzy jeszcze nic nie sprzedali i nie są w transakcjach
$zapytanie2 = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa FROM agenci a, stanowisko s WHERE a.status='1'";
$tanie2 = " AND a.stanowisko_id=s.stanowisko_id AND a.agent_id NOT IN (SELECT t.agent_id FROM tranzakcje t)";
$add[1] = " AND a.agent_id='".$w[1]."'";
$add[2] = " AND a.stanowisko_id='".$w[2]."'";
//$middle = " AND a.stanowisko_id='".$w[2]."'";
for($i=1;$i<=2;$i++)
{
  if($w[$i] != 'x')
  {
  	$zapytanie2 = $zapytanie2.$add[$i];
  }
}
$zapytanie2 = $zapytanie2.$tanie2;

$result2 = mysqli_query($conn, $zapytanie2);
if($result2 != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}
            		
	while($row2 = mysqli_fetch_array($result2, MYSQLI_NUM))
	{
		
        print("<tr>");

        print("<td class=\"\">$row2[0]</td>");
        print("<td class=\"\">$row2[1]</td>");
        print("<td class=\"\">$row2[2]</td>");
        print("<td class=\"\">$row2[3]</td>");
        print("<td class=\"\">0</td>");
        print("<td class=\"\">0</td>");
        print("<td class=\"\">0</td>");
		
//        print("<td><a href=\"javascript:getData('usun_agent.php?m=$row[0]','field');\">+</a></td>");
				
        echo '</tr>';
	}
*/

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
//<br />+<br /> ".$zapytanie2."

?>