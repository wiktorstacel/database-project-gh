<?php

$p[1] = $_GET["p1"];//nazwa
$p[2] = $_GET["p2"];//wojewodztwo
$p[3] = $_GET["p3"];//miasto
$p[4] = $_GET["p4"];//cena min
$p[5] = $_GET["p5"];//cena max
$p[6] = $_GET["p6"];//aktualne
$p[7] = $_GET["p7"];//nieaktualne
$p[8] = 'y';

$add[1] = " AND r.rodzaj_id='".$p[1]."'";
$add[2] = " AND w.wojewodztwo_id='".$p[2]."'";
$add[3] = " AND m.miejscowosc_id='".$p[3]."'";
$add[4] = " AND o.cena>=".$p[4]."";
$add[5] = " AND o.cena<=".$p[5]."";
$add[6] = " AND o.stan=".$p[6]."";
$add[7] = " AND o.stan=".$p[7]."";
$add[8] = " ORDER BY o.oferta_id DESC";

$zapytanie = "SELECT o.nazwa, r.nazwa, w.nazwa, m.nazwa, o.ulica, o.powierzchnia, o.cena, o.opis, o.oferta_id, o.stan FROM  Oferty o, Rodzaj r, Wojewodztwo w, Miejscowosc m 
WHERE o.rodzaj_id=r.rodzaj_id
AND o.wojewodztwo_id=w.wojewodztwo_id
AND o.miejscowosc_id=m.miejscowosc_id";


for($i=1;$i<=8;$i++)
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
echo '<td>usuń</td>';
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
        print("<td><a href=\"javascript:getData('main_transakcje.php?id=$row[8]','field'),czysc_ekran();\">+</a></td>");
        print("<td><a href=\"javascript:getData('action_delete_oferta.php?id=$row[8]','field'),czysc_ekran();\">+</a></td>");
    }
    else
    {
        print("<td>-></td>");
        $zapytanie4="SELECT tranzakcja_id FROM Tranzakcje WHERE oferta_id='".$row[8]."'";
        $result4 = mysqli_query($conn, $zapytanie4);
        if($result4 != TRUE){echo 'Bład zapytania MySQL4, odpowiedź serwera: '.mysqli_error($conn);}
        $row4 = mysqli_fetch_array($result4, MYSQLI_NUM);
        print("<td>T$row4[0]</td>");
    }

    echo '</tr>';
}
	

echo '</table>';
print("<br /><br /><br /><b>MySQL: </b><div id=\"ekran3\">".$zapytanie."</div>");
?>