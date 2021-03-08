<?php
session_start();
$conexion; 
include_once('backend/sesion/conexionsql.php');
if(isset($_GET['isfecha'])){
  $id_nahual = $_GET['id_nahual'];
  $id_winal = $_GET['id_winal'];
  $id_cargador = $_GET['id_cargador'];
  $id_energia = $_GET['id_energia'];
  //echo "$id_nahual == $id_winal == $id_cargador";
  $sql_nahual =  "SELECT n.*,r.*  FROM nahual n join rutaimagen r on (n.idImagen= r.id) WHERE n.id=$id_nahual LIMIT 1;";
  $sql_winal =  "SELECT w.*,r.dirWeb FROM winal w JOIN rutaimagen r ON (w.idImagen=r.id) WHERE w.id=$id_winal LIMIT 1;";
  $sql_cargador =  "SELECT * FROM cargador WHERE id =$id_cargador LIMIT 1;";
  $sql_energia =  "SELECT * FROM energia WHERE id =$id_energia LIMIT 1;";
  $resultado1 = $conexion->query($sql_nahual);
  $objNahual = $resultado1->fetch_array(MYSQLI_ASSOC);   
  $resultado2 = $conexion->query($sql_winal);
  $objWinal = $resultado2->fetch_array(MYSQLI_ASSOC);
  $resultado3 = $conexion->query($sql_cargador);
  $objCargador = $resultado3->fetch_array(MYSQLI_ASSOC);
  $resultado4 = $conexion->query($sql_energia);
  $objEnergia = $resultado4->fetch_array(MYSQLI_ASSOC);
  //echo $sql_cargador;
}else{
  //echo "esta";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tiempo Maya</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e51fb510f5.js" cross origin="anonymous"></script>
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="css/Calendarios.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/navNahuales.css" rel="stylesheet">

</head>
<?php include "BarradeNavegacion.php" ?>
<body>
<section id="inicio">
<div class="inicio-container">
  <br><br>
  <h1>Rueda Calendarica</h1><br>

  <div class="navNahuales" >
  <!-- <br><br> -->
      <div class="nahuales11" id = "f111">
      <?php if(isset($_GET['isfecha'])):?>
      <img src="<?php echo $objNahual['dirWeb'] ?>" alt="MDN"  width="175" height="175" class="imagen11" >
      <br><label for="InputPass" style="color:white">Dia: <?php echo $objNahual['nombre'] ?></label>
      <?php endif;?>
      </div> 
      <div class="nahuales21" >
      <?php if(isset($_GET['isfecha'])):?>
      <img src="<?php echo $objWinal['dirWeb'] ?>" alt="MDN"  width="175" height="175" class="imagen11" >
      <br><label for="InputPass" style="color:white">Winal: <?php echo $objWinal['nombre'] ?></label>
      <?php endif;?>    
      </div>
      <div class="nahuales31" >
      <?php if(isset($_GET['isfecha'])):?>
      <img src="<?php echo $objCargador['rutaWeb'] ?>" alt="MDN"  width="175" height="175" class="imagen11" >
      <br><label for="InputPass" style="color:white" >Cargador: <?php echo $objCargador['nombre'] ?></label>
      <?php endif;?>    
      </div>  
      <div class="nahuales41" >
      <?php if(isset($_GET['isfecha'])):?>
      <img src="<?php echo $objEnergia['dirWeb'] ?>" alt="MDN"  width="175" height="175" class="imagen11" >
      <br><label for="InputPass" style="color:white" >Energia: <?php echo $objEnergia['nombre'] ?></label>
      <?php endif;?>    
      </div>    
    </div>

  <form method="POST" action="backend/RuedaCalendarica.php">
            <div class="form-group mb-2">
              <label for="staticEmail2" class="sr-only text-dark" style="color:white">Ingresar fecha</label>
             
             
              <?php if(!isset($_GET['isfecha'])):?>
              <input type="date" style="color:white" class="form-control-plaintext text-dark border border-success" id="staticEmail2" name="date" required>
              <?php endif; ?>

              <?php if(isset($_GET['isfecha'])):?>
                <input type="date" style="color:white" class="form-control-plaintext text-dark border border-success" value='<?php echo $_GET['isfecha']; ?>' id="staticEmail2" name="date" required>
              <?php endif; ?>

            </div>
            <div class="form-group mb-2">
              <button type="submit" class="btn btn-outline-success btn-lg btn-block mb-2">Buscar</button>
            </div>
</form>
<a href="#" class="btn-get-started" data-toggle="modal" data-target="#myModalInformacion">Informacion</a>
<a href="#" class="btn-get-started" data-toggle="modal" data-target="#myModalMecanismo">Funcionamiento</a>

</div>
</section>

<div class="modal" id="myModalMecanismo" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLongTitle">Información</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center;">Mecanismo</h4>
                <p><?php 
                    $sql = "SELECT * FROM informacion WHERE id = 10";
                    $resultado = $conexion->query($sql);
                    $informacionEncontrada = $resultado->fetch_array(MYSQLI_ASSOC); 
                    echo $informacionEncontrada['descripcionWeb'];
                ?></p>
                <p> • 18 980 = 73 x 260 </p>
                <p> • 18 720 = 72 x 260 </p>
                <p> • 5 256 = 72 x 73 = 9 x 584.2​ </p>
                <p> También debe ser tomado en cuenta que 13 x 360 = 18 x 260 = 4 680. </p>
                <p> • Es decir, si los 5 días de Uayeb' son omitidos (como debe haber sido el caso en
                      los orígenes del calendario), los períodos de 360 y de 260 días coincidirían después
                      de, respectivamente, 13 y 18 ciclos (13 "años" de 360 días).</p>
              
                <p> • Cuatro de esos ciclos de 13 "años" abarcan 52 "años" de 360 días. </p>
              
                <p> • Ahora, 52 veces esos 5 adicionales días de Wayeb' resultan en exactamente uno más
                      de los ciclos de 260 días. </p>

                <p> El sistema de la rueda calendárica, sirve para interpretar una sucesión infinita de
                    períodos de 52 años. Se desconoce su nombre en lenguas mayenses, pero el nombre en
                    idioma náhuatl utilizado por los mexicas era "Xiuhnelpilli", aunque es más usual
                    encontrarlo escrito como Xiuhmolpilli, forma gramaticalmente incorrecta;3​ cuyo
                    significado es anudación de los años.

                <p> Cada 52 años las culturas mesomericanas realizaban importantes ceremonias. Para el
                    caso de los mexicas era la llamada "ceremonia del fuego nuevo".
                </p>
            </div>
        </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal" id="myModalMexica" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLongTitle">Información</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center;">Correlación mexica de los años</h4>
                <p>La siguiente tabla muestra la correspondencia del ultimo periodo de 52 años, entre los años mexicas y nuestros años.</p>
                <table class="table table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Tlalpilli Tochtli</th>
                      <th scope="col">Tlalpilli Acatl</th>
                      <th scope="col">Tlalpilli Tecpatl</th>
                      <th scope="col">Tlalpilli Calli</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1 tochtli / 1974</td>
                      <td>1 acatl / 1987</td>
                      <td>1 tecpatl / 2000</td>
                      <td>1 calli / 2013</td>
                    </tr>
                    <tr>
                      <td>2 actal / 1974</td>
                      <td>2 tecpatl / 1988</td>
                      <td>2 calli / 2001</td>
                      <td>2 tochtli / 2014</td>
                    </tr>
                    <tr>
                      <td>3 tecpatl / 1976</td>
                      <td>3 calli / 1989</td>
                      <td>3 tochtli / 2002</td>
                      <td>3 acatl / 2015</td>
                    </tr>
                    <tr>
                      <td>4 calli / 1977</td>
                      <td>4 tochtli / 1990</td>
                      <td>4 acatl / 2003</td>
                      <td>4 tecpatl / 2016</td>
                    </tr>
                    <tr>
                      <td>5 tochtli / 1978</td>
                      <td>5 acatl / 1991</td>
                      <td>5 tecpatl / 2004</td>
                      <td>5 calli / 2017</td>
                    </tr>
                    <tr>
                      <td>6 acatl / 1979</td>
                      <td>6 tecpatl / 1992</td>
                      <td>6 calli / 2005</td>
                      <td>6 tochtli / 2018</td>
                    </tr>
                    <tr>
                      <td>7 tecpatl / 1980</td>
                      <td>7 calli / 1993</td>
                      <td>7 tochtli / 2006</td>
                      <td>7 acatl / 2019</td>
                    </tr>
                    <tr>
                      <td>8 calli / 1981</td>
                      <td>8 tochtli / 1994</td>
                      <td>8 acatl / 2007</td>
                      <td>8 tecpatl / 2020</td>
                    </tr>
                    <tr>
                      <td>9 tochtli / 1982</td>
                      <td>9 acatl / 1995</td>
                      <td>9 tecpatl / 2008</td>
                      <td>9 calli / 2021</td>
                    </tr>
                    <tr>
                      <td>10 acatl / 1983</td>
                      <td>10 tecpatl / 1996</td>
                      <td>10 calli / 2009</td>
                      <td>10 tochtli / 2022</td>
                    </tr>
                    <tr>
                      <td>11 tecpatl / 1984</td>
                      <td>11 calli / 1997</td>
                      <td>11 tochtli / 2010</td>
                      <td>11 acatl / 2023</td>
                    </tr>
                    <tr>
                      <td>12 calli / 1985</td>
                      <td>12 tochtli / 1998</td>
                      <td>12 acatl / 2011</td>
                      <td>12 tecpatl / 2024</td>
                    </tr>
                    <tr>
                      <td>13 tochtli / 1986</td>
                      <td>13 acatl / 1999</td>
                      <td>13 tecpatl / 2012</td>
                      <td>13 calli / 2025</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal" id="myModalInformacion" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLongTitle">Información</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center;">Rueda Calendarica</h4>
                <p><?php 
                    $sql = "SELECT * FROM informacion WHERE id = 1";
                    $resultado = $conexion->query($sql);
                    $informacionEncontrada = $resultado->fetch_array(MYSQLI_ASSOC); 
                    echo $informacionEncontrada['descripcionEscritorio'];
                ?></p>
            </div>
        </div>
    </div>
  </div>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="js/main.js"></script>

</body>
</html>


 