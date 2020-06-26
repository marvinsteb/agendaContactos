<?php
  try {
    require_once('funciones/dbConexion.php');
  } catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
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
      <div class="contenido crear">
        <h2>Editar contacto</h2>
        <form action="actualizar.php" method="post">
          <div class="campo">
            <label for="nombre" >Nombre:</label>
              <input type="text" name="nombre" id="nombre" placeholder="Nombre">
          </div><!--- .campo-->

          <div class="campo">
            <label for="numero">Numero Tel.:</label>
            <input type="text" name="numero" id="numero" placeholder ="Numero telefónico">
          </div><!--- .campo-->
          <input type="submit" valor="guardar">
        </form>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
    <?php $conexion->close();?>
  </body>
</html>
