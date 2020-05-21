<!DOCTYPE html>
<?php
include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioCiudad.inc.php';
include_once 'app/Ciudad.inc.php';
Conexion::abrir_Conexion();
$conexion = Conexion::getConexion();

if(isset($_POST['ver'])){
   header("Location: vistaAlojamiento.php");
}
?>
<html lang="en">
    <head>
        <title>UNLaTravel</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Travello template project">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
        <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
        <link rel="stylesheet" type="text/css" href="styles/responsive.css">
        <link href="album.css" rel="stylesheet">

        <style type="text/css">

            body{
                color: #fff;
                background: #0000;
                font-family: 'Roboto', sans-serif;
                background-image: url('images/hotel1.jpg');
                background-position: center;
                background-repeat: no-repeat, repeat;


            }

        </style>
    </head>
    <body>
        
      
            
            <?php include_once 'plantillas/navbarUsuario.inc.php'; ?>
               

        
        <div class="container">
           
            <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
              
           <?php AbmAlojamiento :: escribirAlojamientos($conexion); ?>
              
            
            
         
           
          </div>
        </div>
      </div>
        </div>
       
        

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="styles/bootstrap4/popper.js"></script>
        <script src="styles/bootstrap4/bootstrap.min.js"></script>
        <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
        <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
        <script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="plugins/parallax-js-master/parallax.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>