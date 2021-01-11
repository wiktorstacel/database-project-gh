<?php
session_start();
require ('strona_db.inc');

$stronaglowna = new Strona1();

$stronaglowna -> tresc = '';

$stronaglowna -> title = 'Bazy Danych - Projekt';

$stronaglowna -> keywords = 'Relacyjne, Bazy, Danych, SQL';

$stronaglowna -> description = 'Relacyjne bazy danych - edukacja, przykłady, materiały szkolenie';

$stronaglowna -> Wyswietl();
?>
