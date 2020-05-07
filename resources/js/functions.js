var ws; //variable global que manejará el objeto new WebSocket() 
window.addEventListener('load', load, false);
//llamará la función load hasta que la página haya cargado completamente 
function load() {
	MyWebSocketCall(); //función propia que gestionará la comunicación con el WebSocket 
	console.log("ready!");
}

function MostrarDetalle(button, id){
	if(button.innerHTML == "Ver más"){
		document.getElementById(id).style = "display: block;";
		button.innerHTML = "Ver menos";
	}
	else{
		document.getElementById(id).style = "display: none;";
		button.innerHTML = "Ver más"
	}
}
/* función send(): se usa para enviar un aviso al WebSocket. 
   Con solo enviar un aviso será suficiente para ejecutar un “update” a todas las páginas de los usuarios conectados.
	No es necesario enviar el contenido del Tweet ya que este está en la BD.
	Es por esto por lo que se envía un texto cualquiera como parámetro */
function send() {
	ws.send("actualiza los tweets!");
}

function recargarElemento(page, element) {
	axios.post(page).then(function (response) {
		//En caso de carga exitosa del recurso
		var temphtml = document.createElement('div'); temphtml.innerHTML = response.data;
		document.getElementById(element).innerHTML = temphtml.querySelector("#" + element).innerHTML;
	})
		.catch(function (error) {
			//En caso de carga fallida del recurso 
		});
}
function MyWebSocketCall() {
	if ("WebSocket" in window) {
		console.log("WebSocket is supported by your Browser!");
		/* personalizamos la url con nuestro propio apiKEY y CHANNEL_ID:
		 wss://connect.websocket.in/v3/YOUR_CHANNEL_ID?apiKey=YOUR_APIKEY */
		ws = new WebSocket("wss://connect.websocket.in/v3/1?apiKey=oKEUPUkg5SxnDkM8BgMC2n8cEjKb1zI3kOQKqKcwEb5pukjHQ0tsdN6X9PrP");
		ws.onopen = function () {
			// Web Socket is connected, send data using send() 
			console.log("WebSocket is open...");
		};

		ws.onmessage = function (evt) {
			//cada vez que alguien envía un msj se actualiza la ventana de tweets de forma asincrónica 
			recargarElemento("http://localhost/Proyecto/web/index", "main_panel");
			console.log("Message is received: " + evt.data);
			//evt.data contiene el msj recibido 
		};

		ws.onclose = function () { // websocket is closed. 
			console.log("Connection is closed...");
		};
	} else { // The browser doesn't support WebSocket 
		alert("WebSocket NOT supported by your Browser!");
	}
}


var global = "div_1";

function ChangeDiv(id, src) {
	id = "div_" + id;
	document.getElementById(global).className = "main_panel2";
	document.getElementById("img").src = src;
	document.getElementById(id).className = "main_panel1";
	global = id;
}


function enlargeImg(imgs, index) {
	var enlarge = document.getElementById("expandedImg");
	var imgText = document.getElementById("imgDescription");
	enlarge.src = imgs.src;
	imgText.innerHTML = imgs.alt;
	console.log(index);
  }