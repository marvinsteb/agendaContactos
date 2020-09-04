<?php
  try {
    require_once('funciones/dbConexion.php');
    $querySelectContacto = "select 
                            ct.idcontacto,
                            ct.nombre,
                            ct.telefono
                            from contacto as ct order by ct.idcontacto";
    $datos = $conexion->query($querySelectContacto);
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
        <div id="crear-contacto" class="crear">
          <h2>Agregar nuevo contacto</h2>
          <form action="crear.php" method="post" id="formulario_crear_usuario">
            <div class="campo">
              <label for="nombre" >Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            </div><!--- .campo-->

            <div class="campo">
              <label for="numero">Numero Tel.:</label>
              <input type="text" name="numero" id="numero" placeholder ="Numero telefónico">
            </div><!--- .campo-->
            <input type="submit" value="Agregar" id="agregar" class = "boton">
          </form>
        </div>
      </div><!-- .contenido-->

      <div class="contenido existentes">
        <div class="buscar">
          <h2>Buscar</h2>
          <input type="text" name="buscador" id="buscador" placeholder="Buscar" class="buscador">
        </div>
      <h2>Lista de contactos</h2>
      <p> Numero de contactos: <span id="totalContactos"><?php echo $datos->num_rows;?></span></p>
      <table id="registrados">
        <thead>
         <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Numero</th>
          <th>Editar</th>
          <th>
          <button type="button" name="borrar" id="btn_borrar" class="borrar">Borrar</button>
          <input type="checkbox" name="borrar_todos" id="borrar_todos">
          </th>
         </tr>
        </thead>
        <tbody>
        <?php
          while($contacto = $datos->fetch_assoc()){
            ?>
            <tr id='<?php echo $contacto['idcontacto'];?>'>
              <td><?php echo $contacto['idcontacto'];?></td>
              <td>
                <?php echo $contacto['nombre'];?>
                <input type="text" class='nombre' value='<?php echo $contacto['nombre'];?>' name="nombre_<?php echo $contacto['idcontacto']?>">
              </td>
              <td>
                <?php echo $contacto['telefono'];?>
                <input type="text" class='telefono' value='<?php echo $contacto['telefono'];?>' name="telefono_<?php echo $contacto['idcontacto']?>">
              </td>
              <td class='editar'><a href='editar.php?id=<?php echo $contacto['idcontacto'];?>'>Editar</a></td>
              <td class='borrar'><input class='borrar_contacto' type='checkbox' name='<?php echo $contacto['idcontacto'];?>'></td>
            </tr>
          <?php } ?>
        
        </tbody>
      </table>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
    <?php $conexion->close();?>
    <script src="js/app.js"></script>
  </body>
</html>
