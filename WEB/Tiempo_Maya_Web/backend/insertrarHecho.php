<?php
session_start();
$ir_a = "../LineaDeTiempo.php"; 
$conexion = new mysqli("localhost", "root", "root", "calendariomaya");
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

//guarda hecho historico
$sql1 = "INSERT INTO hechohistorico (fechaInicio, fechaFinalizacion, titulo, descripcion) VALUES ('" . $_POST['fechaInicio'] . "' , '" . $_POST['fechaFin'] . "',
    '" . $_POST['titulo'] . "', '" . $_POST['descripcion'] . "')";
    if (!$conexion->query($sql1)) {
        echo "Falló 2: (" . $conexion->errno . ") " . $conexion->error;
    }

//selecciona el id del hecho historico guardado antes
$rs = mysqli_query($conexion, "SELECT MAX(id)as id FROM hechohistorico");
$id = $rs->fetch_array(MYSQLI_ASSOC);

//asigna la categoria del hecho historico 
$sql2 = "INSERT INTO categorizar VALUES (" . $id['id'] . " , " . $_POST['idCategoria'].")";
if (!$conexion->query($sql2)) {
    $ir_a = "../error.php";
    echo "Falló 2: (" . $conexion->errno . ") " . $conexion->error;
}
//guarda la edicion del hecho historico
$sql3 = "INSERT INTO edicion (username, idHechoHistorico, fecha, creacion) VALUES ('" .$_SESSION['nombre']. "' , " . $id['id'] . ",
'". date("Y-m-d"). "', '1')";
if (!$conexion->query($sql3)) {
    $ir_a = "../error.php";
    echo "Falló 3: (" . $conexion->errno . ") " . $conexion->error;
}else{
    header("location: ".$ir_a);
}




?>