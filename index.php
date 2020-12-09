<?php
session_start();
require ('strona_db.inc');

$stronaglowna = new Strona1();

$stronaglowna -> tresc = '';

$stronaglowna -> title = 'Bazy Danych - Projekt';

$stronaglowna -> Wyswietl();
?>
