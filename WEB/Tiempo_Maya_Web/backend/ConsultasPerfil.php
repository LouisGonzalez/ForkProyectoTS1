<?php
 
  function cambioFecha($param){
    $fch = explode("-",$param);
    $stfecha = $fch[2]."-".$fch[1]."-".$fch[0];
    return $stfecha;
  }

  $nombreServidor = "localhost";
  $nombreUsuario = "root";
  $passwordBaseDeDatos = "root";
  $nombreBaseDeDatos = "calendariomaya";


  function verInformacion($username){
  
    $consulta = "SELECT * FROM usuario WHERE username = '$username'";
    $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
    $result = mysqli_query($conn, $consulta);
    $datos = $result->fetch_array(MYSQLI_ASSOC);
    return $datos;
  }

?>