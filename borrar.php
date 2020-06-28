<?php
  $id = isset($_GET['id']) ? $_GET['id'] : null;

  try {
    require_once('funciones/dbConexion.php');
    $query = "DELETE FROM `contactos`.`contacto`
              WHERE idcontacto = {$id};";
    $resultado = $conexion->query($query);
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
      <?php
       if($resultado) {
          echo "Contacto Borrado";
        } else {
          echo "Error" . $conexion->error;
        }
        $conexion->close();
      ?>
      <br>
      <a href="index.php" class="volver">Volver al inicio</a>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
  </body>
</html>
