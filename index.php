<?php
  try {
    require_once('funciones/dbConexion.php');
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/estilos.css">
    <title>Agenda</title>
  </head>
  <body>
    <div class="contenedor">
      <h1>Agenda</h1>
      <div class="contenido">
        <h2>Agregar nuevo contacto</h2>
        <form action="crear.php" method="post">
          <div class="campo">
            <label for="nombre" >Nombre:
              <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            </label>
          </div><!--- .campo-->

          <div class="campo">
            <label for="numero">Numero Tel.:
              <input type="text" name="numero" id="numero" placeholder ="Numero telefónico">
            </label>
          </div><!--- .campo-->
          <input type="submit" value="Agregar">
        </form>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
  </body>
</html>
