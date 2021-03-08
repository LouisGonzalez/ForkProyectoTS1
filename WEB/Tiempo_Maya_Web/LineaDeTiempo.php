<?php
    session_start();
    $conexion; 
    include_once('backend/sesion/conexionsql.php');
    $sql = "SELECT * FROM hechohistorico";
    $resultado = $conexion->query($sql);
    $numfilas = $resultado->num_rows;
    echo $numfilas;
    $idhecho = -1;
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <title>Linea de Tiempo</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/estiloLineaTiempo.css" rel="stylesheet">
</head>
<body>
    <style>
        .main-container{
            width: 35%;
            margin: 100px  auto;
            padding: 20px 20px 60px;
            -webkit-box-shadow: 13px 10px 5px -4px rgba(0,0,0,0.75);
            -moz-box-shadow: 13px 10px 5px -4px rgba(0,0,0,0.75);
            box-shadow: 13px 10px 5px -4px rgba(0,0,0,0.75);
            background: rgba(0, 0, 0, 0.3);
            color: black;
        }
        body{
        background: url("./img/fondo.jpg") ;
        background-size: cover;
        }
        .nav-menu > li > a:before {
        background-color: black;
        }
    </style>
    <div>
        <header id="header" style="background-color: #1C1C1C;">
            <?php include 'BarradeNavegacion.php'; ?>>
        </header>
    </div>
    <section>
        <div class="container" style="padding-top: 120px; height:100px">
            <div id="myCarousel" class="carousel" data-ride="carousel">
                <div class="carousel-inner" style="height: 600px; background: url(img/fondo.png);">
                    <?php
                        $num = 0;
                        foreach ($resultado as $hecho) : ?>
                            <?php
                            $sqlCat = "SELECT idHechoHistorico, nombre FROM categorizar 
                            inner JOIN categoria ON categorizar.idCategoria = categoria.id
                            WHERE categorizar.idHechoHistorico= " . $hecho['id'];
                            $cat = $conexion->query($sqlCat);
                            $cat1;
                            foreach ($cat as $categoria1) :
                                $cat1 = $categoria1['nombre'];
                            endforeach;
                            if ($num == 0) {
                                echo '<div class="item active" style="height: 600px;">';
                                $num =  $num + 1;
                            } else {
                                $num = $num + 1;
                                echo '<div class="item " style="height: 600px;">';
                            }
                            ?>
                            <div class="carousel-caption" style=" padding-top: 20px;">
                                <div id="transparencia">
                                    <h1 class='titulo' style="margin-bottom: 10px; color:black"> <?php echo $hecho['titulo']; ?></h1>
                                    <p class='fecha' style=""> Fecha: <?php echo date("d/m/Y", strtotime($hecho['fechaInicio'])) ?></p>
                                </div>
                                <div style="height: 360px;">
                                    <div id="transparencia" >
                                        <div class="card-body" style="padding-left: 5%;padding-right:5%">
                                            <br>
                                            <h5 class="card-title">Descripcion</h5>
                                            <p class="card-text" style="text-align: justify; "><?php echo $hecho['descripcion'] ?></p>
                                            <?php   
                                                if (isset($_SESSION['nombre'])) {
                                                    $nombre = $_SESSION['nombre'];
                                                    $consulta = "SELECT * FROM usuario WHERE username = '$nombre'";
                                                    $resultado = $conexion->query($consulta);
                                                    $tupla = $resultado->fetch_array(MYSQLI_ASSOC); 
                                                    if($tupla['rol'] == '1'){ ?>
                                                        <form action="./backend/EliminacionHecho.php" method="POST">
                                                            <input  type="hidden"  name="idHecho" value="<?php echo $hecho['id'] ?>" >
                                                            <button type="submit" class="btn btn-primary">Eliminar</button>
                                                        </form>
                                                        <?php 
                                                    }
                                                }    ?>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Controles izquierda-derecha -->
                <a class="left carousel-control"  href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="right carousel-control"  href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </section>
    <section style="padding-top: 700px;">
    </section>
    <footer id="footer">
        <?php
        if (isset($_SESSION['nombre'])) {
            $nombre = $_SESSION['nombre'];
            $consulta = "SELECT * FROM usuario WHERE username = '$nombre'";
            $resultado = $conexion->query($consulta);
            $tupla = $resultado->fetch_array(MYSQLI_ASSOC); 
            if($tupla['rol'] == '1'){
                echo '<div class="container">
                <div class="padre">
                    <div style="color: black; padding-left: 5%;">
                        <div class="card-header">
                            Falta un hecho importante?
                        </div>
                        <div>
                            <h5 class="card-title" style="color:black">AGREGA NUEVOS HECHOS HISTORICOS</h5>
                            <button class="btn btn-primary owl-slide-animated owl-slide-cta" style="margin-bottom: 20px; ">
                                <a style="color: black; " class="scrollNavigation" href="insertarLineaTiempo.php">AGREGAR</a>
                            </button>
                        </div>
                    </div>
                </div>
                </div>';
            }
        }
        ?>
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong>Teoria de Sistemas</strong>. Derechos Reservados
            </div>
        </div>
    </footer>
</body>
</html>