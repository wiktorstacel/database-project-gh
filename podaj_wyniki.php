<?php

$w[1] = $_GET["w1"];//nazwisko imie id mix
$w[2] = $_GET["w2"];//stanowiska
$w[3] = $_GET["w3"];//data od 
$w[4] = $_GET["w4"];//data do
$w[5] = "z";//miejsce na group by
$w[6] = $_GET["w5"];//sortuj sredia
$w[7] = $_GET["w6"];//sortuj ogólem
$w[8] = $_GET["w7"];//sortuj liczba



//filtracja agent_id z przesłanego mixu: imie nazwisko id
  require 'config_db.php';
  $zapytanie2 = "SELECT * FROM Agenci a";
  $result = mysqli_query($conn, $zapytanie2);
  if($result != TRUE){echo 'Bład zapytania MySQL5, odpowiedź serwera: '.mysqli_error($conn);}


            		while($row = mysqli_fetch_array($result,MYSQLI_NUM))
					{
					    if(preg_match(sprintf("/%s/", $row[0]), sprintf("/%s/", $w[1]))) //if id agenta jest w ciągu znaków przekazanych z pola 'agent sprzedajacy'
					    {
						$w[1]=$row[0]; //id agenta do wstawienia w 'tranzakcje'
						}
					} 

if($w[2] != 'x')
{					
//wylowienie id stanowiska					
$zapytanie1 = "SELECT stanowisko_id FROM Stanowisko WHERE nazwa='".$w[2]."'";
$result = mysqli_query($conn, $zapytanie1);
if($result != TRUE){echo 'Bład zapytania MySQL1, odpowiedź serwera: '.mysqli_error($conn);}
            		$row = mysqli_fetch_array($result);
					
					$w[2]=$row["stanowisko_id"];  //id stanowiska do wstawienia w 'oferty'
					print("<b>MySQL1: </b><div id=\"ekran1.1\">".$zapytanie1."</div><div>Odp:".$w[2]."</div>");					
}					
//konstruujemy zaytanie

$zapytanie = "SELECT a.agent_id, a.imie, a.nazwisko, s.nazwa, AVG( o.cena ) , COUNT( * ), SUM(o.cena) 
FROM Oferty o, Agenci a, Tranzakcje t, Stanowisko s
WHERE a.stanowisko_id = s.stanowisko_id
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
print("<td class=\"agent\">id</td>");
print("<td class=\"name\">imie</td>");
print("<td class=\"kind\">nazwisko</td>");
print("<td class=\"state\">stanowisko</td>");
print("<td class=\"town\">sprzedaż<br />(ogółem)</td>");
print("<td class=\"count\">ilość<br />tranzakcji</td>");
print("<td class=\"town\">średnia<br />sprzedaży</td>");

//echo '<td>usuń</td>';
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
        $temp = round($row[4],2);
        print("<td class=\"srednia\">$temp</td>");
		
//        print("<td><a href=\"javascript:getData('usun_agent.php?m=$row[0]','field');\">+</a></td>");
				
        echo '</tr>';
	}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");



?>