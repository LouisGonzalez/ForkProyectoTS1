<?php

  // Datos para conectar a la base de datos.
  $nombreServidor = "localhost";
  $nombreUsuario = "root";
  $passwordBaseDeDatos = "root";
  $nombreBaseDeDatos = "calendariomaya";
 
  // Crear conexión con la base de datos.
  $conexion = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
  
    

?>