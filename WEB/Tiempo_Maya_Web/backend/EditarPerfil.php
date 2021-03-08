<?php
  session_start();
  $user = $_SESSION['nombre'];
  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $telefono = $_POST['telefono'];
  $nacimiento = $_POST['nacimiento'];
  $username = $_POST['username'];
  $email = $_POST['email'];

  //Datos para la conexion a la base de datos
  $nombreServidor = "localhost";
  $nombreUsuario = "root";
  $passwordDB = "root";
  $nombreDB = "calendariomaya";
  
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordDB, $nombreDB);
  $consultaGeneral = "SELECT * FROM usuario WHERE username = '$user'"; 
  $consultaUser = mysqli_query($conn, $consultaGeneral);
  if(mysqli_num_rows($consultaUser)>0){
    $datos = $consultaUser->fetch_array(MYSQLI_ASSOC);
      if(empty($nombres)){
        $nombres = $datos['nombre'];
      }
      if(empty($apellidos)){
        $apellidos = $datos['apellido'];
      }
      if(empty($telefono)){
        $telefono = $datos['telefono'];
      }
      if(empty($nacimiento)){
        $nacimiento = $datos['nacimiento'];
      } 
      if(empty($username)){
        $username = $datos['username'];
      } else {
        $consultaGeneral2 = "SELECT * FROM usuario WHERE username = '$username'";
        $compararUsuarios = mysqli_query($conn, $consultaGeneral2);
        if(mysqli_num_rows($compararUsuarios)==0){
          $_SESSION['nombre'] = $username;  
        }  
      }
      if(empty($email)){
        $email = $datos['email'];
      }
      $cambios = mysqli_query($conn, "UPDATE usuario SET username = '$username', email = '$email', nombre = '$nombres', apellido = '$apellidos', nacimiento = '$nacimiento', telefono = '$telefono' WHERE username = '$user'");
      
      header("Location: ../MiPerfil.php");


    }





?>