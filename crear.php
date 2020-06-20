<?php
 $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
  $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
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
      <div class="contenido">
       <label for="nombre">Nombre: <?php echo $nombre?></label>
       <br>
       <label for="numero">Numero: <?php echo $numero?></label>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
  </body>
</html>
