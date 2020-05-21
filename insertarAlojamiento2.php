<?php
//FRONT PARA INSERTAR UN ALOJAMIENTO A LA BD

include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioCiudad.inc.php';
include_once 'app/Ciudad.inc.php';



if (isset($_POST['enviar'])) {

    Conexion :: abrir_conexion();
    $servicios = filter_input(INPUT_POST, 'checkbox');


    $validador = new ValidadorAlojamiento($_POST['nombre'], $_POST['categoria'], $_POST['cantidadHabitacionesInd'], $_POST['cantidadHabitacionesDob'], $_POST['ciudad'], $_POST['email'], $_POST['regimen'], Conexion :: getConexion(), $servicios);

    if ($validador->alojamientoValidado()) {

         $alojamiento = new Alojamiento('', $validador->getNombre(), $validador->getCategoria(), $validador->getCantidadHabitacionesInd(), $validador->getCantidadHabitacionesDob(), $validador->getServicios(), $validador->getCiudad(), $validador->getEmail(), $validador->getRegimen());

        $alojamiento_insertado = AbmAlojamiento :: insertarAlojamiento(Conexion :: getConexion(), $alojamiento, $_POST['checkbox']);

        
        
        if ($alojamiento_insertado) {
            // Redireccion :: redirigir(RUTA_REGISTRO_CORRECTO . '?nombre=' . $alojamiento -> getNombreAlojamiento());
        }
    }
    Conexion :: cerrar_conexion();
}
Conexion :: abrir_conexion();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UNLaTravel - Ingresar nuevo alojamiento</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->	
        <link rel="icon" type="images/png" href="images/icons/favicon.ico"/>
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
        <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link href="css/blog.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!--===============================================================================================-->
        <style type="text/css">
            body{
                color: #fff;
                background: #0000;
                font-family: 'Roboto', sans-serif;
                
                background-position: center;
                 background-repeat: no-repeat, repeat;
                 background-size: cover;
                
            }
            .form-control{
                height: 40px;
                box-shadow: none;
                color: #0000;
            }
            .form-control:focus{
                border-color: #5cb85c;
            }
            .form-control, .btn{        
                border-radius: 3px;
            }
            .signup-form{
                width: 400px;
                margin: 0 auto;
                padding: 30px 0;
            }
            .signup-form h2{
                color: #636363;
                margin: 0 0 15px;
                position: relative;
                text-align: center;
            }
            .signup-form h2:before, .signup-form h2:after{
                content: "";
                height: 2px;
                width: 5%;
                background: #d4d4d4;
                position: absolute;
                top: 50%;
                z-index: 2;
            }	
            .signup-form h2:before{
                left: 0;
            }
            .signup-form h2:after{
                right: 0;
            }
            .signup-form .hint-text{
                color: #999;
                margin-bottom: 30px;
                text-align: center;
            }
            .signup-form form{
                color: #999;
                border-radius: 3px;
                margin-bottom: 15px;
                background: #f2f3f7;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .signup-form .form-group{
                margin-bottom: 20px;
            }
            .signup-form input[type="checkbox"]{
                margin-top: 3px;
            }
            .signup-form .btn{        
                font-size: 16px;
                font-weight: bold;		
                min-width: 140px;
                outline: none !important;
            }
            .signup-form .row div:first-child{
                padding-right: 10px;
            }
            .signup-form .row div:last-child{
                padding-left: 10px;
            }    	
            .signup-form a{
                color: #fff;
                text-decoration: underline;
            }
            .signup-form a:hover{
                text-decoration: none;
            }
            .signup-form form a{
                color: #5cb85c;
                text-decoration: none;
            }	
            .signup-form form a:hover{
                text-decoration: underline;
            }  
        </style>
    </head>

    <body>
        
        <div class="container">
            <?php include_once 'plantillas/navbar-Administrador.inc.php';?>
        
        
     
            <div class="signup-form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <?php
                    if (isset($_POST['enviar'])) {
                        include_once 'plantillas/insertarAlojamiento_validado.inc.php';
                    } else {
                        include_once 'plantillas/insertarAlojamiento_vacio.inc.php';
                    }
                    ?>

                </form>
            </div>
              
        </div>




        <!--===============================================================================================-->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <script>
            $(".selection-2").select2({
                minimumResultsForSearch: 20,
                dropdownParent: $('#dropDownSelect1')
            });
        </script>
        <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>

    </body>
<?php Conexion :: cerrar_conexion(); ?>
</html>