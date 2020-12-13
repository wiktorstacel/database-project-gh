var XMLHttpRequestObject = false;
if (window.XMLHttpRequest)
{
  XMLHttpRequestObject = new XMLHttpRequest();
}
else if (window.ActiveXObject)
{
  XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function getData(dataSource, divID)
{
  if(XMLHttpRequestObject)
  {
    var obj = document.getElementById(divID);
    XMLHttpRequestObject.open("GET", dataSource);

    XMLHttpRequestObject.onreadystatechange = function()
    {
      if (XMLHttpRequestObject.readyState == 4 &&
          XMLHttpRequestObject.status == 200)
      {
      obj.innerHTML = XMLHttpRequestObject.responseText;
      }
    }
    XMLHttpRequestObject.send(null);
  }
}

//konstruuje odpowiedni adres php, który przez GET prześle dane i wygeneruje odpowiedź z MySQL
function show_oferty()
{
    if(sprawdz_show_oferty() == true) //czy pola wejściowe wprowadzania oferty są wypełnione poprawnie
    {
    adres = "show_oferty.php?";
    for(i=1;i<=7;i++)
	{
		if(document.getElementById("p"+i).value == "-wszystkie-" || document.getElementById("p"+i).value == "" || document.getElementById("p"+i).checked)
		{
		  adres = adres + "p" + i + "=x" +"&";	
		}
		else
		{
		  adres = adres + "p" + i + "=" + document.getElementById("p"+i).value + "&";
		}
	}
//	document.getElementById("ekran").innerHTML = adres;
    Zapytanie(adres);//AJAX
    }
}

//sprawdza czy pola wyszukiwarki ofert są uzupełnione poprawnie
function sprawdz_show_oferty()
{
	a=0;
	for(i=4;i<=5;i++)
	{	
	    var pole = document.getElementById("p"+i);
            document.getElementById("alert"+i).innerHTML = "";//czyszczenie alertów jeśli były wcześńiej wyświetlone

            litPatt = /^[0-9]{1,9}$/;
            wynik = pole.value.match(litPatt);
            if(pole.value != "")
            {
                if(wynik==null)
                {
                document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie! Tylko cyfry - max: 9";
                a++;
                }
            }
	}
	if(a>0)
	{
		alert("Popraw zaznaczone pola");
		return false;
	}
	else
	{
		return true;
	}
}

/*function insert_db()
{
    adres = "zapisz_oferte.php?"; //!!! to idzie przez innerHTML
    for(i=0;i<=9;i++)
	{
	  if(document.getElementById("p"+i).value == "-wszystkie-" || document.getElementById("p"+i).value == "")
		
	
	  adres = adres + "p" + i + "=" + document.getElementById("p"+i).value + "&";

	}
//	document.getElementById("ekran").innerHTML = adres;
	Zapytanie(adres);
	
}*/

//Wstawia okreslone miasta dla wybranego wczesniej wojewodztwa
function insert_miasto()
{
	var a = document.getElementById("p2").value;
	getData("insert_miasto.php?woj="+a, "p3");
}

var xmlHttp;

function Zapytanie(adres){
      if(xmlHttp==null){ //w zależności od przeglądarki tworzymy obiekt XMLHTTP
         if(window.ActiveXObject)xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); //dla IE
	 else if(window.XMLHttpRequest)xmlHttp = new XMLHttpRequest();  //Firefox, Opera, Safari itp.
      }
      if (xmlHttp == null){alert("Nie udało się zainicjować obiektu xmlHttpRequest!");return;} //jeśli obiekt nie został utworzony, zwracamy, błąd a skrypt zostaje przerwany
      
      xmlHttp.onreadystatechange = function(){ //funkcja ma za zadanie wyświetlić wyniki zwrócone przez serwer
         if (xmlHttp.readyState == 4 || xmlHttp.status == 200) //sprawdzamy czy udało się pobrać zawartość strony (readyState=4) lub czy serwer nie zwrócił błędu(status=200 oznacza że jest OK)
         document.getElementById("ekran2").innerHTML = xmlHttp.responseText; //zwrócony tekst zapisujemy do warstwy 
      };   
      xmlHttp.open("GET", adres); //ustawiamy metodę i adres żądania
      xmlHttp.send(null); //wysyłamy żądanie
}

