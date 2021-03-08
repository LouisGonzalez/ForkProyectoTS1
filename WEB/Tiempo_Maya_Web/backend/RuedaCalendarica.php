<?php
session_start();
$conexion; 
include_once('./sesion/conexionsql.php');

$fechaSeleeccion = '2021-02-27';
$fechaSeleeccion = $_POST['date'];

$dia = date('d',strtotime($fechaSeleeccion));
$mes = date('m',strtotime($fechaSeleeccion));
$anio = date('y',strtotime($fechaSeleeccion));

$fecha = "2020-".$mes."-".$dia;
echo "<br>"."DATE parseado: ".$fecha;
$sql = "SELECT * FROM calendariohaab WHERE fecha='".$fecha."'";
echo "<br>".$sql;
$resultado = $conexion->query($sql);
$fechaEncontrada = $resultado->fetch_array(MYSQLI_ASSOC);

echo "<br>".' ID: '.$fechaEncontrada['id'];
echo "<br>".' Nahual: '.$fechaEncontrada['nahual'];
echo "<br>".' Winal: '.$fechaEncontrada['winal'];
$winal = $fechaEncontrada['winal'];

//cargador
$cargador = 1;
if($anio < 2020){
    for($i = 0; $i < (2020-$anio); $i++){
        if($cargador == 4){
            $cargador = 1;
        }else{
            $cargador++;
        }
    }
}

$sql = "SELECT * FROM cargador WHERE id='".$cargador."'";
echo "<br>".$sql;
$resultado = $conexion->query($sql);
$cargadorEncontrado = $resultado->fetch_array(MYSQLI_ASSOC);

$query;
  $nivel;
$for = mktime(0, 0, 0, 1, 1, 1720)/(24*60*60);
	$fech = date("U", strtotime($_POST['date']))/(24*60*60);
	$idd = $fech-$for;
	$nn = $idd % 13;
  switch ($nn){
		case 12:
      $nivel = 1; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 0: case -12:
      $nivel = 2; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 1: case -11:
      $nivel = 3; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 2: case -10:
      $nivel = 4; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 3: case -9:
      $nivel = 5; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 4: case -8:
      $nivel = 6; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 5: case -7:
      $nivel = 7; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 6: case -6:
      $nivel = 8; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 7: case -5:
      $nivel = 9; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 8: case -4:
      $nivel = 10; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 9: case -3:
      $nivel = 11; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 10: case -2:
      $nivel = 12; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
		case 11: case -1:
      $nivel = 13; // la variable $nivel ya esta declarada en la pagina anterior para usarlo
			break;
	}

    echo "<br>".' Nivel: '.$nivel;

    $date1 = new DateTime("2020-01-01");

//$date2 = new DateTime("2020-03-10");

$date2 = new DateTime($fechaSeleeccion);


$diff = $date1->diff($date2);
// this will output 4 days                           
$diferenciaDias = $diff->days;
echo $diferenciaDias .' days ';

while($diferenciaDias>20){
    $diferenciaDias = $diferenciaDias-20;
}
if($diferenciaDias==0){
    //echo "El nahual es el mismo iq";
}else{
    $idNahual = 17;
    while($diferenciaDias>0){
        if($idNahual==20){
            $idNahual = 1;
        }else{
            $idNahual = $idNahual + 1;
        }
        //$idNahual = $diferenciaDias;
        $diferenciaDias = $diferenciaDias -1;
    }
    //echo "El nahual es el mismo ". $idNahual;
}

echo "<br>".' Nahual: '.$idNahual;

$parametros = "isfecha=$fechaSeleeccion&id_nahual=".$idNahual."&id_winal=$winal&id_cargador=$cargador&id_energia=$nivel";

header("location: /Tiempo_Maya_Web/RuedaCalendarica.php?$parametros");


?>