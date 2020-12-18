<?php

class Strona1
{
    public $tresc;
    public $title;
    public $keywords;
    public $description;
    public $metas;
    public $przyciski_poz = array('Home Page' => 'index.php',
                                  'Wyszukaj' => '',
                                  'Wprowadź' => ''
                              );
    public $przyciski_pion = array('Przycisk pionowy 1' => '',
                                   'Przycisk pionowy 2' => '',
                                   'Przycisk pionowy 3' => '',
                                   'Przycisk pionowy 4' => '',
                                   'Przycisk pionowy 5' => ''
                              );
    public $stopka = 'Jakub Lubas, Wiktor Stącel &#169; 2010. Wszelkie prawa zastrzeżone.';

    public function _set($nazwa, $wartosc)
    {
        $this -> nazwa = $wartosc;
    }

    public function Wyswietl()
    {
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">';
        echo "<html>\n<head>\n";
        $this -> WyswietlTytul();
        $this -> WyswietlSlowaKluczowe();
        $this -> WyswietlOpis();
        $this -> WyswietlMeta();
        $this -> WyswietlStyle();
        $this -> WyswietlSkrypty();
        echo "</head>\n<body onLoad=\"getData('main_wyszukaj.php','field')\">\n";
        echo '<div id="MAINBLOCK">';
        $this -> WyswietlNaglowek();
        $this -> WyswietlTresc();
        $this -> WyswietlStopke();
        echo '</div>';
        echo "</body>\n</html>\n";
    }

    public function WyswietlTytul()
    {
        echo "<title> $this->title </title>\n";
    }

    public function WyswietlSlowaKluczowe()
    {
        echo "<meta name=\"keywords\" content=\"$this->keywords\" />\n";//Funkcja htmlentities powoduje zastąpienie niedozwolonych znaków HTML-a na odpowiednie wartości, tzw. entities. Np. znak < zamienia na &lt; znak > na &gt; itd. Dzięki temu po dodaniu tekstu zawierającego takie znaki będą one widoczne na wygenerowanej stronie.
    }

    public function WyswietlOpis()
    {
        echo "<meta name=\"description\" content=\"$this->description\" />\n";
    }

    public function WyswietlMeta()
    {
        echo '  <meta name="robots" content="index, follow">
                <meta name="language" content="pl">
                <meta http-equiv="Content-Language" content="pl">
                <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
                <meta http-equiv="Content-Script-Type" content="text/javascript">';
    }

    public function WyswietlStyle()
    {
        echo "<link rel=\"Stylesheet\" type=\"text/css\" href=\"css/css_db.css\" />\n";
    }

    public function WyswietlSkrypty()
    {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
        echo '<script language="JavaScript" type="text/javascript" src="js/scrypt_db.js"></script>'; 
    }

    public function WyswietlNaglowek()
    {
        echo '<div id="NAGLOWEK"><p>AGENCJA NIERUCHOMOŚCI - PROJEKT</p></div>';
    }


    public function WyswietlTresc()
    {
        echo '<div id="page">
	  
            <div id="menu">
                <ul>';
                print("<li id=\"m1\" class=\"noactive\"><a href=\"javascript:getData('main_wyszukaj.php','field'),czysc_ekran();\">Wyszukaj</a></li>");
                print("<li id=\"m2\" class=\"noactive\"><a href=\"javascript:getData('main_wprowadz.php','field'),czysc_ekran(),focus('p0');\">Wprowadź</a></li>");
                print("<li id=\"m3\" class=\"noactive\"><a href=\"javascript:getData('main_transakcje.php?id=0','field'),czysc_ekran();\">Transakcje</a></li>");
                print("<li id=\"m4\" class=\"noactive\"><a href=\"javascript:getData('main_agenci.php','field'),czysc_ekran();\">Agenci</a></li>");
                print("<li id=\"m5\" class=\"noactive\"><a href=\"javascript:getData('main_about.php','field'),czysc_ekran();\">O projekcie</a></li>");
                echo'</ul>
            </div>
            
            <div id="box">			
                <div id="content">			     
                    <div id="field">
                    </div>					
                </div>	
            </div>
        </div>
      ';

    }

    public function WyswietlStopke()
    {
        echo'<div id="ekran"></div>';
        echo'<div id="ekran1"></div>';
        echo'<div id="ekran2"></div>';
        //echo'<div id="ekran3"></div>';
        echo "<br /><br /><br /><div id=\"STOPKA\">$this->stopka</div>";
        echo '<script language="JavaScript" type="text/javascript" src="js/jquery_db.js"></script>';           
    }

}

?>
