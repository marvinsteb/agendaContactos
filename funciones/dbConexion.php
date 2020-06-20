<?php
  $conexion = new mysqli('localhost','root','root','contactos');
  if($conexion->connect_error){
    echo $error = $conexion->connect_error;
  }
?>