function sprawdz_save_oferta()
{
	a=0;
	for(i=0;i<=8;i++)
	{	
	    var pole = document.getElementById("p"+i);
            document.getElementById("alert"+i).innerHTML = "";
            litPatt = /^\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\?|\/|\""|\;|\:|\s$/;
            if(i==0 || i==5 || i==8){litPatt = /^\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\+|\=|\[|\{|\]|\}|\||\'|\<|\>|\?|\""|\;|\s$/;}
            wynik = pole.value.match(litPatt);
            if (!pole.disabled && (pole.value == "-wszystkie-" || pole.value == "" || pole.value == "-wybierz-" || wynik!=null))
            {	
                a++;
                if(wynik!=null)
                {
                    document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie! Niedozwolony znak: "+wynik;
                }
                else
                {
                    document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie!";                           
                }

            }
            if((i==6 || i== 7)) //sprawdzenie pól powierchnia i cena - czy są liczbami
            {
                litPatt = /^[0-9]{1,9}$/;
                wynik = pole.value.match(litPatt);
                if(wynik==null)
                {
                document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie! Tylko cyfry - max: 9";
                a++;
                }	
            }
	}
	if(a>0)
	{
		alert("Popraw zaznaczone pola");
		return false;
	}
	else
	{
		return true;
	}
}

function action_save_oferta()
{
	if(sprawdz_save_oferta() == true) //czy pola wejściowe wprowadzania oferty są wypełnione poprawnie
	{
    adres = "action_save_oferta.php?";
    for(i=0;i<=8;i++)
	{
		if(document.getElementById("p"+i).value == "-wszystkie-" || document.getElementById("p"+i).value == "" || document.getElementById("p"+i).disabled)
		{
		  adres = adres + "p" + i + "=x" +"&";	
		}
		else
		{
		  adres = adres + "p" + i + "=" + document.getElementById("p"+i).value + "&";
		}
	}
//	document.getElementById("ekran").innerHTML = adres;
//	Zapytanie(adres);
//	getData('komunikat.php','field');
        getData(adres,'field')
	}
}

function suggest_miasto(event)
{  
    if(event.keyCode!=13)
    {
        Zapytanie2("suggest_miasto.php?tek="+document.getElementById("p4").value);
    }
    else
    {
        document.getElementById("p4").value = document.getElementById("p3").value;
    }
    document.getElementById("alert3").innerHTML = "";
    document.getElementById("alert4").innerHTML = "";
}

//dziala tylko z funkcją suggest_miast()
function Zapytanie2(adres){
      if(xmlHttp==null){ //w zależności od przeglądarki tworzymy obiekt XMLHTTP
         if(window.ActiveXObject)xmlHttp = new ActiveXObject("Microsoft.XMLHTTP"); //dla IE
	 else if(window.XMLHttpRequest)xmlHttp = new XMLHttpRequest();  //Firefox, Opera, Safari itp.
      }
      if (xmlHttp == null){alert("Nie udało się zainicjować obiektu xmlHttpRequest!");return;} //jeśli obiekt nie został utworzony, zwracamy, błąd a skrypt zostaje przerwany
      
      xmlHttp.onreadystatechange = function(){ //funkcja ma za zadanie wyświetlić wyniki zwrócone przez serwer
         if (xmlHttp.readyState == 4 || xmlHttp.status == 200) //sprawdzamy czy udało się pobrać zawartość strony (readyState=4) lub czy serwer nie zwrócił błędu(status=200 oznacza że jest OK)
         document.getElementById("alert4").innerHTML = xmlHttp.responseText; //zwrócony tekst zapisujemy do warstwy 
      };   
      xmlHttp.open("GET", adres); //ustawiamy metodę i adres żądania
      xmlHttp.send(null); //wysyłamy żądanie
}

function wstaw(i)
{
	document.getElementById("p4").value = document.getElementById("sug"+i).innerHTML
	document.getElementById("alert4").innerHTML = "";
}

function czysc_ekran()
{
	document.getElementById("ekran1").innerHTML = "";
	document.getElementById("ekran2").innerHTML = "";
	document.getElementById("ekran3").innerHTML = "";
	document.getElementById("ekran").innerHTML = "";
        scroll(0,0);
}

function askprice(price)
{
	document.getElementById("alertprice").innerHTML = price;
}

function insert_price()
{
	var a = document.getElementById("t1").value;
	getData("insert_price.php?oferta_id="+a, "alertprice");
}

function fokus(AElementID)
{
    var el = document.getElementById(AElementID);
	document.getElementById(AElementID).value = "pyk";
    el.focus();
}

//Sprawdza czy pola wprowadzania transakcji mają poprawne wartości
function sprawdz_save_tranzakcja()
{
    a=0;
    for(i=1;i<=3;i++)
    {

        var pole = document.getElementById("t"+i);
        document.getElementById("alert"+i).innerHTML = "";
        litPatt = /^\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\?|\/|\""|\;|\:|\s$/;
        wynik = pole.value.match(litPatt);
        if (!pole.disabled && (pole.value == "-wszystkie-" || pole.value == "" || pole.value == "-wybierz-" || wynik!=null))
        {	
            a++;
            if(wynik!=null)
            {
                document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie! Niedozwolony znak: "+wynik;
            }
            else
            {
                document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie!";                           
            }

        }			
    }
    if(a>0)
    {
            alert("Popraw zaznaczone pola");
            return false;
    }
    else
    {
            return true;
    }
}

function action_save_trans()
{
    if(sprawdz_save_tranzakcja() == true)//czy pola wejściowe transkacji wypełnione poprawnie
    {
    adres = "action_save_trans.php?";
    for(i=1;i<=3;i++)
    {
            if(document.getElementById("t"+i).value == "-wybierz-" || document.getElementById("t"+i).value == "" || document.getElementById("t"+i).disabled)
            {
              adres = adres + "t" + i + "=x" +"&";	
            }
            else
            {
              adres = adres + "t" + i + "=" + document.getElementById("t"+i).value + "&";
            }
    }
//	document.getElementById("ekran").innerHTML = adres;
//	Zapytanie(adres);
//	getData('komunikat.php','field')
    getData(adres,'field');
    }
}

//Czy pola wprowadzania nowego agenta wypełnione są poprawnie
function sprawdz_save_agent()
{
    a=0;
    for(i=1;i<=3;i++)
    {

        var pole = document.getElementById("a"+i);
        document.getElementById("alert"+i).innerHTML = "";
        litPatt = /^\`|\~|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\+|\=|\[|\{|\]|\}|\||\\|\'|\<|\,|\.|\>|\?|\/|\""|\;|\:|\s$/;
        wynik = pole.value.match(litPatt);
        if (!pole.disabled && (pole.value == "-wszystkie-" || pole.value == "" || pole.value == "-wybierz-" || wynik!=null))
        {	
            a++;
            if(wynik!=null)
            {
                document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie! Niedozwolony znak: "+wynik;
            }
            else
            {
                document.getElementById("alert"+i).innerHTML = " Wprowadź poprawnie!";                           
            }

        }			

    }
    if(a>0)
    {
            alert("Popraw zaznaczone pola");
            return false;
    }
    else
    {
            return true;
    }
}

function action_save_agent()
{
	if(sprawdz_save_agent() == true)//czy pola wprowadzenia nowego agenta wypełnione poprawnie
	{
            adres = "action_save_agent.php?";
            for(i=1;i<=3;i++)
            {
		if(document.getElementById("a"+i).value == "-wszystkie-" || document.getElementById("a"+i).value == "" || document.getElementById("a"+i).disabled)
		{
		  adres = adres + "a" + i + "=x" +"&";	
		}
		else
		{
		  adres = adres + "a" + i + "=" + document.getElementById("a"+i).value + "&";
		}
            }
//	document.getElementById("ekran").innerHTML = adres;
//	Zapytanie(adres);
//	getData('komunikat.php','field')
        getData(adres,'field');
	}
}

function action_status_agent(a,s)
{
        scroll(0,0);
        adres = "action_status_agent.php?m="+a+"&status="+s;
	//Zapytanie(adres); //wstawia odpowiedź serwera na rządany 'adres' w pole 'ekran2'
	//getData('komunikat.php','field')
        getData(adres,'field');
}

//Czy pola wejściowe statystyk agentów są wypelnione poprawnie
function sprawdz_wyniki_agenci()
{
	a=0;
	for(i=1;i<=4;i++)
	{
            var pole = document.getElementById("w"+i);
            document.getElementById("alertw"+i).innerHTML = ""; //czyszczenie alertów

            if(i==3 || i==4)//sprawdzenie poprawności formatu daty
            {
                litPatt = /^[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/;
                wynik = pole.value.match(litPatt);
                if(wynik==null)
                {
                      document.getElementById("alertw"+i).innerHTML = " Wprowadź poprawnie!";
                      a++;
                }
            }

            if (!pole.disabled && (pole.value == "" || pole.value == "" || pole.value == ""))
            {	
                    document.getElementById("alertw"+i).innerHTML = " Wprowadź poprawnie!";
                    a++;
            }
	}
	if(a>0)
	{
		alert("Popraw zaznaczone pola");
		return false;
	}
	else
	{
		return true;
	}
}

function show_wyniki_agenci()
{
	if(sprawdz_wyniki_agenci() == true)
	{
    adres = "show_wyniki_agenci.php?";
    for(i=1;i<=7;i++)
	{
		if(document.getElementById("w"+i).value == "-wszyscy-" || document.getElementById("w"+i).value == "-wszystkie-" || document.getElementById("w"+i).disabled || document.getElementById("w"+i).checked)
		{
		  adres = adres + "w" + i + "=x" +"&";	
		}
		else
		{
		  adres = adres + "w" + i + "=" + document.getElementById("w"+i).value + "&";
		}
	}
//	document.getElementById("ekran").innerHTML = adres;
	Zapytanie(adres);
//	getData('komunikat.php','field')
	}
}