<?php
//FRONT PARA INSERTAR UN ALOJAMIENTO A LA BD
include_once 'app/Conexion.inc.php';
include_once 'app/Alojamiento.inc.php';
include_once 'app/AbmAlojamiento.inc.php';
include_once 'app/ValidadorAlojamiento.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
    
    Conexion :: abrir_conexion();     
    $servicios = filter_input(INPUT_POST, 'checkbox');
    
    $validador = new ValidadorAlojamiento($_POST[ 'nombre'], $_POST['categoria'], $_POST[ 'cantidadHabitacionesInd'], $_POST[ 'cantidadHabitacionesDob'], $_POST[ 'ciudad'], $_POST[ 'email'],$_POST['regimen'], Conexion :: getConexion(), $servicios);
    
    if ($validador->registroValidado()) {
          
                                        // $nombre,                 $categoria,             $cantidadHabInd,                                $cantidadHabDob,                         $servicio,                 $ciudad,            $email,                         $regimen
        $alojamiento = new Alojamiento('', $validador->getNombre(), $validador->getCategoria(), $validador->getCantidadHabitacionesInd(), $validador->getCantidadHabitacionesDob(), $validador->getServicios(), $validador->getCiudad(), $validador->getEmail(),$validador->getRegimen() );

        $alojamiento_insertado = AbmAlojamiento :: insertarAlojamiento(Conexion :: getConexion(), $alojamiento);

        if ($alojamiento_insertado) {
            // Redireccion :: redirigir(RUTA_REGISTRO_CORRECTO . '?nombre=' . $alojamiento -> getNombreAlojamiento());
        }
    }
    Conexion :: cerrar_conexion();
}
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
        <!--===============================================================================================-->
    </head>

    <body>
        <div class="container">
            <div class="signup-form">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                    <h2>Ingresar Alojamiento</h2><br>

                    <div class="form-group">
                        <label >Nombre de Alojamiento</label>

                        <input type="text" class="form-control"  name="nombre"  placeholder="Ingrese Nombre de alojamiento" required="required"> 
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
                        <input type="text" class="form-control" id="nombreALojamiento" name="cantidadHabitacionesInd" aria-describedby="emailHelp" placeholder="0"> 
                    </div>
                    <div class="form-group">
                        <label for="cantidadhabind">Cantidad de habitaciones Dobles</label>
                        <input type="text" class="form-control" id="nombreALojamiento" name="cantidadHabitacionesDob" aria-describedby="emailHelp" placeholder="0"> 
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
                        <label for="cantidadhabind">Ciudad</label>
                        <input type="text" class="form-control" id="nombreALojamiento" name="ciudad" aria-describedby="emailHelp" placeholder="Ingrese una ciudad"> 
                    </div>
                    <div class="form-group">
                        <label for="cantidadhabind">E-mail</label>
                        <input type="text" class="form-control" id="nombreALojamiento" name="email" aria-describedby="emailHelp" placeholder="Ingrese un e-mail"> 
                    </div>
                    <div class="form-group">
                        <label for="cantidadhabind">Servicios</label>
                        <div>
                            <input type="checkbox" name="checkbox[]" value="AireAcondicionado">Aire Acondicionado<br>
                            <input type="checkbox" name="checkbox[]" value="Wi-fi">Wi-fi gratis<br>
                            <input type="checkbox" name="checkbox[]" value="Calefaccion">Calefaccion<br>
                            <input type="checkbox" name="checkbox[]" value="Ascensor">Ascensor<br>
                            <input type="checkbox" name="checkbox[]" value="Repecion24hs">Recepcion 24 hs<br>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="enviar">Cargar Alojamiento</button>
                    </div>

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
</html>