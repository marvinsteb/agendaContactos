var agregarContacto = document.getElementById("agregar");

var formulario = document.getElementById("formulario_crear_usuario");

function crearUsuario() {
  var form_datos = new FormData(formulario);
  for ([llave, valor] of form_datos.entries()) {
    console.log(llave + " " + valor);
  }
}

agregarContacto.addEventListener("click", function (e) {
  e.preventDefault();
  crearUsuario();
});
