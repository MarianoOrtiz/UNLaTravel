
<?php
//FRONT PARA INSERTAR UN ALOJAMIENTO A LA BD

include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';
include_once 'app/RepositorioCiudad.inc.php';
include_once 'app/Ciudad.inc.php';

$idAlojamiento = ($_GET['id']);
Conexion :: abrir_conexion();
$alojamiento = AbmAlojamiento :: getAlojamientoPorId2(Conexion::getConexion(), $idAlojamiento);

if (isset($_POST['actualizar'])) {

    Conexion :: abrir_conexion();
    $servicios = filter_input(INPUT_POST, 'checkbox');


    $validador = new ValidadorAlojamiento($_POST['nombre'], $_POST['categoria'], $_POST['cantidadHabitacionesInd'], $_POST['cantidadHabitacionesDob'], $_POST['ciudad'], $_POST['email'], $_POST['regimen'], Conexion :: getConexion(), $servicios);

    if ($validador->validarActualizacion()) {

        $alojamiento = new Alojamiento($_POST['idAlojamiento'], $validador->getNombre(), $validador->getCategoria(), $validador->getCantidadHabitacionesInd(), $validador->getCantidadHabitacionesDob(), $validador->getServicios(), $validador->getCiudad(), $validador->getEmail(), $validador->getRegimen());

        $alojamiento_modificado = AbmAlojamiento :: modificarAlojamiento(Conexion :: getConexion(), $alojamiento, $_POST['checkbox']);
        $idAlojamiento = $alojamiento->getId();


        if ($alojamiento_modificado) {

            header("Location: listaAlojamientos.php");
        }
    }
    Conexion :: cerrar_conexion();
}

//Mostrar datos
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UNLaTravel - Modificar Alojamiento</title>
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
        <!--===============================================================================================-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="css/blog.css" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
         <?php include_once 'plantillas/navbar-Administrador.inc.php'; ?>

            <div class="signup-form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="hidden" name="idAlojamiento" value="<?php echo $alojamiento->getID(); ?>">
                    
                    <h2>Modificar Alojamiento</h2><br>



                    <div class="form-group">
                        <label>Nombre de Alojamiento</label>
                        <input type="text"    name="nombre"  value="<?php echo $alojamiento->getNombre(); ?>" required="required" > 

                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Categoria</label>
                        <select name="categoria">
                            <option value="1">1 estrella</option> 
                            <option value="2">2 estrellas</option> 
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option> 
                            <option value="5">5 estrellas</option> 
                        </select> 
                    </div>

                    <div class="form-group">
                        <label for="cantidadhabind">Cantidad de habitaciones individuales</label>
                        <input type="text"  id="nombreALojamiento" name="cantidadHabitacionesInd" aria-describedby="emailHelp" value="<?php echo $alojamiento->getCantidadHabInd(); ?>" >

                    </div>

                    <div class="form-group">
                        <label for="cantidadhabind">Cantidad de habitaciones Dobles</label>
                        <input type="text"  id="nombreALojamiento" name="cantidadHabitacionesDob" aria-describedby="emailHelp" value="<?php echo $alojamiento->getCantidadHabDob(); ?>" > 

                    </div>

                    <div class="form-group">
                        <label for="tipoPension">Regimen</label>
                        <select name="regimen">
                            <option value="1">Media Pension</option> 
                            <option value="2">Pension completa</option> 
                            <option value="3">Solo hospedaje</option>
                        </select> 
                    </div>

                    <div class="form-group">
                        <label for="otro">Ciudad</label>
                        <select name="ciudad">
                            <?php RepositorioCiudad::escribirCiudades2(Conexion :: getConexion(), $alojamiento->getCiudad()); ?>
                        </select> 
                    </div>

                    <div class="form-group">
                        <label for="cantidadhabind">E-mail</label>
                        <input type="text"  id="nombreALojamiento" name="email" aria-describedby="emailHelp" value="<?php echo $alojamiento->getEmail(); ?>" > 

                    </div>

                    <div class="form-group">
                        <label for="cantidadhabind">Servicios</label>
                        <div>
                            <input type="checkbox" name="checkbox[]" value="1">Aire Acondicionado<br>
                            <input type="checkbox" name="checkbox[]" value="2">Wi-fi gratis<br>
                            <input type="checkbox" name="checkbox[]" value="3">Calefaccion<br>
                            <input type="checkbox" name="checkbox[]" value="4">Ascensor<br>
                            <input type="checkbox" name="checkbox[]" value="5">Recepcion 24 hs<br>

                        </div>
                    </div>

                    <div class="form-group">
                        <button id="btnActualizar" type="submit" class="btn btn-success btn-lg btn-block" name="actualizar">Modificar Alojamiento</button>
                    </div>


                </form>
            </div>

        </div>




        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    </body>
<?php Conexion :: cerrar_conexion(); ?>
</html>