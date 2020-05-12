var ws; //variable global que manejará el objeto new WebSocket() 
window.addEventListener('load', load, false);
//llamará la función load hasta que la página haya cargado completamente 
function load() {
	MyWebSocketCall(); //función propia que gestionará la comunicación con el WebSocket 
	console.log("ready!");
}

function MostrarDetalle(button, id) {
	if (button.innerHTML == "Ver más") {
		document.getElementById(id).style = "display: block;";
		button.innerHTML = "Ver menos";
	}
	else {
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

function recargarElemento2(page, element) {
	axios.post(page).then(function (response) {
		//En caso de carga exitosa del recurso
		var temphtml = document.createElement('div'); temphtml.innerHTML = response.data;
		document.getElementById(element).innerHTML = temphtml.querySelector("#" + element).innerHTML;
		document.getElementById("row2").style.display = 'block';
		document.getElementById("container2").style.display = 'block';
		alertify.set('notifier', 'position', 'top-right'); 
		alertify.success('Imágen eliminada exitosamente');
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

function next() {
	var ArrayImg = document.getElementsByClassName("Imágenes");

	for (var i = 0; i < ArrayImg.length; i++) {
		if (ArrayImg[i].src == document.getElementById("expandedImg").src) {
			if (i + 1 < ArrayImg.length) {
				document.getElementById("expandedImg").src = ArrayImg[i + 1].src;
				break;
			}
			if (i == 9) {
				document.getElementById("expandedImg").src = ArrayImg[0].src;
				break;
			}
		}
	}
}

function before() {
	var ArrayImg = document.getElementsByClassName("Imágenes");

	for (var i = 0; i < ArrayImg.length; i++) {
		if (ArrayImg[i].src == document.getElementById("expandedImg").src) {
			if (i - 1 >= 0) {
				document.getElementById("expandedImg").src = ArrayImg[i - 1].src;
				break;
			}
			if (i == 0) {
				document.getElementById("expandedImg").src = ArrayImg[9].src;
				break;
			}
		}
	}
}


function enlargeImg(imgs) {
	var enlarge = document.getElementById("expandedImg");
	var imgText = document.getElementById("imgDescription");
	enlarge.src = imgs.src;
	enlarge.name = imgs.name;
	imgText.innerHTML = imgs.alt;
}

function ServiceInput(id) {

	if (id.value != '0') {
		axios.get('obtenerTituloServicio/' + document.getElementById("serviciosSELECT").value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("tituloS").value = response.data;
		})

		axios.get('obtenerDetalleServicio/' + document.getElementById("serviciosSELECT").value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("detalleS").value = response.data;
		})

		axios.get('obtenerDescripcionServicio/' + document.getElementById("serviciosSELECT").value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("descripcionS").value = response.data;
		})
	}
}

function EliminarServicio(){
	if(document.getElementById("serviciosSELECT").value != "0"){
		console.log(document.getElementById("serviciosSELECT").value);
		axios.get('EliminarServicio/' + document.getElementById("serviciosSELECT").value).then(function (response) { //En caso de carga exitosa del recurso
			recargarElemento3("http://localhost/Proyecto/admin/login", "divGrande");
		})
	}
	else{
		alertify.set('notifier', 'position', 'top-right'); 
		alertify.error('Debes Seleccionar el Servicio');
	}
}

function recargarElemento3(page, element){
	axios.post(page).then(function (response) {
		//En caso de carga exitosa del recurso
		var temphtml = document.createElement('div'); temphtml.innerHTML = response.data;
		document.getElementById(element).innerHTML = temphtml.querySelector("#" + element).innerHTML;
		document.getElementById("titulo").style.display = 'none';
		document.getElementById("descripcion").style.display = 'none';
		//document.getElementById("titulo").placeholder = "Titulo de servicio"
		document.getElementById("TituloServicio").style.display = "block";
		document.getElementById("DetalleServicio").style.display = "block";
		document.getElementById("Descripcionservicio").style.display = "block";
		document.getElementById("btn_eliminarServ").style.display = 'block';

		alertify.set('notifier', 'position', 'top-right'); 
		alertify.success('Servicio Eliminado Correctamente');
	})
		.catch(function (error) {
			//En caso de carga fallida del recurso 
		});
}

function BlockInput(id) {

	if (id.value != '0') {

		if (document.getElementById("secciones").value == "1" || document.getElementById("secciones").value == "2" ||
			document.getElementById("secciones").value == "6" || document.getElementById("secciones").value == "4") {
			document.getElementById("titulo").readOnly = true;
		} else {
			document.getElementById("titulo").readOnly = false;
		}

		if (document.getElementById("secciones").value == "4") {//galería

			document.getElementById("titulo").style.display = 'none';
			document.getElementById("imagenS").style.display = 'none';

			document.getElementById("row2").style.display = 'block';
			document.getElementById("container2").style.display = 'block';

		} else {
			//galería
			document.getElementById("titulo").style.display = 'block';
			document.getElementById("imagenS").style.display = 'block';
			document.getElementById("container2").style.display = 'none';
			document.getElementById("row2").style.display = 'none';
		}
		if (document.getElementById("secciones").value == "5") {//servicios
			document.getElementById("titulo").style.display = 'none';
			document.getElementById("descripcion").style.display = 'none';
			//document.getElementById("titulo").placeholder = "Titulo de servicio"
			document.getElementById("TituloServicio").style.display = "block";
			document.getElementById("DetalleServicio").style.display = "block";
			document.getElementById("Descripcionservicio").style.display = "block";
			document.getElementById("btn_eliminarServ").style.display = 'block';
			//document.getElementById("descripcion").placeholder = "Descripción"
		}
		else {
			//servicios
			document.getElementById("titulo").style.display = 'block';
			document.getElementById("descripcion").style.display = 'block';
			

			document.getElementById("TituloServicio").style.display = "none";
			document.getElementById("DetalleServicio").style.display = "none";
			document.getElementById("Descripcionservicio").style.display = "none";
			document.getElementById("btn_eliminarServ").style.display = 'none';
		}

		axios.get('obtenerImagen/' + document.getElementById("secciones").value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("imagenS").src = '../resources/photos/' + response.data;
			document.getElementById("txt_file").files[0].src = response.data;
		})
			.catch(function (error) { //En caso de carga fallida del recurso
			});

		axios.get('obtenerTitulo/' + document.getElementById("secciones").value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("titulo").value = response.data;
		})
			.catch(function (error) { //En caso de carga fallida del recurso
			});

		axios.get('obtenerDetalle/' + document.getElementById("secciones").value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("descripcion").value = response.data;
		})
			.catch(function (error) { //En caso de carga fallida del recurso
			});
	}
}

