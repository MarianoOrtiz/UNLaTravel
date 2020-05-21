
<!DOCTYPE html>
<?php
include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioCiudad.inc.php';
include_once 'app/Ciudad.inc.php';
include_once 'app/RepositorioServicios.inc.php';

Conexion::abrir_Conexion();
$conexion = Conexion::getConexion();
$idAlojamiento = ($_GET['idAlojamiento']);
Conexion :: abrir_conexion();
$alojamiento = AbmAlojamiento :: getAlojamientoPorId2(Conexion::getConexion(), $idAlojamiento);
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
            div.background {
                background: url(klematis.jpg) repeat;
                border: 2px solid black;
            }

            div.transbox {
                margin: 30px;
                background-color: #ffffff;
                border: 1px solid black;
                opacity: 0.8;
            }

            div.transbox p {
                margin: 5%;
                font-weight: bold;
                color: #000000;
            }

            h2 .servicio {
                color: black;
            }
            div.card{
                 
                margin: 30px;
                opacity: 0.9;
            }
            
        </style>
    </head>
    <body>

        <div class="container">

        <?php include_once 'plantillas/navbarUsuario.inc.php'; ?>
        <div class="container">
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
    <div class='col-md-5'>
        <div class="form-group">
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>
    </div>
</div>
        <!-- Page Content -->
        <!--Carousel Wrapper-->
        <div class="container">  <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Hotel: <?php echo $alojamiento->getNombre(); ?></h1>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/hoteles/hotel1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/hoteles/hotel1.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/hoteles/hotel1.jpg" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
      
        <div class="container">
            <div class="card">

                <div class="card-body">
                    <h3 style="color:black">Servicios:</h3>
                  <?php  RepositorioServicios:: escribirServicios($conexion,$alojamiento->getId())?>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title" style="color:black" >Incluye Impto. PAIS. Precio por noche desde</h5>
                    <h4 class="card-title" style="color:black" >$<?php echo $alojamiento->getPrecio() ?></h4>

                    <a href="#fecha" class="btn btn-primary">Elegir Fecha</a>
                </div>
            </div>
        </div>

        <!--/.Carousel Wrapper-->
        <!-- /.container -->



</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker();
        $('#datetimepicker7').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
</script>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="styles/bootstrap4/popper.js"></script>
        <script src="styles/bootstrap4/bootstrap.min.js"></script>
        <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
        <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
        <script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
        <script src="plugins/easing/easing.js"></script>
        <script src="plugins/parallax-js-master/parallax.min.js"></script>
        <script src="js/custom.js"></script>
        <script>
            $(function () {
                $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
            });
        </script>
    </body>
</html>