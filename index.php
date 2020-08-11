<?php
  try {
    require_once('funciones/dbConexion.php');
    $querySelectContacto = "select 
                            ct.idcontacto,
                            ct.nombre,
                            ct.telefono
                            from contacto as ct order by ct.idcontacto desc ";
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
      <div class="contenido crear">
        <h2>Agregar nuevo contacto</h2>
        <form action="crear.php" method="post">
          <div class="campo">
            <label for="nombre" >Nombre:</label>
              <input type="text" name="nombre" id="nombre" placeholder="Nombre">
          </div><!--- .campo-->

          <div class="campo">
            <label for="numero">Numero Tel.:</label>
            <input type="text" name="numero" id="numero" placeholder ="Numero telefónico">
          </div><!--- .campo-->
          <input type="submit" value="Agregar">
        </form>
      </div><!-- .contenido-->
      <div class="contenido existentes">
      <h2>Lista de contactos</h2>
      <p> Numero de contactos:<?php echo $datos->num_rows;?>
      </p>
      <table>
        <thead>
         <tr>
          <th>Id</th>
          <th>Nombre</th>
          <th>Numero</th>
          <th>Editar</th>
          <th>Borrar</th>
         </tr>
        </thead>
        <tbody>
        <?php
          while($usuario = $datos->fetch_assoc()) {
            echo "<tr>";
            foreach ($usuario as $llave => $valor) {
              echo "<td>{$valor}</td>";
            }
             echo "<td class='editar'><a href='editar.php?id={$usuario['idcontacto']}'>Editar</a></td>";
             echo "<td class='borrar'><a href='borrar.php?id={$usuario['idcontacto']}'>borrar</a></td>";
            echo "</tr>";
          } 
        ?>
        
        </tbody>
      </table>
      </div><!-- .contenido-->
    </div><!-- .contenedor-->
    <?php $conexion->close();?>
    <script src="js/app.js"></script>
  </body>
</html>
