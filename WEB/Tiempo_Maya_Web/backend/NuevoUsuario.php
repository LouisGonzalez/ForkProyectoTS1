<?php
$nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $user = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $telefono = $_POST['telefono'];
  $nacimiento = $_POST['nacimiento'];

  // Datos para conectar a la base de datos.
  $nombreServidor = "localhost";
  $nombreUsuario = "root";
  $passwordBaseDeDatos = "root";
  $nombreBaseDeDatos = "calendariomaya";
 
  function cambioFecha($param){
    $fch = explode("-",$param);
    $stfecha = $fch[2]."-".$fch[1]."-".$fch[0];
    return $stfecha;
  }


  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

  $result = mysqli_query($conn, "SELECT * FROM usuario WHERE username = '$user'");
  if(mysqli_num_rows($result)>0){
    //ya existe un usuario con cierto username
    echo '
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
      <div class="alert alert-success" role="alert"  style="margin-left:300px; margin-right:300px;">
          <h4 class="alert-heading">Ya existe un username '.$user.'</h4>
          <hr>
          <form class="form-horizontal" action="../iniciarSesion.php" method="post">
            <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">regresar</button>
          </form>
      </div> 
    </body>'; 
  } else {
    $palabra = "INSERT INTO usuario VALUES ('$user','$pass','$email','$nombres','$apellidos','$nacimiento','$telefono','2')";    
    $creacion = mysqli_query($conn, $palabra);    
    session_start();
    $_SESSION['nombre'] = $user;
    $_SESSION['rango'] = 2;
    header("Location: ../index.php");
  }







?>