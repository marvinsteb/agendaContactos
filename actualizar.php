<?php
  $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
  $numero = isset($_POST['numero']) ? $_POST['numero'] : null;
  $id = isset($_POST['id']) ? $_POST['id'] : null;

  try {
    require_once('funciones/dbConexion.php');
    $query = "UPDATE `contactos`.`contacto`
              SET
              `nombre` = '{$nombre}',
              `telefono` = '{$numero}'
              WHERE `idcontacto` = {$id};
              ";
    $resultado = $conexion->query($query);

    if($resultado) {
      echo "Contacto actualizado";
      header("Location: /");
      exit();
    } else {
      echo "No se actualizo el contacto";
    }
    $conexion->close();
    

  } catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }

?>