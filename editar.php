<?php
  $idcontacto = isset($_GET['id']) ? $_GET['id'] : null;
  try {
    require_once('funciones/dbConexion.php');
    $query = "select 
              ct.idcontacto,
              ct.nombre,
              ct.telefono
              from contacto as ct 
              where ct.idcontacto = {$idcontacto}";
   $resultado = $conexion->query($query);
   $registros = $resultado->fetch_assoc();
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
            <?php echo "<input value ='".$registros['nombre']."'type='text' name='nombre' id='nombre'>";?>
          </div><!--- .campo-->

          <div class="campo">
            <label for="numero">Numero Tel.:</label>
            <?php echo "<input value ='".$registros['telefono']."'type='text' name='numero' id='numero'>";?>
          </div><!--- .campo-->
          <input type="submit" valor="guardar">
        </form>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
    <?php $conexion->close();?>
  </body>
</html>