function BlockUser(id) {
	if (id.value != '0') {

		axios.get('obtenerUserName/' + id.value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("txt_usuario").value = response.data;
			
		})
			.catch(function (error) { //En caso de carga fallida del recurso
			});

		axios.get('obtenerRealName/' + id.value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("txt_nombre").value = response.data;
		})
			.catch(function (error) { //En caso de carga fallida del recurso
			});

		axios.get('obtenerCorreo/' + id.value).then(function (response) { //En caso de carga exitosa del recurso
			document.getElementById("txt_correo").value = response.data;
			console.log(response.data);
		})
			.catch(function (error) { //En caso de carga fallida del recurso
			});

	}
}

var admin = "div_secciones";
function change(nombre){
	if(nombre =='salir'){
		console.log("XD");
		axios.get('logout').then(function (response) { //En caso de carga exitosa del recurso
			
		})
		.catch(function (error) { //En caso de carga fallida del recurso
		});
	}else{
		document.getElementById(admin).className = "main_panel2";
		document.getElementById(nombre).className = "main_panel1";
		admin = nombre;
	}
}

function EnviarCorreo(){
	var name = document.getElementById('name').value;
	var email = document.getElementById('email').value
	var message = document.getElementById('message').value
	if(name != "" && email != "" && message != ""){
		var formdata = new FormData();
		formdata.append('name', document.getElementById('name').value);
		formdata.append('email', document.getElementById('email').value);
		formdata.append('message', document.getElementById('message').value);
		axios.post('web/correo', formdata).then(function (response) { //En caso de carga exitosa del recurso
			recargarElemento4("http://localhost/Proyecto/web/index", "div_6");
		}).catch(function (error) { });
	}
	else{
		alertify.set('notifier', 'position', 'top-right'); 
		alertify.error('Digita tus datos');
	}
	
}

function recargarElemento4(page, element){
	axios.post(page).then(function (response) {
		//En caso de carga exitosa del recurso
		var temphtml = document.createElement('div'); temphtml.innerHTML = response.data;
		document.getElementById(element).innerHTML = temphtml.querySelector("#" + element).innerHTML;
		alertify.set('notifier', 'position', 'top-right'); 
		alertify.success('Correo enviado y guardado Correctamente');
	})
		.catch(function (error) {
			//En caso de carga fallida del recurso 
		});
}

function ChangeImage() {
	var file = document.getElementById("txt_file").files[0].name;
	document.getElementById("imagenS").src = '../resources/photos/' + file;
}

function deleteImg() {

	axios.get('EliminarImagen/' + document.getElementById("expandedImg").name).then(function (response) { //En caso de carga exitosa del recurso
		recargarElemento2("http://localhost/Proyecto/admin/login", "ImagesBox");
	}).catch(function (error) { });
}


function next2() {
	var ArrayImg = document.getElementsByClassName("Imágenes2");

	for (var i = 0; i < ArrayImg.length; i++) {
		if (ArrayImg[i].src == document.getElementById("expandedImg").src) {
			if (i + 1 < ArrayImg.length) {
				document.getElementById("expandedImg").src = ArrayImg[i + 1].src;
				break;
			}
			if (i == 9) {
				document.getElementById("expandedImg").src = ArrayImg[0].src;
				break;
			}
		}
	}
}

function before2() {
	var ArrayImg = document.getElementsByClassName("Imágenes2");

	for (var i = 0; i < ArrayImg.length; i++) {
		if (ArrayImg[i].src == document.getElementById("expandedImg").src) {
			if (i - 1 >= 0) {
				document.getElementById("expandedImg").src = ArrayImg[i - 1].src;
				break;
			}
			if (i == 0) {
				document.getElementById("expandedImg").src = ArrayImg[9].src;
				break;
			}
		}
	}
}