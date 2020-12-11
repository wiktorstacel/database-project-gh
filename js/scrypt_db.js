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

function show_oferty()
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
	Zapytanie(adres);
	
}

function insert_db()
{
    adres = "zapisz_oferte.php?"; //!!! to idzie przez innerHTML
    for(i=0;i<=9;i++)
	{
	  if(document.getElementById("p"+i).value == "-wszystkie-" || document.getElementById("p"+i).value == "")
		
	
	  adres = adres + "p" + i + "=" + document.getElementById("p"+i).value + "&";

	}
//	document.getElementById("ekran").innerHTML = adres;
	Zapytanie(adres);
	
}

function intown()
{
	var a = document.getElementById("p2").value;
	getData("town.php?woj="+a, "p3");
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

function sprawdz()
{
	a=0;
	for(i=0;i<=8;i++)
	{
	
	    var pole = document.getElementById("p"+i);
		document.getElementById("alert"+i).innerHTML = "";
		if (!pole.disabled && (pole.value == "-wszystkie-" || pole.value == "" || pole.value == "-wybierz-"))
		{
			
			document.getElementById("alert"+i).innerHTML = " wprowadź poprawnie!";
			a++;			
/*Operator typeof() zwraca string z nazwą typu jaki ma przekazany parametr (np. zmienna). Może on zwrócić jedną z podanych wartości: "number", "string", "boolean", "object", "function" lub "undefined". Zatem aby sprawdzić czy np. zmienna ma wartość undefined, należy sprawdzić czy wartość zwrócona przez typeof() jest równa undefined*/
			
		}
		if((i==6 || i== 7))		//sprawdzenie pól powierchnia i cena - czy są liczbami
			{
			litPatt = /^[0-9]{1,8}$/;
			wynik = pole.value.match(litPatt);
				if(wynik==null)
				{
				document.getElementById("alert"+i).innerHTML = " wprowadź poprawnie!";
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
	if(sprawdz() == true)
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

function inprice()
{
	var a = document.getElementById("t1").value;
	getData("price.php?name="+a, "alertprice");
}

function fokus(AElementID)
{
    var el = document.getElementById(AElementID);
	document.getElementById(AElementID).value = "pyk";
    el.focus();
}

function sprawdz_tranzakcja()
{
	a=0;
	for(i=2;i<=3;i++)
	{
	
	    var pole = document.getElementById("t"+i);
		document.getElementById("alert"+i).innerHTML = "";
		if (!pole.disabled && (pole.value == "-wszystkie-" || pole.value == "" || pole.value == "-wybierz-"))
		{	
			document.getElementById("alert"+i).innerHTML = " wprowadź poprawnie!";
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

function action_save_trans()
{
	if(sprawdz_tranzakcja() == true)
	{
    adres = "action_save_trans.php?";
    for(i=1;i<=3;i++)
	{
		if(document.getElementById("t"+i).value == "-wszystkie-" || document.getElementById("t"+i).value == "" || document.getElementById("t"+i).disabled)
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

function sprawdz_new_agent()
{
	a=0;
	for(i=1;i<=3;i++)
	{
	
	    var pole = document.getElementById("a"+i);
		document.getElementById("alert"+i).innerHTML = "";
		if (!pole.disabled && (pole.value == "-wszystkie-" || pole.value == "" || pole.value == "-wybierz-"))
		{	
			document.getElementById("alert"+i).innerHTML = " wprowadź poprawnie!";
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

function action_save_agent()
{
	if(sprawdz_new_agent() == true)
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

function sprawdz_wyniki()
{
	a=0;
	for(i=1;i<=4;i++)
	{
		var pole = document.getElementById("w"+i);
		document.getElementById("alertw"+i).innerHTML = ""; //czyszczenie alertów
		
		if(i==3 || i==4)
		{
		  litPatt = /^[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/;
		  wynik = pole.value.match(litPatt);
		  if(wynik==null)
		  {
		  	document.getElementById("alertw"+i).innerHTML = " wprowadź poprawnie!";
			a++;
		  }
		}
		    
		if (!pole.disabled && (pole.value == "" || pole.value == "" || pole.value == ""))
			{	
				document.getElementById("alertw"+i).innerHTML = " wprowadź poprawnie!";
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
	if(sprawdz_wyniki() == true)
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