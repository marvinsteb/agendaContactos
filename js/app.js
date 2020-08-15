var agregarContacto = document.getElementById("agregar");
var formulario = document.getElementById("formulario_crear_usuario");
var action = formulario.getAttribute("action");
var divCrear = document.getElementById("crear-contacto");
var total = 1;
agregarContacto.addEventListener("click", function () {
  total = total + 2;
  alert(total);
});

function registroExitoso(nombre) {
  var divMensaje = document.createElement("DIV");
  divMensaje.setAttribute("id", "mensaje");
  var texto = document.createTextNode("Creado: " + nombre);
  divMensaje.appendChild(texto);
  divCrear.insertBefore(divMensaje, divCrear.childNodes[4]);
  divMensaje.classList.add("mostrar");

  setTimeout(function () {
    divMensaje.classList.add("ocultar");
    setTimeout(function () {
      var divPadreMensaje = divMensaje.parentNode;
      divPadreMensaje.removeChild(divMensaje);
    }, 500);
  }, 3000);
}

function construirTemplate(nombre, telefono, idContacto) {
  var tdNombre = document.createElement("TD");
  var textoNombre = document.createTextNode(nombre);
  tdNombre.appendChild(textoNombre);

  var tdTelefono = document.createElement("TD");
  var textoTelefono = document.createTextNode(telefono);
  tdTelefono.appendChild(textoTelefono);

  var nodoBtn = document.createElement("A");
  var textoEnlace = document.createTextNode("Editar");
  nodoBtn.appendChild(textoEnlace);
  nodobtn.href = "editar.php?id=" + idContacto;
  var nodoTdEditar = document.createElement("TD");
  nodoTdEditar.appendChild(nodoBtn);
}

function crearUsuario() {
  var form_datos = new FormData(formulario);
  for ([llave, valor] of form_datos.entries()) {
    console.log(llave + " " + valor);
  }
  var xhr = new XMLHttpRequest();
  xhr.open("post", action, true);
  xhr.setRequestHeader("X-requested-With", "XMLHttpRequest");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var resultado = xhr.responseText;
      var json = JSON.parse(resultado);
      if (json.respuesta == true) {
        registroExitoso(json.nombre);
        construirTemplate(json.nombre, json.telefono, json.id);
      }
    }
  };
  xhr.send(form_datos);
}

agregarContacto.addEventListener("click", function (e) {
  e.preventDefault();
  crearUsuario();
});
