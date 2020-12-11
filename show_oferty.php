<?php

$p[1] = $_GET["p1"];
$p[2] = $_GET["p2"];
$p[3] = $_GET["p3"];
$p[4] = $_GET["p4"];
$p[5] = $_GET["p5"];
$p[6] = $_GET["p6"];//aktualne
$p[7] = $_GET["p7"];//nieaktualne

$add[1] = " AND r.nazwa='".$p[1]."'";
$add[2] = " AND w.nazwa='".$p[2]."'";
$add[3] = " AND m.nazwa='".$p[3]."'";
$add[4] = " AND o.cena>=".$p[4]."";
$add[5] = " AND o.cena<=".$p[5]."";
$add[6] = " AND o.stan=".$p[6]."";
$add[7] = " AND o.stan=".$p[7]."";

$zapytanie = "SELECT o.nazwa, r.nazwa, w.nazwa, m.nazwa, o.ulica, o.powierzchnia, o.cena, o.opis, o.oferta_id, o.stan FROM  Oferty o, Rodzaj r, Wojewodztwo w, Miejscowosc m 
WHERE o.rodzaj_id=r.rodzaj_id
AND o.wojewodztwo_id=w.wojewodztwo_id
AND o.miejscowosc_id=m.miejscowosc_id";


for($i=1;$i<=7;$i++)
{
  if($p[$i] != 'x')
  {
  	$zapytanie = $zapytanie.$add[$i];
  }
}


echo "<table class='lista_art'>";
echo "<tr class='listwa'>";
print("<td class=\"\">id</td>");
print("<td class=\"\">nazwa</td>");
print("<td class=\"\">rodzaj</td>");
print("<td class=\"\">wojewodztwo</td>");
print("<td class=\"\">miejscowość</td>");
print("<td class=\"\">adres</td>");
print("<td class=\"\">m<sup>2</sup></td>");
print("<td class=\"\">cena</td>");
print("<td class=\"\">opis</td>");
echo '<td>zakup</td>';
echo '</tr>';

require 'config_db.php';
$result = mysqli_query($conn, $zapytanie);
if($result != TRUE){echo 'Bład zapytania MySQL, odpowiedź serwera: '.mysqli_error($conn);}           		
while($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
    if($row[9] == "1")
    {
        print("<tr>");
    }
    else
    {
        print("<tr class=\"linia_noactive\">");
    }
    print("<td class=\"\">$row[8]</td>");
    print("<td class=\"\">$row[0]</td>");
    print("<td class=\"\">$row[1]</td>");
    print("<td class=\"\">$row[2]</td>");
    print("<td class=\"\">$row[3]</td>");
    print("<td class=\"\">$row[4]</td>");
    print("<td class=\"\">$row[5]</td>");
    print("<td class=\"\">$row[6]</td>");
    print("<td class=\"\">$row[7]</td>");
    if($row[9] == "1")
    {
        print("<td><a href=\"javascript:getData('main_transakcje.php?m=$row[8]','field'),czysc_ekran();\">+</a></td>");
    }
    else
    {
        print("<td>+</td>");
    }

    echo '</tr>';
}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
?>