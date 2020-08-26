var agregarContacto = document.getElementById("agregar");
var formulario = document.getElementById("formulario_crear_usuario");
var action = formulario.getAttribute("action");
var divCrear = document.getElementById("crear-contacto");
var tablaRegistrados = document.getElementById("registrados");
var checkBoxesBorrar = document.getElementsByClassName("borrar_contacto");
var btnBorrar = document.getElementById("btn_borrar");
var tableBody = document.getElementsByTagName("tbody");
var divExistentes = document.getElementsByClassName("existentes");
var inputBuscador = document.getElementById("buscador");
var totalContacto = document.getElementById("totalContactos");

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
  var tdId = document.createElement("TD");
  var textoId = document.createTextNode(idContacto);
  tdId.appendChild(textoId);

  var tdNombre = document.createElement("TD");
  var textoNombre = document.createTextNode(nombre);
  tdNombre.appendChild(textoNombre);

  var tdTelefono = document.createElement("TD");
  var textoTelefono = document.createTextNode(telefono);
  tdTelefono.appendChild(textoTelefono);

  var nodoBtn = document.createElement("A");
  var textoEnlace = document.createTextNode("Editar");
  nodoBtn.appendChild(textoEnlace);
  nodoBtn.href = "editar.php?id=" + idContacto;
  var tdEditar = document.createElement("TD");
  tdEditar.appendChild(nodoBtn);

  var checkBorrar = document.createElement("INPUT");
  checkBorrar.type = "checkbox";
  checkBorrar.name = idContacto;
  checkBorrar.classList.add("borrar_contacto");
  var tdCheckbox = document.createElement("TD");
  tdCheckbox.classList.add("borrar");
  tdCheckbox.appendChild(checkBorrar);

  var trContacto = document.createElement("TR");
  trContacto.setAttribute("id", idContacto);
  trContacto.appendChild(tdId);
  trContacto.appendChild(tdNombre);
  trContacto.appendChild(tdTelefono);
  trContacto.appendChild(tdEditar);
  trContacto.appendChild(tdCheckbox);

  tablaRegistrados.childNodes[3].appendChild(trContacto);
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

for (var i = 0; i < checkBoxesBorrar.length; i++) {
  checkBoxesBorrar[i].addEventListener("change", function () {
    if (this.checked) {
      this.parentNode.parentNode.classList.add("activo");
    } else {
      this.parentNode.parentNode.classList.remove("activo");
    }
  });
}
function eliminarContactoHtml(ids_borrados) {
  for (var i = 0; i < ids_borrados.length; i++) {
    var contactoEliminado = document.getElementById(ids_borrados[i]);
    tableBody[0].removeChild(contactoEliminado);
  }
}
function mensajeContactoEliminado() {
  var divEliminado = document.createElement("DIV");
  divEliminado.setAttribute("id", "borrado");
  var textoDiv = document.createTextNode("Eliminado de lista de contactos");
  divEliminado.appendChild(textoDiv);
  divExistentes[0].insertBefore(divEliminado, divExistentes[0].childNodes[0]);
  divEliminado.classList.add("mostrar");
  setTimeout(function () {
    divEliminado.classList.add("ocultar");
    setTimeout(function () {
      var divPadreMensaje = divEliminado.parentNode;
      divPadreMensaje.removeChild(divEliminado);
    }, 500);
  }, 3000);
}

function eliminarContactos(contactos) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "borrar.php?id=" + contactos, true);
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var resultadoContactoEliminado = xhr.responseText;
      var jsonRespuestaContacto = JSON.parse(resultadoContactoEliminado);
      if (jsonRespuestaContacto.respuesta == false) {
        alert("selecciona un contacto para eliminar!");
      } else {
        console.log("Resultado: " + resultadoContactoEliminado);
        eliminarContactoHtml(contactos);
        mensajeContactoEliminado();
      }
    }
  };
  xhr.send();
}

function checkboxSeleccionados() {
  var contactos = [];
  for (var i = 0; i < checkBoxesBorrar.length; i++) {
    if (checkBoxesBorrar[i].checked == true) {
      contactos.push(checkBoxesBorrar[i].name);
    }
  }
  eliminarContactos(contactos);
}

btn_borrar.addEventListener("click", function () {
  checkboxSeleccionados();
});

function actualizarCantidadContactos() {
  var cantidadContactos = tableBody[0].getElementsByTagName("tr");
  var cantidad = 0;
  var ocultos = 0;
  for (var i = 0; i < cantidadContactos.length; i++) {
    if (cantidadContactos[i].style.display == "table-row") {
      cantidad++;
      totalContacto.innerHTML = cantidad;
    } else {
      if (cantidadContactos[i].style.display == "none") {
        ocultos++;
        if (ocultos == cantidadContactos.length) {
          ocultos -= cantidadContactos.length;
          totalContacto.innerHTML = ocultos;
        }
      }
    }
  }
}
function mostrarContactos(contactoBuscar) {
  var listaContactos = tableBody[0].getElementsByTagName("tr");
  var ex = new RegExp(contactoBuscar, "i");

  for (var i = 0; i < listaContactos.length; i++) {
    listaContactos[i].style.display = "none";
    if (
      listaContactos[i].childNodes[1].textContent
        .replace(/\s/g, "")
        .search(ex) != -1
    ) {
      listaContactos[i].style.display = "table-row";
    } else if (contactoBuscar == "") {
      listaContactos[i].style.display = "table-row";
    }
  }
  actualizarCantidadContactos();
}

inputBuscador.addEventListener("input", function () {
  mostrarContactos(this.value);
});
