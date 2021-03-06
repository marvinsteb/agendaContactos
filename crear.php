<?php
  function peticion_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }
  
  $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : null;
  $numero = isset($_POST['numero']) ?  htmlspecialchars($_POST['numero']) : null;
  
  try {
    require_once('funciones/dbConexion.php');
    $query = "INSERT INTO `contactos`.`contacto`
              (`idcontacto`,
              `nombre`,
              `telefono`)
              VALUES
              (NULL,
              '{$nombre}',
              '{$numero}');
              ";

    $resultado = $conexion->query($query);

    $titulares = array();
    $camposMinimos = array();
  
    $camposMinimos["tipoActuacion"] = "C";
    $titulares[] = $camposMinimos;

    if(peticion_ajax()) {
      echo json_encode(array(
        'titulares' => $titulares,
        'respuesta' => $resultado,
        'nombre' => $nombre,
        'telefono' => $numero ,
        'id' => $conexion->insert_id
      ));
    } else {
          exit;
    }

  } catch (Exception $e) {
    $error = $e->getMessage();
  }
$conexion->close();
?>
