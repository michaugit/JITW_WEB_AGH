function wyswietlListeStyli()
{
	var lista = document.createElement("div");
	var ul = document.createElement("ul");
	var style = document.getElementsByTagName("link");
	lista.id="lista";
	
	for(var i=0;i<style.length;i++)
	{
		var li = document.createElement("li");
		var a = document.createElement("a");
		li.innerHTML = style[i].title;
		// li.setAttribute("onclick","zmienStyl(this)"); // po kliknieciu zmienia styl
		li.setAttribute("onclick","zmienStyl('"+style[i].title+"')"); // po kliknieciu zmienia styl
		
		ul.appendChild(li);
	}
	lista.appendChild(ul);
	document.body.appendChild(lista);
}

function zmienStyl(szukanaNazwa){
	ustawCookies('aktywnyStyl',szukanaNazwa,'/');
	var style = document.getElementsByTagName("link"); //tablica stylow
	var nazwa;
	
	for(var i=0;i<style.length;i++)//wylaczenie wszystkich styli
		style[i].disabled=true;
	
	for(var i=0;i<style.length;i++)//wlaczenie szukanego stylu
	{
		nazwa = style[i].getAttribute('title');
		if(nazwa === szukanaNazwa)
			style[i].disabled=false; //aktywowanie stylu
	}
}

function sprawdzCookies()//sprawdzenie czy jest zapisany jakis styl w Cookies
{
	var nazwa = uzyjCookies('aktywnyStyl');
	console.log(nazwa)
	console.log(document.cookie)
	if(nazwa != null && nazwa != '')
		zmienStyl(nazwa);
}

function ustawCookies(nazwa, wartosc, sciezka)//ustawia nazwe Stylu w Cookies
{   
	var aktualnaData = new Date();     
	aktualnaData.setTime(aktualnaData.getTime() + 60 * 60 * 1000);  
	document.cookie = nazwa + '=' + encodeURI(wartosc) + '; expires=' + aktualnaData.toGMTString() + '; path=' + sciezka; //ustawia ciastko na 60 minut
}

function uzyjCookies(nazwa)//zwraca nazwe stylu zapisana w Cookies lub null jesli jej nie bylo
{
	var cookie = document.cookie;   
	if(cookie == null) 
	{
		return null;
	}
	
	var start = cookie.indexOf(nazwa + '=') + nazwa.length + 1;   
	var koniec = cookie.substring(start, cookie.length);   
	koniec = (koniec.indexOf(';') < 0) ? cookie.length : start + koniec.indexOf(';');   
	return decodeURI(cookie.substring(start, koniec)); 
}  
