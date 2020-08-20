<?php

  function peticion_ajax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

  try {
    require_once('funciones/dbConexion.php');
    $query = "DELETE FROM `contactos`.`contacto`
              WHERE idcontacto IN ({$id});";
    $resultado = $conexion->query($query);
    if(peticion_ajax()){
      echo json_encode(array(
        'respuesta' => $resultado
      ));
    }else{
      exit;
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
    $conexion->close();
?>
