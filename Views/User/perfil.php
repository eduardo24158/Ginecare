<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../../assets/css/decoration.css">
  <link rel="stylesheet" href="../../assets/css/profile.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <title>Perfil</title>
</head>

<body>
  <?php include("../../controller/session_l.php"); ?>
  <?php require("../../model/deleteProfile.php"); ?>
  <?php
  function edades($nacimiento)
  {
    $fechaNacimiento = new DateTime($nacimiento);
    $fechaActual = new DateTime();
    $diferencia = $fechaActual->diff($fechaNacimiento);
    $edad = $diferencia->y;
    return $edad;
  }
  ?>

  <nav class="navbar navbar-expand-lg navbar-dark text-light bg-dark px-2 d-flex justify-content-between pum">
    <a class="linkHistorial" href="inicio.php">Regresar</a>

    <h3 class="text-center">Perfil</h3>

    <a class="linkEdit" href="../login/login.php">Salir</a>
  </nav>

  <div class="page-content page-container" id="page-content">
    <div class="padding">
      <div class="row container d-flex justify-content-center">
        <div class="col-xl-6 col-md-12">
          <div class="card user-card-full">
            <div class="row m-l-0 m-r-0">
              <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
                  <div class="m-b-25">

                  <?php 
                  include("../../model/cargarImagenPerfil.php");
                        ?>
                  </div>
                  <h6 class="f-w-600"><?php echo $usuario ?></h6>
                  <p><?php echo $dni ?></p>
                  <a class="linkEdit" href="editar.php?id=<?php echo $sid ?>">Editar</a>
                  <a class="linkEdit" href="perfil.php?id=<?php echo $sid ?>">Borrar</a>
                  <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="card-block">
                  <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Información de <?php echo $name ?></h6>
                  <div class="row">
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">Email</p>
                      <h6 class="text-muted f-w-400"><?php echo $email ?></h6>
                    </div>
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">Phone</p>
                      <h6 class="text-muted f-w-400"><?php echo $phone ?></h6>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">Nacimiento</p>
                      <h6 class="text-muted f-w-400"><?php echo $nacimiento ?></h6>
                    </div>
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">Edad</p>
                      <h6 class="text-muted f-w-400"><?php echo edades($nacimiento) ?></h6>
                    </div>
                    <br>
                    <hr>
                    <div class="col-sm-6">
                      <p class="m-b-10 f-w-600">Foto de Perfil</p>
                      <form action="../../model/imagenPerfil.php" method="post" enctype="multipart/form-data">
                        <input type="file" id="fotoPerfil" name="fotoPerfil" class="botones imageninput">
                        <input type="submit" value="Subir Imagen" class="botones">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="contenedor">
    <div class="opciones">
      <h2>Alergias Previas:</h2>
      <h4>En caso de tener algún tipo de <b>Enfermedad</b> Crónica o Alergias. Por favor, puede ingresarlos en el siguiente formulario:</h4>
      <?php
      if (isset($_GET['mensaje'])) {
        echo '<p class="mensajeConfimacion">' . htmlspecialchars($_GET['mensaje']) . '</p>';
      }
      ?>
      <form action="../../model/detalleUser.php" method="post">
        <textarea class="texto" name="detalles" id="detalles" rows="4" cols="50" required></textarea>
        <br>
        <input type="submit" value="subir" class="botonDeTextarea">
      </form>
    </div>
  </div>

</body>

</html>